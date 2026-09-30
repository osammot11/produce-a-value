@extends('layouts.app')

@section('title', 'Cookie Policy | Produce a Value')

@section('content')
    <main>
        <section class="section section-hero">
            <div class="shell split">
                <div class="panel-dark sticky-panel">
                    <p class="kicker kicker-large">Legal</p>
                    <h1 class="heading-section">Cookie Policy</h1>
                    <p class="copy-light copy-wide">Qui trovi gli strumenti usati sul sito e come gestire il consenso.</p>
                </div>

                <div class="card card-cream content-panel">
                    <h2>Cookie necessari</h2>
                    <p>Il sito usa cookie di sessione per il funzionamento dei moduli e la sicurezza. Un cookie tecnico conserva per 180 giorni la tua scelta sul tracciamento marketing, così non dobbiamo chiedertela a ogni visita.</p>

                    <h2>Meta Pixel e Conversions API</h2>
                    <p>Solo se accetti, usiamo Meta Pixel per misurare le visite e gli eventi di conversione. Il Pixel può impostare identificatori come _fbp e _fbc. Dopo una richiesta o una prenotazione riuscita, possiamo inviare a Meta lo stesso evento dal server tramite Conversions API. L'invio può includere email e telefono in forma hash, indirizzo IP, user agent e identificatori del Pixel. I due invii condividono un ID evento per evitare conteggi doppi.</p>
                    <p>Questi dati servono a misurare le campagne pubblicitarie e le richieste generate. Maggiori informazioni sul trattamento da parte di Meta sono disponibili nella <a href="https://www.facebook.com/privacy/policy/" rel="noopener noreferrer" target="_blank">Privacy Policy di Meta</a>.</p>

                    <h2>Le tue preferenze</h2>
                    <p>Puoi accettare o rifiutare dal banner senza limitare l'uso del sito. Puoi cambiare scelta in qualsiasi momento tramite “Preferenze cookie” nel footer. Il rifiuto o la revoca impediscono nuovi invii Meta; la revoca rimuove anche gli identificatori del Pixel presenti nel browser.</p>
                </div>
            </div>
        </section>
    </main>
@endsection
