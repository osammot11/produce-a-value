@extends('layouts.admin')

@section('title', 'Modifica Case Study | Admin PAV')

@section('content')
    <main class="admin-brutal">
        <section class="admin-form-heading admin-page-heading">
            <div>
                <p class="page-brutal-kicker">Case study</p>
                <h1>Modifica case study.</h1>
                <p>{{ $caseStudy->title }}</p>
            </div>
        </section>

        <section class="admin-form-panel">
            <form class="admin-case-form" action="{{ route('admin.case-studies.update', $caseStudy) }}" method="post">
                @csrf
                @method('put')
                @include('admin.case-studies.form')
            </form>
        </section>
    </main>
@endsection
