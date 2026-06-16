<?php

namespace App\Http\Controllers;

use App\Models\Quote;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

class QuoteController extends Controller
{
    public function show(Request $request, Quote $quote): View
    {
        return $this->render($request, $quote);
    }

    public function access(Request $request, Quote $quote): RedirectResponse
    {
        $validated = $request->validate([
            'access_code' => ['required', 'string', 'max:20'],
        ]);

        if (! hash_equals((string) config('quotes.access_code'), $validated['access_code'])) {
            return back()
                ->withErrors(['access_code' => 'Codice non valido.'])
                ->onlyInput('access_code');
        }

        $request->session()->put($this->sessionKey($quote), true);

        return redirect()->route('quotes.show', $quote);
    }

    public function pdf(Request $request, Quote $quote): Response|RedirectResponse
    {
        if (! $this->hasAccess($request, $quote)) {
            return redirect()->route('quotes.show', $quote);
        }

        $quote->load('items');

        $pdf = Pdf::loadView('pdfs.quote', [
            'quote' => $quote,
        ])->setPaper('a4');

        return $pdf->download($this->pdfFilename($quote));
    }

    public function logout(Request $request, Quote $quote): RedirectResponse
    {
        $request->session()->forget($this->sessionKey($quote));

        return redirect()->route('quotes.show', $quote);
    }

    private function render(Request $request, Quote $quote): View
    {
        return view('pages.quote', [
            'quote' => $quote->load('items'),
            'hasAccess' => $this->hasAccess($request, $quote),
        ]);
    }

    private function hasAccess(Request $request, Quote $quote): bool
    {
        return (bool) $request->session()->get($this->sessionKey($quote));
    }

    private function sessionKey(Quote $quote): string
    {
        return 'quote_access_'.$quote->id;
    }

    private function pdfFilename(Quote $quote): string
    {
        $base = $quote->title ?: 'preventivo-'.$quote->client_name;

        return Str::slug($base).'.pdf';
    }
}
