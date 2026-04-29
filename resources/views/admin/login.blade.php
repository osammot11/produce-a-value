@extends('layouts.admin')

@section('title', 'Login Admin | Produce a Value')

@section('content')
    <main class="admin-login-brutal">
        <section class="admin-login-panel">
            <p class="page-brutal-kicker">Admin access</p>
            <h1>Entra nella macchina.</h1>
            <p>Accesso riservato per leggere audit, lead magnet e richieste contatto.</p>

            <form action="{{ route('admin.authenticate') }}" method="post">
                @csrf

                @error('email')
                    <div class="admin-error-brutal">{{ $message }}</div>
                @enderror

                <label>Email
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus>
                </label>

                <label>Password
                    <input type="password" name="password" required>
                </label>

                <button class="brutal-button" type="submit">Login</button>
            </form>
        </section>
    </main>
@endsection
