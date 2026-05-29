<?php

namespace App\Http\Controllers;

use App\Models\AuditSubmission;
use App\Models\CaseStudy;
use App\Models\ContactSubmission;
use App\Models\ResourceLead;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AdminController extends Controller
{
    public function login(Request $request): View|RedirectResponse
    {
        if ($request->session()->get('admin_authenticated')) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.login');
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $emailMatches = hash_equals((string) config('admin.email'), $credentials['email']);
        $passwordMatches = $this->passwordMatches($credentials['password']);

        if (! $emailMatches || ! $passwordMatches) {
            return back()
                ->withErrors(['email' => 'Credenziali admin non valide.'])
                ->onlyInput('email');
        }

        $request->session()->regenerate();
        $request->session()->put('admin_authenticated', true);
        $request->session()->put('admin_email', $credentials['email']);

        return redirect()->route('admin.dashboard');
    }

    public function logout(Request $request): RedirectResponse
    {
        $request->session()->forget(['admin_authenticated', 'admin_email']);
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }

    public function dashboard(): View
    {
        return view('admin.dashboard', [
            'auditCount' => AuditSubmission::count(),
            'resourceLeadCount' => ResourceLead::count(),
            'contactCount' => ContactSubmission::count(),
            'caseStudyCount' => CaseStudy::count(),
            'latestAudits' => AuditSubmission::latest()->take(5)->get(),
            'latestLeads' => ResourceLead::latest()->take(5)->get(),
            'latestContacts' => ContactSubmission::latest()->take(5)->get(),
            'latestCaseStudies' => CaseStudy::latest()->take(5)->get(),
        ]);
    }

    public function audits(Request $request): View
    {
        $filters = $this->auditFilters($request);

        return view('admin.audits.index', [
            'audits' => $this->filteredAudits($filters)->latest()->paginate(20)->withQueryString(),
            'filters' => $filters,
            'statusOptions' => AuditSubmission::CRM_STATUSES,
            'problemOptions' => AuditSubmission::query()
                ->select('main_problem')
                ->whereNotNull('main_problem')
                ->distinct()
                ->orderBy('main_problem')
                ->pluck('main_problem'),
            'budgetOptions' => AuditSubmission::query()
                ->select('project_budget')
                ->whereNotNull('project_budget')
                ->distinct()
                ->orderBy('project_budget')
                ->pluck('project_budget'),
            'timingOptions' => AuditSubmission::query()
                ->select('timeline')
                ->whereNotNull('timeline')
                ->distinct()
                ->orderBy('timeline')
                ->pluck('timeline'),
        ]);
    }

    public function audit(AuditSubmission $auditSubmission): View
    {
        return view('admin.audits.show', [
            'audit' => $auditSubmission,
            'statusOptions' => AuditSubmission::CRM_STATUSES,
        ]);
    }

    public function updateAuditCrm(Request $request, AuditSubmission $auditSubmission): RedirectResponse
    {
        $validated = $request->validate([
            'crm_status' => ['required', Rule::in(array_keys(AuditSubmission::CRM_STATUSES))],
            'internal_notes' => ['nullable', 'string', 'max:5000'],
        ]);

        $auditSubmission->update($validated);

        return redirect()
            ->route('admin.audits.show', $auditSubmission)
            ->with('status', 'Audit aggiornato.');
    }

    public function exportAudits(Request $request): StreamedResponse
    {
        $filters = $this->auditFilters($request);
        $audits = $this->filteredAudits($filters)->latest()->get();

        $headers = [
            'ID',
            'Creato',
            'Stato',
            'Nome',
            'Email',
            'Telefono',
            'Brand',
            'Ecommerce',
            'Storico online',
            'Prodotto e target',
            'Revenue',
            'Spesa ads',
            'AOV',
            'Redditività ads',
            'Ordini mensili',
            'Fidelizzazione',
            'Canali',
            'Strategia attuale',
            'Collo di bottiglia',
            'Obiettivo 90 giorni',
            'Ostacolo',
            'Note interne',
        ];

        $callback = function () use ($audits, $headers): void {
            $output = fopen('php://output', 'w');
            fputcsv($output, $headers);

            foreach ($audits as $audit) {
                fputcsv($output, [
                    $audit->id,
                    $audit->created_at?->format('Y-m-d H:i:s'),
                    AuditSubmission::CRM_STATUSES[$audit->crm_status] ?? $audit->crm_status,
                    $audit->name,
                    $audit->email,
                    $audit->phone,
                    $audit->brand_name ?: $audit->company,
                    $audit->ecommerce_url ?: $audit->website,
                    $audit->online_since,
                    $audit->product_audience,
                    $audit->monthly_revenue_range ?: $audit->monthly_revenue,
                    $audit->monthly_ads_spend_range ?: $audit->monthly_ad_budget,
                    $audit->aov_range ?: $audit->average_order_value,
                    $audit->ads_profitability,
                    $audit->monthly_orders_range ?: $audit->monthly_sales,
                    $audit->repeat_purchase_rate,
                    is_array($audit->channels) ? implode(', ', $audit->channels) : $audit->channels,
                    $audit->current_strategy,
                    $audit->bottleneck ?: $audit->main_problem,
                    $audit->goal_90_days,
                    $audit->biggest_obstacle ?: $audit->notes,
                    $audit->internal_notes,
                ]);
            }

            fclose($output);
        };

        return response()->stream($callback, 200, [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="audit-export-'.now()->format('Y-m-d-His').'.csv"',
        ]);
    }

    public function resourceLeads(): View
    {
        return view('admin.resource-leads.index', [
            'leads' => ResourceLead::latest()->paginate(20),
        ]);
    }

    public function contacts(): View
    {
        return view('admin.contacts.index', [
            'contacts' => ContactSubmission::latest()->paginate(20),
        ]);
    }

    private function passwordMatches(string $password): bool
    {
        $configuredHash = config('admin.password_hash');

        if ($configuredHash) {
            return Hash::check($password, $configuredHash);
        }

        return hash_equals((string) config('admin.password'), $password);
    }

    /**
     * @return array<string, string|null>
     */
    private function auditFilters(Request $request): array
    {
        return [
            'status' => $request->query('status'),
            'problem' => $request->query('problem'),
            'budget' => $request->query('budget'),
            'timing' => $request->query('timing'),
        ];
    }

    /**
     * @param array<string, string|null> $filters
     */
    private function filteredAudits(array $filters)
    {
        return AuditSubmission::query()
            ->when($filters['status'], function ($query, $status) {
                $query->where('crm_status', $status);
            })
            ->when($filters['problem'], function ($query, $problem) {
                $query->where('main_problem', $problem);
            })
            ->when($filters['budget'], function ($query, $budget) {
                $query->where('project_budget', $budget);
            })
            ->when($filters['timing'], function ($query, $timing) {
                $query->where('timeline', $timing);
            });
    }
}
