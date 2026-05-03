@extends('layouts.auth')

@section('title', 'Buat Akun Baru - RestoBook')

@section('content')
    <div class="brand"><span class="brand-logo">🍴</span>RestoBook</div>
    <h1>Buat Akun Baru</h1>
    <p class="sub">Bergabung bersama ribuan UMKM kuliner di Bandar Lampung.</p>

    @if($errors->any())
        <div class="error">{{ $errors->first() }}</div>
    @endif

    <form action="/register" method="POST">
        @csrf
        <div class="section-title">Saya mendaftar sebagai:</div>
        <div class="role-toggle">
            <label class="role-card {{ old('role', 'customer') === 'customer' ? 'active' : '' }}">
                <input type="radio" name="role" value="customer" {{ old('role', 'customer') === 'customer' ? 'checked' : '' }}>
                <div class="role-card-icon">👤</div>
                <div class="role-card-title">Customer</div>
            </label>
            <label class="role-card {{ old('role') === 'owner' ? 'active' : '' }}">
                <input type="radio" name="role" value="owner" {{ old('role') === 'owner' ? 'checked' : '' }}>
                <div class="role-card-icon">🏪</div>
                <div class="role-card-title">Pemilik Restoran</div>
            </label>
        </div>

        <div class="fields-grid">
            <div class="field-group full-width">
                <label for="name">Nama Lengkap</label>
                <input id="name" type="text" name="name" placeholder="Masukkan nama lengkap Anda" value="{{ old('name') }}" required>
            </div>
            <div class="field-group">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" placeholder="contoh@email.com" value="{{ old('email') }}" required>
            </div>
            <div class="field-group">
                <label for="phone">No. Telepon</label>
                <input id="phone" type="text" name="phone" placeholder="08xx xxxx xxxx" value="{{ old('phone') }}" required>
            </div>
            <div class="field-group">
                <label for="password">Password</label>
                <input id="password" type="password" name="password" placeholder="Minimal 8 karakter" required>
            </div>
            <div class="field-group">
                <label for="password_confirmation">Konfirmasi Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" placeholder="Ulangi password" required>
            </div>
        </div>

        <label class="terms">
            <input type="checkbox" name="terms" required>
            Saya menyetujui <a href="#">Syarat & Ketentuan</a> serta <a href="#">Kebijakan Privasi</a> yang berlaku.
        </label>

        <button type="submit" class="btn">Daftar Sekarang</button>
    </form>

    <div class="bottom-text">
        Sudah punya akun? <a href="/login">Masuk di sini</a>
    </div>
@endsection

@push('scripts')
<script>
    document.querySelectorAll('.role-card').forEach(card => {
        card.addEventListener('click', () => {
            document.querySelectorAll('.role-card').forEach(c => c.classList.remove('active'));
            card.classList.add('active');
        });
    });
</script>
@endpush
