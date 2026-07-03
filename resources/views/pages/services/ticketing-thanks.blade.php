@extends('layouts.landing-page')

@section('title', 'Richiesta ricevuta | Produce a Value')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/ticketing.css') }}">
@endpush

@section('content')
    <main class="ticketing-page">
        <section class="section hero">
            <div class="container">
                <p class="eyebrow">Richiesta ricevuta</p>
                <h1>Ora prenota la call gratuita.</h1>
                <p class="subheadline">
                    Scegli giorno e orario: guardiamo insieme il tuo evento e capiamo se ha senso costruire una demo del
                    sistema di ticketing custom.
                </p>
            </div>
        </section>

        <section class="section" id="call">
            <div class="container">
                <div
                    class="cal-box cal-booking"
                    data-cal-booking
                    data-slots-url="{{ route('services.ticketing-custom.slots') }}"
                    data-book-url="{{ route('services.ticketing-custom.book-call') }}"
                    data-thanks-url="{{ route('services.ticketing-custom.call-thanks') }}"
                    data-timezone="{{ config('services.cal.timezone') }}"
                >
                    <div class="cal-booking-progress" aria-label="Avanzamento prenotazione">
                        <span class="is-active" data-cal-progress-step="0">Giorno</span>
                        <span data-cal-progress-step="1">Orario</span>
                        <span data-cal-progress-step="2">Dettagli</span>
                    </div>

                    <div class="cal-booking-steps">
                        <div class="cal-booking-step is-active" data-cal-booking-step>
                            <div class="cal-booking-panel">
                                <span class="eyebrow">1 / Giorno</span>
                                <h3>Scegli il giorno della call.</h3>
                                <div class="cal-slot-status" data-cal-status>Caricamento slot disponibili...</div>
                                <div class="cal-days" data-cal-days></div>
                            </div>
                        </div>

                        <div class="cal-booking-step" data-cal-booking-step>
                            <div class="cal-booking-panel">
                                <span class="eyebrow">2 / Orario</span>
                                <h3>Scegli l'orario che preferisci.</h3>
                                <p class="cal-slot-status" data-cal-selected-day></p>
                                <div class="cal-slots" data-cal-slots></div>
                                <button class="button-secondary cal-back-button" type="button" data-cal-back>Torna ai giorni</button>
                            </div>
                        </div>

                        <form class="cal-booking-step cal-booking-panel cal-booking-form" data-cal-form data-cal-booking-step>
                            <span class="eyebrow">3 / Dettagli contatto</span>
                            <h3>Conferma i dati per ricevere invito e link.</h3>
                            <p class="cal-slot-status" data-cal-selected-slot></p>
                            <input type="hidden" name="source" value="produceavalue_ticketing">
                            <input type="hidden" name="start" data-cal-start>

                            <label>Nome
                                <input type="text" name="name" required>
                            </label>

                            <label>Email
                                <input type="email" name="email" required>
                            </label>

                            <label>Telefono
                                <input type="tel" name="phone" required>
                            </label>

                            <label>Note per la call
                                <textarea name="notes" rows="5" placeholder="Nome evento, sistema attuale, numero iscritti o priorità da discutere."></textarea>
                            </label>

                            <button class="button-secondary cal-back-button" type="button" data-cal-back>Torna agli orari</button>
                            <button class="btn fullwidth" type="submit" data-cal-submit disabled>Prenota call gratuita</button>
                            <div class="cal-booking-loader" data-cal-loader aria-hidden="true">
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                                <strong>Stiamo confermando la call con Cal.com...</strong>
                            </div>
                            <p class="cal-booking-message" data-cal-message></p>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
