@extends('layouts.admin')

@section('title', 'Nuovo Case Study | Admin PAV')

@section('content')
    <main class="admin-brutal">
        <section class="admin-form-heading admin-page-heading">
            <div>
                <p class="page-brutal-kicker">Case study</p>
                <h1>Nuovo proof asset.</h1>
                <p>Inserisci una storia sintetica ma abbastanza concreta da poter vendere il metodo.</p>
            </div>
        </section>

        <section class="admin-form-panel">
            <form class="admin-case-form" action="{{ route('admin.case-studies.store') }}" method="post">
                @csrf
                @include('admin.case-studies.form')
            </form>
        </section>
    </main>
@endsection
