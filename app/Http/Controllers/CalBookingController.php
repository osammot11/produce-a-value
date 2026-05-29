<?php

namespace App\Http\Controllers;

use App\Models\AuditSubmission;
use App\Services\CalComService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use RuntimeException;

class CalBookingController extends Controller
{
    public function slots(Request $request, CalComService $calComService): JsonResponse
    {
        $validated = $request->validate([
            'start' => ['nullable', 'date'],
            'end' => ['nullable', 'date', 'after:start'],
            'timeZone' => ['nullable', 'string', 'max:80'],
        ]);

        $timeZone = $validated['timeZone'] ?? config('services.cal.timezone');
        $start = isset($validated['start'])
            ? Carbon::parse($validated['start'], $timeZone)->utc()->toIso8601String()
            : now($timeZone)->startOfDay()->utc()->toIso8601String();
        $end = isset($validated['end'])
            ? Carbon::parse($validated['end'], $timeZone)->utc()->toIso8601String()
            : now($timeZone)->addDays((int) config('services.cal.slot_lookahead_days'))->endOfDay()->utc()->toIso8601String();

        try {
            return response()->json([
                'slots' => $calComService->slots($start, $end, $timeZone),
            ]);
        } catch (RuntimeException $exception) {
            Log::warning('Cal.com slots request failed.', ['error' => $exception->getMessage()]);

            return response()->json([
                'message' => 'Non siamo riusciti a leggere gli slot disponibili. Riprova tra poco.',
            ], 502);
        }
    }

    public function book(Request $request, CalComService $calComService): JsonResponse
    {
        $validated = $request->validate([
            'audit_id' => ['nullable', 'integer', 'exists:audit_submissions,id'],
            'start' => ['required', 'date'],
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:160'],
            'phone' => ['required', 'string', 'max:40'],
            'notes' => ['nullable', 'string', 'max:1000'],
            'timeZone' => ['nullable', 'string', 'max:80'],
        ]);

        $timeZone = $validated['timeZone'] ?? config('services.cal.timezone');
        $audit = isset($validated['audit_id']) ? AuditSubmission::find($validated['audit_id']) : null;

        $payload = [
            'eventTypeId' => (int) config('services.cal.event_type_id'),
            'start' => Carbon::parse($validated['start'])->utc()->toIso8601String(),
            'attendee' => [
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phoneNumber' => $validated['phone'],
                'timeZone' => $timeZone,
                'language' => 'it',
            ],
            'bookingFieldsResponses' => [
                'notes' => $validated['notes'] ?? '',
            ],
            'metadata' => array_filter([
                'source' => 'produceavalue_radar',
                'audit_submission_id' => $audit ? (string) $audit->id : null,
                'radar_profile' => $audit?->radar_profile,
                'radar_priority' => $audit?->radar_priority,
            ]),
        ];

        try {
            $booking = $calComService->createBooking($payload);
        } catch (RuntimeException $exception) {
            Log::warning('Cal.com booking request failed.', [
                'audit_submission_id' => $audit?->id,
                'error' => $exception->getMessage(),
            ]);

            return response()->json([
                'message' => 'Non siamo riusciti a creare la prenotazione. Riprova tra poco.',
            ], 502);
        }

        if ($audit && strcasecmp((string) $audit->email, $validated['email']) === 0) {
            $audit->update([
                'cal_booking_id' => $booking['id'] ?? null,
                'cal_booking_uid' => $booking['uid'] ?? null,
                'cal_booking_status' => $booking['status'] ?? null,
                'cal_booking_start_at' => isset($booking['start']) ? Carbon::parse($booking['start']) : null,
                'cal_booking_end_at' => isset($booking['end']) ? Carbon::parse($booking['end']) : null,
                'cal_booking_payload' => $booking,
            ]);
        }

        return response()->json([
            'booking' => [
                'uid' => $booking['uid'] ?? null,
                'status' => $booking['status'] ?? null,
                'start' => $booking['start'] ?? null,
                'end' => $booking['end'] ?? null,
                'meetingUrl' => $booking['meetingUrl'] ?? $booking['location'] ?? null,
            ],
        ], 201);
    }
}
