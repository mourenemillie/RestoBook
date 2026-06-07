@extends('layouts.app')

@section('title', 'Beranda - RestoBook Lampung')

@section('extra_styles')
<style>
   .success-alert{
    position: fixed;
    top: 20px;
    right: 20px;
    background: #BC4B09;
    color: white;
    padding: 14px 22px;
    border-radius: 14px;
    font-weight: 600;
    box-shadow: 0 10px 25px rgba(188,75,9,.25);
    z-index: 9999;
    animation: slideIn .3s ease;
}

@keyframes slideIn{
    from{
        opacity:0;
        transform:translateX(30px);
    }
    to{
        opacity:1;
        transform:translateX(0);
    }
}
/* ===== HERO ===== */
.hero { padding: 96px 48px 128px; max-width: 1280px; margin: 0 auto; }
.hero-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 64px; align-items: center; min-height: 700px; }
.hero-badge { background: #ffc78a; color: #683e00; font-size: 13px; font-weight: 800; letter-spacing: 1.4px; text-transform: uppercase; padding: 6px 16px; border-radius: 9999px; display: inline-block; margin-bottom: 16px; }
.hero-title { font-size: 56px; font-weight: 800; color: #2c2f2e; letter-spacing: -2.8px; line-height: 1.1; margin-bottom: 16px; }
.hero-title span { font-style: italic; color: #8c4a00; font-family: Georgia, serif; }
.hero-desc { color: #595c5a; font-size: 16px; line-height: 1.7; margin-bottom: 32px; max-width: 448px; }
.search-bar { background: white; border-radius: 9999px; padding: 8px; display: flex; align-items: center; gap: 8px; box-shadow: 0 25px 50px -12px rgba(44,47,46,0.05); max-width: 600px; }
.search-bar input { border: none; outline: none; font-family: 'Plus Jakarta Sans', sans-serif; font-size: 15px; color: #747776; padding: 10px 12px; flex: 1; background: transparent; }
.search-bar .divider { width: 1px; height: 24px; background: #e6e9e6; }
.search-btn { background: linear-gradient(135deg, #8c4a00 0%, #fd8b00 100%); border: none; border-radius: 9999px; width: 48px; height: 48px; display: flex; align-items: center; justify-content: center; cursor: pointer; flex-shrink: 0; }
.search-btn svg { width: 18px; height: 18px; fill: white; }
.hero-image-wrap { position: relative; }
.hero-image { width: 100%; height: 700px; object-fit: cover; border-radius: 48px; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.25); }
.floating-card { position: absolute; bottom: -32px; left: -48px; background: white; border-radius: 32px; padding: 24px; max-width: 300px; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1); }
.floating-card-inner { display: flex; align-items: center; gap: 16px; margin-bottom: 12px; }
.floating-icon { background: #ffd33a; border-radius: 9999px; width: 48px; height: 48px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; font-size: 20px; }
.floating-card h4 { font-size: 16px; font-weight: 700; color: #2c2f2e; }
.floating-card p { font-size: 12px; color: #595c5a; }
.floating-card em { font-size: 13px; color: #2c2f2e; font-style: italic; line-height: 1.5; }

/* ===== RESTAURANT SECTION ===== */
.restaurant-section { background: #eff1ef; border-radius: 64px; padding: 96px 48px; }
.restaurant-inner { max-width: 1280px; margin: 0 auto; }
.section-header { display: flex; align-items: flex-end; justify-content: space-between; margin-bottom: 64px; }
.section-title { font-size: 36px; font-weight: 800; color: #2c2f2e; letter-spacing: -0.9px; margin-bottom: 8px; }
.section-sub { font-size: 18px; color: #595c5a; }
.see-all { color: #8c4a00; font-size: 16px; font-weight: 700; text-decoration: none; display: flex; align-items: center; gap: 6px; }
.see-all:hover { text-decoration: underline; }
.restaurant-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 32px; }
.resto-card { background: white; border-radius: 48px; overflow: hidden; }
.resto-img-wrap { position: relative; height: 256px; overflow: hidden; }
.resto-img-wrap img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s; }
.resto-card:hover .resto-img-wrap img { transform: scale(1.05); }
.rating-badge { position: absolute; top: 16px; right: 16px; background: rgba(255,255,255,0.9); backdrop-filter: blur(4px); border-radius: 9999px; padding: 4px 12px 4px 10px; display: flex; align-items: center; gap: 6px; font-size: 14px; font-weight: 700; color: #2c2f2e; }
.rating-badge::before { content: '★'; color: #fbbf24; }
.resto-body { padding: 28px 32px 32px; }
.resto-name { font-size: 22px; font-weight: 700; color: #2c2f2e; margin-bottom: 8px; }
.resto-location { font-size: 14px; color: #595c5a; margin-bottom: 20px; display: flex; align-items: center; gap: 6px; }
.resto-location::before { content: '📍'; font-size: 12px; }
.resto-footer { display: flex; align-items: center; justify-content: space-between; padding-top: 16px; border-top: 1px solid #f0f0f0; }
.badge-available { background: #ffc78a; color: #683e00; font-size: 11px; font-weight: 700; letter-spacing: -0.6px; text-transform: uppercase; padding: 4px 12px; border-radius: 9999px; }
.badge-full { background: #f95630; color: #520c00; font-size: 11px; font-weight: 700; letter-spacing: -0.6px; text-transform: uppercase; padding: 4px 12px; border-radius: 9999px; }
.btn-booking { background: linear-gradient(135deg, #8c4a00 0%, #fd8b00 100%); color: #fff0e7; font-size: 13px; font-weight: 700; padding: 8px 24px; border-radius: 9999px; text-decoration: none; border: none; cursor: pointer; }
.btn-antri { background: #dfe3e0; color: #595c5a; font-size: 13px; font-weight: 700; padding: 8px 24px; border-radius: 9999px; text-decoration: none; }

/* ===== UMKM SECTION ===== */
.umkm-section { padding: 96px 48px; max-width: 1280px; margin: 0 auto; }
.umkm-grid { display: grid; grid-template-columns: 5fr 7fr; gap: 64px; align-items: center; }
.umkm-label { font-size: 13px; font-weight: 800; color: #8c4a00; letter-spacing: 1.4px; text-transform: uppercase; margin-bottom: 16px; }
.umkm-title { font-size: 48px; font-weight: 800; color: #2c2f2e; letter-spacing: -1.2px; line-height: 1; margin-bottom: 16px; }
.umkm-title span { color: #835000; }
.umkm-desc { font-size: 17px; color: #595c5a; line-height: 1.7; margin-bottom: 32px; }
.umkm-feature { display: flex; gap: 20px; margin-bottom: 24px; }
.umkm-feature-icon { font-size: 28px; flex-shrink: 0; margin-top: 4px; }
.umkm-feature h4 { font-size: 18px; font-weight: 700; color: #2c2f2e; margin-bottom: 4px; }
.umkm-feature p { font-size: 15px; color: #595c5a; line-height: 1.5; }
.umkm-cards { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
.umkm-card { background: #e6e9e6; border: 2px dashed rgba(171,174,172,0.3); border-radius: 28px; padding: 24px; }
.umkm-card:nth-child(2) { margin-top: 48px; }
.umkm-card-img { width: 100%; height: 160px; object-fit: cover; border-radius: 8px; margin-bottom: 12px; filter: grayscale(100%); }
.umkm-card h5 { font-size: 15px; font-weight: 700; color: #2c2f2e; margin-bottom: 4px; }
.umkm-card p { font-size: 12px; color: #595c5a; margin-bottom: 16px; }
.btn-kunjungi { width: 100%; background: white; border: 1px solid rgba(140,74,0,0.2); border-radius: 9999px; color: #8c4a00; font-size: 12px; font-weight: 700; padding: 9px; text-align: center; cursor: pointer; display: block; text-decoration: none; }
.btn-kunjungi:hover { background: #fff5ee; }

.resto-hours{
    margin-top: 8px;
    font-size: 14px;
    color: #666;
}

    /* ===== TABLE SECTION ===== */
    .table-section { padding: 96px 48px; max-width: 1280px; margin: 0 auto; }
    .table-card { background: rgba(255,255,255,0.45); backdrop-filter: blur(18px); border: 1px solid rgba(255,255,255,0.8); border-radius: 48px; padding: 40px; }
    .table-card-inner { display: grid; grid-template-columns: 1.4fr 1fr; gap: 32px; align-items: center; }
    .table-preview { background: rgba(255,255,255,0.22); border: 1px dashed rgba(140,74,0,0.25); border-radius: 32px; min-height: 420px; display: flex; align-items: center; justify-content: center; color: #8c4a00; font-size: 16px; font-weight: 700; text-align: center; padding: 24px; }
    .table-preview img { width: 100%; height: 100%; object-fit: cover; border-radius: 32px; }
    .table-detail { display: flex; flex-direction: column; gap: 24px; }
    .table-detail p { color: #595c5a; line-height: 1.8; }
    .table-meta { display: grid; gap: 16px; }
    .table-meta-item { background: rgba(255,255,255,0.7); border-radius: 24px; padding: 18px 20px; border: 1px solid rgba(140,74,0,0.12); }
    .table-meta-item strong { display: block; font-size: 14px; color: #2c2f2e; margin-bottom: 8px; }
    .table-meta-item span { color: #5d5f5d; font-size: 15px; }
    .table-action { display: inline-flex; align-items: center; justify-content: center; gap: 10px; background: #fff; border: 1px solid rgba(140,74,0,0.22); border-radius: 9999px; color: #8c4a00; font-size: 14px; font-weight: 700; padding: 12px 20px; width: fit-content; text-decoration: none; }
    .table-action:hover { background: #fff5ee; }
    @media (max-width: 960px) {
        .table-card-inner { grid-template-columns: 1fr; }
    }
    @media (max-width: 640px) {
        .table-section { padding: 56px 20px; }
    }</style>
@endsection

@section('content')
@if(session('success'))
<div class="success-alert">
    ✅ {{ session('success') }}
</div>
@endif

{{-- HERO SECTION --}}
<section style="background: linear-gradient(90deg, #f5f7f4 0%, #f5f7f4 100%);">
    <div class="hero">
        <div class="hero-grid">
            {{-- KIRI: Text --}}
            <div>
                <span class="hero-badge">PEMBERDAYAAN UMKM</span>
                <h1 class="hero-title">
                    Booking Meja Kini<br>
                    <span>Lebih Mudah</span>
                </h1>
                <p class="hero-desc">
                    Dukung UMKM Kuliner Lokal di Bandar Lampung. Rasakan
                    kemudahan reservasi di kedai favoritmu tanpa antre.
                </p>
                <form action="{{ route('home') }}" method="GET" class="search-bar">
                    <svg style="width:18px;height:18px;fill:#9ca3af;margin-left:16px;flex-shrink:0" viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
                    <input type="text" name="city" value="Bandar Lampung" placeholder="Lokasi...">
                    <div class="divider"></div>
                    <input type="text" name="category" placeholder="Jenis Kuliner...">
                    <button type="submit" class="search-btn">
                        <svg viewBox="0 0 24 24"><path d="M15.5 14h-.79l-.28-.27A6.471 6.471 0 0 0 16 9.5 6.5 6.5 0 1 0 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/></svg>
                    </button>
                </form>
            </div>

            {{-- KANAN: Gambar --}}
            <div class="hero-image-wrap">
                <img class="hero-image"
                    src="https://images.unsplash.com/photo-1555396273-367ea4eb4db5?w=800"
                    alt="Restoran Lampung">
                <div class="floating-card">
                    <div class="floating-card-inner">
                        <div class="floating-icon">🏪</div>
                        <div>
                            <h4>500+ UMKM</h4>
                            <p>Telah Bergabung</p>
                        </div>
                    </div>
                    <em>"Sangat memudahkan manajemen meja di kedai kami!"</em>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- RESTAURANT SECTION --}}
<section id="reservasi" class="restaurant-section">
    <div class="restaurant-inner">
        <div class="section-header">
            <div>
                <h2 class="section-title">Restoran Terpopuler</h2>
                <p class="section-sub">Pilihan terbaik untuk pengalaman kuliner autentik di kota.</p>
            </div>
            <a href="#" class="see-all">Lihat Semua →</a>
        </div>
        <div class="restaurant-grid">
    @forelse($restaurants as $resto)
        <div class="resto-card">
            <div class="resto-img-wrap" onclick="window.location='{{ route('restaurant.show', $resto->id) }}'" style="cursor: pointer;">
                <img src="{{ $resto->image ? asset('storage/'.$resto->image) : 'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?w=400' }}"
                     alt="{{ $resto->name }}">
                <div class="rating-badge">4.8</div>
            </div>

           <div class="resto-body">
    <div class="resto-name" onclick="window.location='{{ route('restaurant.show', $resto->id) }}'" style="cursor: pointer; hover:text-orange-600;">{{ $resto->name }}</div>

    <div class="resto-location">
        {{ $resto->address }}
    </div>

    <div class="resto-hours">
        🕒
        {{ \Carbon\Carbon::parse($resto->open_time)->format('H:i') }}
        -
        {{ \Carbon\Carbon::parse($resto->close_time)->format('H:i') }}
    </div>

    

    <div class="resto-phone">
        📞 {{ $resto->phone }}
    </div>


                <div class="resto-footer">
                    <span class="badge-available">TERSEDIA</span>

                    <a href="{{ route('customer.reservations.create', $resto->id) }}"
                       class="btn-booking">
                        Pesan
                    </a>
                </div>
            </div>
        </div>

    @empty

        @foreach([
            ['name' => 'Sate Padang Begadang', 'address' => 'Jl. Diponegoro, Bandar Lampung', 'img' => 'https://images.unsplash.com/photo-1555396273-367ea4eb4db5?w=400', 'rating' => '4.9', 'status' => 'available'],
            ['name' => 'Bakso Son Haji Sony', 'address' => 'Jl. Wolter Monginsidi, Lampung', 'img' => 'https://images.unsplash.com/photo-1569050467447-ce54b3bbc37d?w=400', 'rating' => '4.7', 'status' => 'full'],
            ['name' => 'Kopi Lampung Hub', 'address' => 'Way Halim, Bandar Lampung', 'img' => 'https://images.unsplash.com/photo-1501339847302-ac426a4a7cbb?w=400', 'rating' => '4.8', 'status' => 'available'],
        ] as $dummy)

            <div class="resto-card">
                <div class="resto-img-wrap" onclick="window.location='{{ route('restaurant.show', 1) }}'" style="cursor: pointer;">
                    <img src="{{ $dummy['img'] }}" alt="{{ $dummy['name'] }}">
                    <div class="rating-badge">{{ $dummy['rating'] }}</div>
                </div>

                <div class="resto-body">
                    <div class="resto-name" onclick="window.location='{{ route('restaurant.show', 1) }}'" style="cursor: pointer; hover:text-orange-600;">{{ $dummy['name'] }}</div>
                    <div class="resto-location">{{ $dummy['address'] }}</div>

                    <div class="resto-footer">
                        @if($dummy['status'] === 'available')
                            <span class="badge-available">TERSEDIA</span>
                            <a href="{{ route('customer.reservations.create', 1) }}" class="btn-booking">Pesan</a>
                        @else
                            <span class="badge-full">PENUH</span>
                            <a href="#" class="btn-booking" style="background:#e0e0e0;color:#999;pointer-events:none">Penuh</a>
                        @endif
                    </div>
                </div>
            </div>

        @endforeach

    @endforelse
</div>
</div>
</section>

{{-- TENTANG RESTO SECTION --}}
<section id="tentang-resto" class="umkm-section">
    <div class="umkm-grid">
        {{-- KIRI: Teks & Fitur --}}
        <div>
            <div class="max-w-xl">
                <p class="umkm-label">TENTANG RESTO</p>
                <h2 class="umkm-title">Tentang<br><span>RestoBook</span></h2>
                <p class="umkm-desc">Kami mendedikasikan platform ini untuk memudahkan reservasi restoran dan mendukung UMKM kuliner.</p>
                <div class="umkm-feature">
                    <div class="umkm-feature-icon">💰</div>
                    <div>
                        <h4>Fee Transaksi 0%</h4>
                        <p>Keuntungan sepenuhnya milik pedagang UMKM.</p>
                    </div>
                </div>
                <div class="umkm-feature">
                    <div class="umkm-feature-icon">📣</div>
                    <div>
                        <h4>Promosi Prioritas</h4>
                        <p>Kedai kecil mendapatkan eksposur lebih luas di aplikasi kami.</p>
                    </div>
                </div>
            </div>
            <div class="umkm-cards">
                <div class="umkm-card">
                    <img class="umkm-card-img" src="https://images.unsplash.com/photo-1565299507177-b0ac66763828?w=400" alt="Martabak">
                    <h5>Martabak Bangka Sari</h5>
                    <p>Kemiling • Cemilan</p>
                    <a href="#" class="btn-kunjungi">Kunjungi</a>
                </div>
                <div class="umkm-card">
                    <img class="umkm-card-img" src="https://images.unsplash.com/photo-1585032226651-759b368d7246?w=400" alt="Mie Ayam">
                    <h5>Mie Ayam Pak Jo</h5>
                    <p>Sukabumi • Mie</p>
                    <a href="#" class="btn-kunjungi">Kunjungi</a>
                </div>
            </div>
        </div>
    </div>
</section>


<script>
setTimeout(function() {
    const alert = document.querySelector('.success-alert');
    if(alert){
        alert.remove();
    }
}, 3000);
</script>



@endsection