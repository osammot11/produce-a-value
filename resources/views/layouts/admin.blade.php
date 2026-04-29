<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Admin | Produce a Value')</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>

<body class="admin-brutal-body">
    <header class="admin-brutal-header">
        <a href="{{ route('admin.dashboard') }}" class="admin-brutal-brand">
            <span>PAV.</span>
            <strong>Admin</strong>
        </a>

        @if (session('admin_authenticated'))
            <nav class="admin-brutal-nav" aria-label="Navigazione admin">
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                <a href="{{ route('admin.case-studies.index') }}">Case study</a>
                <a href="{{ route('admin.audits.index') }}">Audit</a>
                <a href="{{ route('admin.resource-leads.index') }}">Risorse</a>
                <a href="{{ route('admin.contacts.index') }}">Contatti</a>
                <a href="{{ url('/') }}">Sito</a>
            </nav>

            <form action="{{ route('admin.logout') }}" method="post">
                @csrf
                <button class="admin-brutal-logout" type="submit">Logout</button>
            </form>
        @endif
    </header>

    @yield('content')
</body>

</html>
