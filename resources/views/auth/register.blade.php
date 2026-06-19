@extends('layouts.auth')

@section('title', 'Buat Akun Baru - RestoBook')

@section('content')
    <div class="brand"><span class="brand-logo">🍴</span>RestoBook</div>
    <h1>Buat Akun Baru</h1>
    <p class="sub">Bergabung bersama ribuan UMKM kuliner di Bandar Lampung.</p>

    @if($errors->any())
        <div class="error">{{ $errors->first() }}</div>
    @endif

    <form action="/register" method="POST" autocomplete="off">
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
            
            <div class="field-group full-width owner-field" style="display: {{ old('role') === 'owner' ? 'flex' : 'none' }};">
                <label for="restaurant_name">Nama Restoran</label>
                <input id="restaurant_name" type="text" name="restaurant_name" placeholder="Masukkan nama restoran Anda" value="{{ old('restaurant_name') }}">
            </div>
            <div class="field-group full-width owner-field" style="display: {{ old('role') === 'owner' ? 'flex' : 'none' }};">
                <label for="location">Lokasi</label>
                <input id="location" type="text" name="location" placeholder="Alamat Lengkap Restoran" value="{{ old('location') }}">
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
                <div class="password-input-wrapper">
                    <input id="password" type="password" name="password" placeholder="Minimal 8 karakter" required>
                    <button type="button" class="password-toggle-btn" aria-label="Toggle password visibility">
                        <svg viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                    </button>
                </div>
            </div>
            <div class="field-group">
                <label for="password_confirmation">Konfirmasi Password</label>
                <div class="password-input-wrapper">
                    <input id="password_confirmation" type="password" name="password_confirmation" placeholder="Ulangi password" required>
                    <button type="button" class="password-toggle-btn" aria-label="Toggle password visibility">
                        <svg viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                    </button>
                </div>
            </div>
        </div>

        <label class="terms">
            <input type="checkbox" name="terms" required>
            <span>Saya menyetujui <a href="#">Syarat & Ketentuan</a> serta <a href="#">Kebijakan Privasi</a> yang berlaku.</span>
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
            
            const radio = card.querySelector('input[type="radio"]');
            radio.checked = true;
            
            const ownerFields = document.querySelectorAll('.owner-field');
            if (radio.value === 'owner') {
                ownerFields.forEach(field => {
                    field.style.display = 'flex';
                    field.querySelector('input').setAttribute('required', 'required');
                });
            } else {
                ownerFields.forEach(field => {
                    field.style.display = 'none';
                    field.querySelector('input').removeAttribute('required');
                });
            }
        });
    });

    // Password visibility toggle
    document.querySelectorAll('.password-toggle-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const input = this.previousElementSibling;
            const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
            input.setAttribute('type', type);
            
            // Toggle icon visual
            if (type === 'text') {
                this.innerHTML = '<svg viewBox="0 0 24 24"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line></svg>';
            } else {
                this.innerHTML = '<svg viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>';
            }
        });
    });


</script>
@endpush
