@extends('layouts.auth')

@section('title', 'Login - RestoBook')

@section('content')
    <div class="brand"><span class="brand-logo">🍴</span>RestoBook</div>
    <h1>Selamat Datang!</h1>
    <p class="sub">Login untuk melanjutkan reservasi kamu.</p>

    @if(session('success'))
        <div class="success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="error">{{ $errors->first() }}</div>
    @endif

    <form action="/login" method="POST">
        @csrf
        <label class="field-label">Email</label>
        <input type="email" name="email" placeholder="nama@email.com" value="{{ old('email') }}" required>
        <div class="password-row">
            <label class="field-label">Password</label>
            <a href="/password/reset" class="forgot-link">Lupa Password?</a>
        </div>
        <input type="password" name="password" placeholder="••••••••" required>
        <button type="submit" class="btn">Login</button>
    </form>

    <div class="register-link">
        Belum punya akun? <a href="/register">Daftar sekarang</a>
    </div>
@endsection
