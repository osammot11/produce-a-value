<?php

use App\Models\AuditSubmission;
use App\Models\CaseStudy;
use App\Models\ContactSubmission;
use App\Models\ResourceLead;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminCaseStudyController;
use App\Mail\AuditSubmissionReceived;
use App\Mail\ContactSubmissionReceived;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.home');
});

Route::view('/servizi', 'pages.servizi')->name('servizi');
Route::view('/servizi/landing-page', 'pages.services.landing-page')->name('services.landing-page');
Route::view('/servizi/conversion-rate', 'pages.services.conversion-rate')->name('services.conversion-rate');
Route::view('/servizi/creative-performance', 'pages.services.creative-performance')->name('services.creative-performance');
Route::get('/work', function () {
    return view('pages.work', [
        'caseStudies' => CaseStudy::published()->latest('published_at')->get(),
    ]);
})->name('work');
Route::get('/work/{caseStudy:slug}', function (CaseStudy $caseStudy) {
    abort_unless($caseStudy->status === 'published', 404);

    return view('pages.case-study', [
        'caseStudy' => $caseStudy,
    ]);
})->name('case-studies.show');
Route::view('/manifesto', 'pages.manifesto')->name('manifesto');
Route::get('/contatti', function (Request $request) {
    $request->session()->put('contact_form_started_at', now()->timestamp);

    return view('pages.contatti');
})->name('contatti');
Route::post('/contatti', function (Request $request) {
    $startedAt = (int) $request->session()->get('contact_form_started_at', 0);
    $submittedTooFast = $startedAt === 0 || now()->timestamp - $startedAt < 3;
    $honeypotFilled = filled($request->input('company_website'));

    if ($submittedTooFast || $honeypotFilled) {
        return redirect()->route('contatti')->with('status', 'Richiesta inviata. Ti ricontatteremo se c\'è fit.');
    }

    $validated = $request->validate([
        'name' => ['required', 'string', 'max:120'],
        'email' => ['required', 'email', 'max:160'],
        'budget' => ['nullable', 'string', 'max:80'],
        'message' => ['required', 'string', 'min:20', 'max:1000'],
    ]);

    $validated['ip_address'] = $request->ip();
    $validated['user_agent'] = mb_substr((string) $request->userAgent(), 0, 1000);

    $contact = ContactSubmission::create($validated);
    $request->session()->forget('contact_form_started_at');

    if ($recipient = config('lead-notifications.email')) {
        try {
            Mail::to($recipient)->send(new ContactSubmissionReceived($contact));
        } catch (Throwable $exception) {
            Log::warning('Contact notification email failed.', [
                'contact_submission_id' => $contact->id,
                'error' => $exception->getMessage(),
            ]);
        }
    }

    return redirect()->route('contatti')->with('status', 'Richiesta inviata. Ti ricontatteremo se c\'è fit.');
})->middleware('throttle:4,1')->name('contatti.store');
Route::view('/audit', 'pages.audit')->name('audit');
Route::post('/audit', function (Request $request) {
    $validated = $request->validate([
        'name' => ['required', 'string', 'max:120'],
        'email' => ['required', 'email', 'max:160'],
        'phone' => ['required', 'string', 'max:40'],
        'brand_name' => ['required', 'string', 'max:160'],
        'ecommerce_url' => ['required', 'url', 'max:180'],
        'online_since' => ['required', 'string', 'max:80'],
        'product_audience' => ['required', 'string', 'max:1200'],
        'monthly_revenue_range' => ['required', 'string', 'max:80'],
        'monthly_ads_spend_range' => ['required', 'string', 'max:80'],
        'aov_range' => ['required', 'string', 'max:80'],
        'ads_profitability' => ['required', 'string', 'max:120'],
        'monthly_orders_range' => ['required', 'string', 'max:80'],
        'repeat_purchase_rate' => ['required', 'string', 'max:120'],
        'channels' => ['required', 'array', 'min:1'],
        'channels.*' => ['string', 'max:80'],
        'current_strategy' => ['required', 'string', 'max:160'],
        'bottleneck' => ['required', 'string', 'max:160'],
        'goal_90_days' => ['required', 'string', 'max:1000'],
        'biggest_obstacle' => ['required', 'string', 'max:1000'],
        'privacy_consent' => ['accepted'],
    ]);

    unset($validated['privacy_consent']);

    $validated['company'] = $validated['brand_name'];
    $validated['website'] = $validated['ecommerce_url'];
    $validated['business_type'] = 'Ecommerce';
    $validated['average_order_value'] = $validated['aov_range'];
    $validated['monthly_ad_budget'] = $validated['monthly_ads_spend_range'];
    $validated['main_problem'] = $validated['bottleneck'];
    $validated['monthly_revenue'] = $validated['monthly_revenue_range'];
    $validated['monthly_sales'] = $validated['monthly_orders_range'];
    $validated['notes'] = $validated['biggest_obstacle'];
    $validated['project_budget'] = 'RADAR strategico';
    $validated['timeline'] = 'Prossimi 90 giorni';
    $validated['decision_maker'] = 'Non richiesto nel RADAR';
    $validated['ready_to_act'] = true;

    $audit = AuditSubmission::create($validated);

    if ($recipient = config('lead-notifications.email')) {
        try {
            Mail::to($recipient)->send(new AuditSubmissionReceived($audit));
        } catch (Throwable $exception) {
            Log::warning('Audit notification email failed.', [
                'audit_submission_id' => $audit->id,
                'error' => $exception->getMessage(),
            ]);
        }
    }

    return redirect()->route('audit.thanks');
})->name('audit.store');
Route::view('/audit/richiesto', 'pages.audit-thanks')->name('audit.thanks');
Route::view('/risorsa', 'pages.risorsa')->name('risorsa');
Route::post('/risorsa', function (Request $request) {
    $validated = $request->validate([
        'name' => ['nullable', 'string', 'max:120'],
        'email' => ['required', 'email', 'max:160'],
        'business_type' => ['nullable', 'string', 'max:80'],
        'privacy_consent' => ['accepted'],
    ]);

    unset($validated['privacy_consent']);

    ResourceLead::create($validated);

    return redirect()->route('risorsa.thanks');
})->name('risorsa.store');
Route::view('/risorsa/ricevuta', 'pages.risorsa-thanks')->name('risorsa.thanks');
Route::view('/privacy-policy', 'pages.privacy-policy')->name('privacy-policy');
Route::view('/cookie-policy', 'pages.cookie-policy')->name('cookie-policy');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminController::class, 'login'])->name('login');
    Route::post('/login', [AdminController::class, 'authenticate'])->name('authenticate');
    Route::post('/logout', [AdminController::class, 'logout'])->name('logout');

    Route::middleware('admin')->group(function () {
        Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/audit', [AdminController::class, 'audits'])->name('audits.index');
        Route::get('/audit/export', [AdminController::class, 'exportAudits'])->name('audits.export');
        Route::get('/audit/{auditSubmission}', [AdminController::class, 'audit'])->name('audits.show');
        Route::put('/audit/{auditSubmission}/crm', [AdminController::class, 'updateAuditCrm'])->name('audits.crm.update');
        Route::get('/risorse', [AdminController::class, 'resourceLeads'])->name('resource-leads.index');
        Route::get('/contatti', [AdminController::class, 'contacts'])->name('contacts.index');
        Route::resource('case-study', AdminCaseStudyController::class)
            ->parameters(['case-study' => 'caseStudy'])
            ->names('case-studies');
    });
});
