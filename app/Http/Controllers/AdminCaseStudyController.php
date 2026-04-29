<?php

namespace App\Http\Controllers;

use App\Models\CaseStudy;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class AdminCaseStudyController extends Controller
{
    public function index(): View
    {
        return view('admin.case-studies.index', [
            'caseStudies' => CaseStudy::latest()->paginate(20),
        ]);
    }

    public function create(): View
    {
        return view('admin.case-studies.create', [
            'caseStudy' => new CaseStudy(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validatedData($request);
        $data['slug'] = $this->uniqueSlug($data['slug'] ?: $data['title']);
        $data['published_at'] = $data['status'] === 'published' ? now() : null;

        $caseStudy = CaseStudy::create($data);

        return redirect()
            ->route('admin.case-studies.show', $caseStudy)
            ->with('status', 'Case study creato.');
    }

    public function show(CaseStudy $caseStudy): View
    {
        return view('admin.case-studies.show', [
            'caseStudy' => $caseStudy,
        ]);
    }

    public function edit(CaseStudy $caseStudy): View
    {
        return view('admin.case-studies.edit', [
            'caseStudy' => $caseStudy,
        ]);
    }

    public function update(Request $request, CaseStudy $caseStudy): RedirectResponse
    {
        $data = $this->validatedData($request, $caseStudy);
        $data['slug'] = $this->uniqueSlug($data['slug'] ?: $data['title'], $caseStudy);
        $data['published_at'] = $data['status'] === 'published'
            ? ($caseStudy->published_at ?: now())
            : null;

        $caseStudy->update($data);

        return redirect()
            ->route('admin.case-studies.show', $caseStudy)
            ->with('status', 'Case study aggiornato.');
    }

    public function destroy(CaseStudy $caseStudy): RedirectResponse
    {
        $caseStudy->delete();

        return redirect()
            ->route('admin.case-studies.index')
            ->with('status', 'Case study eliminato.');
    }

    /**
     * @return array<string, mixed>
     */
    private function validatedData(Request $request, ?CaseStudy $caseStudy = null): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:180'],
            'slug' => [
                'nullable',
                'string',
                'max:180',
                Rule::unique('case_studies', 'slug')->ignore($caseStudy?->id),
            ],
            'client_name' => ['required', 'string', 'max:160'],
            'industry' => ['nullable', 'string', 'max:160'],
            'service' => ['required', 'string', 'max:120'],
            'summary' => ['required', 'string', 'max:1000'],
            'challenge' => ['required', 'string', 'max:2000'],
            'solution' => ['required', 'string', 'max:2000'],
            'result' => ['required', 'string', 'max:2000'],
            'metric_one_label' => ['nullable', 'string', 'max:80'],
            'metric_one_value' => ['nullable', 'string', 'max:80'],
            'metric_two_label' => ['nullable', 'string', 'max:80'],
            'metric_two_value' => ['nullable', 'string', 'max:80'],
            'metric_three_label' => ['nullable', 'string', 'max:80'],
            'metric_three_value' => ['nullable', 'string', 'max:80'],
            'visual_image' => ['nullable', 'string', 'max:255'],
            'visual_label' => ['nullable', 'string', 'max:120'],
            'visual_caption' => ['nullable', 'string', 'max:180'],
            'before_state' => ['nullable', 'string', 'max:2000'],
            'after_state' => ['nullable', 'string', 'max:2000'],
            'problems_solved' => ['nullable', 'string', 'max:2000'],
            'testimonial_quote' => ['nullable', 'string', 'max:1000'],
            'testimonial_author' => ['nullable', 'string', 'max:120'],
            'testimonial_role' => ['nullable', 'string', 'max:160'],
            'status' => ['required', Rule::in(['draft', 'published'])],
        ]);
    }

    private function uniqueSlug(string $value, ?CaseStudy $caseStudy = null): string
    {
        $baseSlug = Str::slug($value);
        $slug = $baseSlug;
        $index = 2;

        while (CaseStudy::where('slug', $slug)->when($caseStudy, function ($query) use ($caseStudy) {
            $query->whereKeyNot($caseStudy->id);
        })->exists()) {
            $slug = $baseSlug.'-'.$index;
            $index++;
        }

        return $slug;
    }
}
