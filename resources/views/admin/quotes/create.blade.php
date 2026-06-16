@extends('layouts.admin')

@section('title', 'Nuovo Preventivo | Admin PAV')

@section('content')
    <main class="admin-brutal">
        <section class="admin-form-heading">
            <p class="page-brutal-kicker">Nuovo preventivo</p>
            <h1>Crea proposta.</h1>
            <p>Compila cliente, servizi, IVA e business plan opzionale.</p>
        </section>

        <section class="admin-form-panel">
            <form class="admin-case-form" action="{{ route('admin.quotes.store') }}" method="post" data-admin-quote-form>
                @csrf
                @include('admin.quotes.form')
            </form>
        </section>
    </main>
@endsection
