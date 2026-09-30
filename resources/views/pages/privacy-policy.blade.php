@extends('layouts.app')

@section('title', 'Privacy Policy | Produce a Value')

@section('content')
    <main>
        <section class="section section-hero">
            <div class="shell split">
                <div class="panel-dark sticky-panel">
                    <p class="kicker kicker-large">Legal</p>
                    <h1 class="heading-section">Privacy Policy</h1>
                    <p class="copy-light copy-wide">Informativa provvisoria da completare prima della pubblicazione definitiva del sito.</p>
                </div>

                <div class="card card-cream content-panel">
                    <h2>Titolare del trattamento</h2>
                    <p>Produce a Value tratterà i dati personali raccolti tramite il sito secondo la normativa applicabile.</p>

                    <h2>Dati raccolti</h2>
                    <p>Potranno essere raccolti dati di contatto, informazioni inviate tramite form audit, richieste risorsa e dati tecnici di navigazione. Con il consenso marketing, il sito usa anche Meta Pixel e Conversions API come descritto nella <a href="{{ route('cookie-policy') }}">Cookie Policy</a>.</p>

                    <h2>Finalità</h2>
                    <p>I dati saranno usati per rispondere alle richieste e gestire i contatti commerciali. Se acconsenti al tracciamento marketing, gli eventi di visita e conversione saranno condivisi con Meta per misurare le campagne pubblicitarie.</p>

                    <h2>Diritti</h2>
                    <p>Gli utenti potranno richiedere accesso, rettifica, cancellazione o limitazione del trattamento.</p>
                </div>
            </div>
        </section>
    </main>
@endsection
