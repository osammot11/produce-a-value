@if ($errors->any())
    <div class="admin-error-brutal admin-form-field-wide">
        Controlla i campi: ci sono dati mancanti o non validi.
    </div>
@endif

<div class="admin-form-grid">
    <label>Titolo
        <input type="text" name="title" value="{{ old('title', $caseStudy->title) }}" required>
    </label>

    <label>Slug
        <input type="text" name="slug" value="{{ old('slug', $caseStudy->slug) }}" placeholder="Generato dal titolo se vuoto">
    </label>

    <label>Cliente
        <input type="text" name="client_name" value="{{ old('client_name', $caseStudy->client_name) }}" required>
    </label>

    <label>Industry
        <input type="text" name="industry" value="{{ old('industry', $caseStudy->industry) }}">
    </label>

    <label>Servizio
        <select name="service" required>
            @foreach (['Landing Page', 'Conversion Rate', 'Creative Performance', 'Website Creation', 'Funnel Audit'] as $service)
                <option value="{{ $service }}" @selected(old('service', $caseStudy->service) === $service)>{{ $service }}</option>
            @endforeach
        </select>
    </label>

    <label>Status
        <select name="status" required>
            <option value="draft" @selected(old('status', $caseStudy->status ?: 'draft') === 'draft')>Bozza</option>
            <option value="published" @selected(old('status', $caseStudy->status) === 'published')>Pubblicato</option>
        </select>
    </label>

    <label class="admin-form-field-wide">Summary
        <textarea name="summary" rows="4" required>{{ old('summary', $caseStudy->summary) }}</textarea>
    </label>

    <label class="admin-form-field-wide">Challenge
        <textarea name="challenge" rows="5" required>{{ old('challenge', $caseStudy->challenge) }}</textarea>
    </label>

    <label class="admin-form-field-wide">Solution
        <textarea name="solution" rows="5" required>{{ old('solution', $caseStudy->solution) }}</textarea>
    </label>

    <label class="admin-form-field-wide">Result
        <textarea name="result" rows="5" required>{{ old('result', $caseStudy->result) }}</textarea>
    </label>

    <label>Visual image URL/path
        <input type="text" name="visual_image" value="{{ old('visual_image', $caseStudy->visual_image) }}" placeholder="/images/case-study.png oppure URL">
    </label>

    <label>Visual label
        <input type="text" name="visual_label" value="{{ old('visual_label', $caseStudy->visual_label) }}" placeholder="Landing mockup, CRO board...">
    </label>

    <label class="admin-form-field-wide">Visual caption
        <input type="text" name="visual_caption" value="{{ old('visual_caption', $caseStudy->visual_caption) }}">
    </label>

    <label class="admin-form-field-wide">Before
        <textarea name="before_state" rows="4">{{ old('before_state', $caseStudy->before_state) }}</textarea>
    </label>

    <label class="admin-form-field-wide">After
        <textarea name="after_state" rows="4">{{ old('after_state', $caseStudy->after_state) }}</textarea>
    </label>

    <label class="admin-form-field-wide">Problemi risolti
        <textarea name="problems_solved" rows="5" placeholder="Un problema per riga">{{ old('problems_solved', $caseStudy->problems_solved) }}</textarea>
    </label>

    <label class="admin-form-field-wide">Testimonial quote
        <textarea name="testimonial_quote" rows="4">{{ old('testimonial_quote', $caseStudy->testimonial_quote) }}</textarea>
    </label>

    <label>Testimonial author
        <input type="text" name="testimonial_author" value="{{ old('testimonial_author', $caseStudy->testimonial_author) }}">
    </label>

    <label>Testimonial role
        <input type="text" name="testimonial_role" value="{{ old('testimonial_role', $caseStudy->testimonial_role) }}">
    </label>

    <label>Metric 1 label
        <input type="text" name="metric_one_label" value="{{ old('metric_one_label', $caseStudy->metric_one_label) }}">
    </label>

    <label>Metric 1 value
        <input type="text" name="metric_one_value" value="{{ old('metric_one_value', $caseStudy->metric_one_value) }}">
    </label>

    <label>Metric 2 label
        <input type="text" name="metric_two_label" value="{{ old('metric_two_label', $caseStudy->metric_two_label) }}">
    </label>

    <label>Metric 2 value
        <input type="text" name="metric_two_value" value="{{ old('metric_two_value', $caseStudy->metric_two_value) }}">
    </label>

    <label>Metric 3 label
        <input type="text" name="metric_three_label" value="{{ old('metric_three_label', $caseStudy->metric_three_label) }}">
    </label>

    <label>Metric 3 value
        <input type="text" name="metric_three_value" value="{{ old('metric_three_value', $caseStudy->metric_three_value) }}">
    </label>

    <div class="admin-form-actions">
        <a class="admin-danger-button" href="{{ route('admin.case-studies.index') }}">Annulla</a>
        <button class="brutal-button" type="submit">Salva case study</button>
    </div>
</div>
