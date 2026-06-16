@extends('layouts.admin')

@section('title', 'Modifica Preventivo | Admin PAV')

@section('content')
    <main class="admin-brutal">
        <section class="admin-form-heading">
            <p class="page-brutal-kicker">Modifica preventivo</p>
            <h1>{{ $quote->title ?: 'Preventivo per '.$quote->client_name }}</h1>
            <p>Aggiorna proposta, servizi e totale.</p>
        </section>

        <section class="admin-form-panel">
            <form class="admin-case-form" action="{{ route('admin.quotes.update', $quote) }}" method="post" data-admin-quote-form>
                @csrf
                @method('put')
                @include('admin.quotes.form')
            </form>
        </section>
    </main>
@endsection
