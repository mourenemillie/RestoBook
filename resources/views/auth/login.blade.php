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
        <div class="password-input-wrapper" style="margin-bottom: 22px;">
            <input type="password" name="password" placeholder="••••••••" required>
            <button type="button" class="password-toggle-btn" aria-label="Toggle password visibility">
                <svg viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
            </button>
        </div>
        <button type="submit" class="btn">Login</button>
    </form>

    <div class="register-link">
        Belum punya akun? <a href="/register">Daftar sekarang</a>
    </div>
@endsection

@push('scripts')
<script>
    document.querySelectorAll('.password-toggle-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const input = this.previousElementSibling;
            const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
            input.setAttribute('type', type);
            
            if (type === 'text') {
                this.innerHTML = '<svg viewBox="0 0 24 24"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line></svg>';
            } else {
                this.innerHTML = '<svg viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>';
            }
        });
    });
</script>
@endpush
