<?php

use App\Models\AuditSubmission;
use App\Models\CaseStudy;
use App\Models\ContactSubmission;
use App\Models\ResourceLead;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminCaseStudyController;
use Illuminate\Http\Request;
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
Route::view('/contatti', 'pages.contatti')->name('contatti');
Route::post('/contatti', function (Request $request) {
    $validated = $request->validate([
        'name' => ['required', 'string', 'max:120'],
        'email' => ['required', 'email', 'max:160'],
        'budget' => ['nullable', 'string', 'max:80'],
        'message' => ['required', 'string', 'max:1000'],
    ]);

    ContactSubmission::create($validated);

    return redirect()->route('contatti')->with('status', 'Richiesta inviata. Ti ricontatteremo se c\'è fit.');
})->name('contatti.store');
Route::view('/audit', 'pages.audit')->name('audit');
Route::post('/audit', function (Request $request) {
    $validated = $request->validate([
        'name' => ['required', 'string', 'max:120'],
        'email' => ['required', 'email', 'max:160'],
        'company' => ['required', 'string', 'max:160'],
        'website' => ['nullable', 'string', 'max:180'],
        'role' => ['nullable', 'string', 'max:120'],
        'business_type' => ['required', 'string', 'max:80'],
        'market' => ['nullable', 'string', 'max:160'],
        'average_order_value' => ['nullable', 'string', 'max:80'],
        'channels' => ['nullable', 'array'],
        'channels.*' => ['string', 'max:80'],
        'monthly_ad_budget' => ['nullable', 'string', 'max:80'],
        'main_problem' => ['required', 'string', 'max:120'],
        'monthly_revenue' => ['nullable', 'string', 'max:80'],
        'conversion_rate' => ['nullable', 'string', 'max:80'],
        'monthly_sales' => ['nullable', 'string', 'max:80'],
        'ltv' => ['nullable', 'string', 'max:80'],
        'goal_90_days' => ['required', 'string', 'max:1000'],
        'project_budget' => ['required', 'string', 'max:80'],
        'timeline' => ['required', 'string', 'max:80'],
        'decision_maker' => ['required', 'string', 'max:80'],
        'ready_to_act' => ['required', 'boolean'],
        'notes' => ['nullable', 'string', 'max:1000'],
        'privacy_consent' => ['accepted'],
    ]);

    unset($validated['privacy_consent']);

    AuditSubmission::create($validated);

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
