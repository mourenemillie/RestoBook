@extends('layouts.app')

@section('title', 'Beranda - RestoBook Lampung')

@section('extra_styles')
<style>
    .success-alert {
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

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateX(30px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
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
    .resto-card { background: white; border-radius: 48px; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); }
    .resto-img-wrap { position: relative; height: 256px; overflow: hidden; }
    .resto-img-wrap img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s; }
    .resto-card:hover .resto-img-wrap img { transform: scale(1.05); }
    .rating-badge { position: absolute; top: 16px; right: 16px; background: rgba(255,255,255,0.9); backdrop-filter: blur(4px); border-radius: 9999px; padding: 4px 12px 4px 10px; display: flex; align-items: center; gap: 6px; font-size: 14px; font-weight: 700; color: #2c2f2e; }
    .rating-badge::before { content: '★'; color: #fbbf24; }
    .resto-body { padding: 28px 32px 32px; }
    .resto-card:hover .resto-name { color: #8c4a00; }
    .resto-name { font-size: 22px; font-weight: 700; color: #2c2f2e; margin-bottom: 8px; transition: color 0.2s ease; }
    .resto-location { font-size: 14px; color: #595c5a; margin-bottom: 20px; display: flex; align-items: center; gap: 6px; }
    .resto-location::before { content: '📍'; font-size: 12px; }
    .resto-hours { margin-top: 8px; font-size: 14px; color: #666; }
    .resto-phone { margin-top: 4px; font-size: 14px; color: #666; }
    .resto-footer { display: flex; align-items: center; justify-content: space-between; padding-top: 16px; border-top: 1px solid #f0f0f0; margin-top: 16px; }
    .badge-available { background: #ffc78a; color: #683e00; font-size: 11px; font-weight: 700; letter-spacing: -0.6px; text-transform: uppercase; padding: 4px 12px; border-radius: 9999px; }
    .badge-full { background: #f95630; color: #520c00; font-size: 11px; font-weight: 700; letter-spacing: -0.6px; text-transform: uppercase; padding: 4px 12px; border-radius: 9999px; }
    .btn-booking { background: linear-gradient(135deg, #8c4a00 0%, #fd8b00 100%); color: #fff0e7; font-size: 13px; font-weight: 700; padding: 8px 24px; border-radius: 9999px; text-decoration: none; border: none; cursor: pointer; }

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
    .umkm-card-img { width: 100%; height: 160px; object-fit: cover; border-radius: 18px; margin-bottom: 12px; }
    .umkm-card h5 { font-size: 15px; font-weight: 700; color: #2c2f2e; margin-bottom: 4px; }
    .umkm-card p { font-size: 12px; color: #595c5a; margin-bottom: 16px; }
    .btn-kunjungi { width: 100%; background: white; border: 1px solid rgba(140,74,0,0.2); border-radius: 9999px; color: #8c4a00; font-size: 12px; font-weight: 700; padding: 9px; text-align: center; cursor: pointer; display: block; text-decoration: none; }
    .btn-kunjungi:hover { background: #fff5ee; }
</style>
@endsection

@section('content')
@if(session('success'))
<div class="success-alert">
    ✅ {{ session('success') }}
</div>
@endif

@if(session('error'))
<div class="success-alert" style="background: #dc2626; box-shadow: 0 10px 25px rgba(220,38,38,.25);">
    ❌ {{ session('error') }}
</div>
@endif

{{-- HERO SECTION --}}
<section style="background: linear-gradient(90deg, #f5f7f4 0%, #f5f7f4 100%);">
    <div class="hero">
        <div class="hero-grid">
            {{-- KIRI: Text & Form Pencarian --}}
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
                
                {{-- Form Pencarian Internal Customer --}}
                <form action="{{ route('customer.search') }}" method="GET" class="search-bar">
                    <svg style="width:18px;height:18px;fill:#9ca3af;margin-left:16px;flex-shrink:0" viewBox="0 0 24 24"><path d="M15.5 14h-.79l-.28-.27A6.471 6.471 0 0 0 16 9.5 6.5 6.5 0 1 0 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/></svg>
                    <input type="text" name="query" value="{{ request('query') }}" placeholder="Ketik jenis kuliner atau nama restoran favoritmu..." style="margin-left: 8px;" required>
                    <button type="submit" class="search-btn">
                        <svg viewBox="0 0 24 24"><path d="M15.5 14h-.79l-.28-.27A6.471 6.471 0 0 0 16 9.5 6.5 6.5 0 1 0 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/></svg>
                    </button>
                </form>
            </div>

            {{-- KANAN: Gambar Ilustrasi --}}
            <div class="hero-image-wrap">
                <img class="hero-image"
                    src="https://images.unsplash.com/photo-1555396273-367ea4eb4db5?auto=format&fit=crop&w=800&q=80"
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
                <h2 class="section-title">
                    {{ request()->has('query') ? 'Hasil Pencarian Restoran' : 'Restoran Terpopuler' }}
                </h2>
                <p class="section-sub">
                    {{ request()->has('query') ? 'Menampilkan restoran yang cocok dengan kata kunci Anda.' : 'Pilihan terbaik untuk pengalaman kuliner autentik di kota.' }}
                </p>
            </div>
            @if(request()->has('query'))
                <a href="{{ route('home') }}" class="see-all">← Reset Pencarian</a>
            @else
                <a href="#" class="see-all">Lihat Semua →</a>
            @endif
        </div>
        
        <div class="restaurant-grid">
            @php
                // LOGIKA CERDAS: Jika DB kosong total, kita jadikan array dummy sebagai koleksi objek
                $displayRestaurants = $restaurants;
                if($restaurants->isEmpty() && !request()->has('query')) {
                    $dummyData = [
                        (object)['id' => 1, 'name' => 'Sate Padang Begadang', 'address' => 'Jl. Diponegoro, Bandar Lampung', 'phone' => '0812-3456-7890', 'open_time' => '09:00', 'close_time' => '21:00', 'image' => null, 'status' => 'available', 'rating' => '4.9'],
                        (object)['id' => 2, 'name' => 'Bakso Son Haji Sony', 'address' => 'Jl. Wolter Monginsidi, Lampung', 'phone' => '0812-7777-XXXX', 'open_time' => '09:00', 'close_time' => '21:00', 'image' => null, 'status' => 'full', 'rating' => '4.7'],
                        (object)['id' => 3, 'name' => 'Kopi Lampung Hub', 'address' => 'Way Halim, Bandar Lampung', 'phone' => '0812-3456-7890', 'open_time' => '09:00', 'close_time' => '21:00', 'image' => null, 'status' => 'available', 'rating' => '4.8']
                    ];
                    $displayRestaurants = collect($dummyData);
                } elseif ($restaurants->isEmpty() && request()->has('query')) {
                    // SINKRONISASI PENCARIAN DUMMY: Filter array jika user mengetik kata kunci saat DB kosong
                    $searchKeyword = strtolower(request('query'));
                    $dummyData = [
                        (object)['id' => 1, 'name' => 'Sate Padang Begadang', 'address' => 'Jl. Diponegoro, Bandar Lampung', 'phone' => '0812-3456-7890', 'open_time' => '09:00', 'close_time' => '21:00', 'image' => null, 'status' => 'available', 'rating' => '4.9'],
                        (object)['id' => 2, 'name' => 'Bakso Son Haji Sony', 'address' => 'Jl. Wolter Monginsidi, Lampung', 'phone' => '0812-7777-XXXX', 'open_time' => '09:00', 'close_time' => '21:00', 'image' => null, 'status' => 'full', 'rating' => '4.7'],
                        (object)['id' => 3, 'name' => 'Kopi Lampung Hub', 'address' => 'Way Halim, Bandar Lampung', 'phone' => '0812-3456-7890', 'open_time' => '09:00', 'close_time' => '21:00', 'image' => null, 'status' => 'available', 'rating' => '4.8']
                    ];
                    $displayRestaurants = collect($dummyData)->filter(function($item) use ($searchKeyword) {
                        return str_contains(strtolower($item->name), $searchKeyword) || str_contains(strtolower($item->address), $searchKeyword);
                    });
                }
            @endphp

            @forelse($displayRestaurants as $resto)
                @php
                    // Pilih gambar default berdasarkan nama restoran dummy agar visualnya pas
                    $defaultImg = 'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?auto=format&fit=crop&w=600&q=80';
                    if (str_contains(strtolower($resto->name), 'sate')) {
                        $defaultImg = 'https://images.unsplash.com/photo-1555396273-367ea4eb4db5?auto=format&fit=crop&w=500&q=80';
                    } elseif (str_contains(strtolower($resto->name), 'bakso')) {
                        $defaultImg = 'https://images.unsplash.com/photo-1569050467447-ce54b3bbc37d?auto=format&fit=crop&w=500&q=80';
                    } elseif (str_contains(strtolower($resto->name), 'kopi')) {
                        $defaultImg = 'https://images.unsplash.com/photo-1501339847302-ac426a4a7cbb?auto=format&fit=crop&w=500&q=80';
                    }

                    $restoImage = ($resto->image && file_exists(public_path('storage/' . $resto->image))) 
                        ? asset('storage/' . $resto->image) 
                        : $defaultImg;
                    
                    $isFull = isset($resto->status) && $resto->status === 'full';
                @endphp
                
                <div class="resto-card">
                    <div class="resto-img-wrap" onclick="window.location='{{ route('customer.restaurant.show', ['id' => $resto->id]) }}'" style="cursor: pointer;">
                        <img src="{{ $restoImage }}" alt="{{ $resto->name }}">
                        <div class="rating-badge">{{ $resto->rating ?? '4.8' }}</div>
                    </div>

                    <div class="resto-body">
                        <div class="resto-name" onclick="window.location='{{ route('customer.restaurant.show', ['id' => $resto->id]) }}'" style="cursor: pointer;">
                            {{ $resto->name }}
                        </div>

                        <div class="resto-location">
                            {{ $resto->address }}
                        </div>

                        <div class="resto-hours">
                            🕒
                            {{ $resto->open_time ? \Carbon\Carbon::parse($resto->open_time)->format('H:i') : '09:00' }}
                            -
                            {{ $resto->close_time ? \Carbon\Carbon::parse($resto->close_time)->format('H:i') : '21:00' }}
                        </div>

                        <div class="resto-phone">
                            📞 {{ $resto->phone ?? '0812-7777-XXXX' }}
                        </div>

                        <div class="resto-footer">
                            @if($isFull)
                                <span class="badge-full">PENUH</span>
                                <a href="#" class="btn-booking" style="background:#e0e0e0;color:#999;pointer-events:none">Full</a>
                            @else
                                <span class="badge-available">TERSEDIA</span>
                                <a href="{{ route('customer.restaurant.show', ['id' => $resto->id]) }}" class="btn-booking">
                                    Lihat Detail
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <p style="grid-column: span 3; text-align: center; color: #747776; padding: 48px 0; font-weight: 600;">
                    Restoran dengan kata kunci "{{ request('query') }}" tidak ditemukan.
                </p>
            @endforelse
        </div>
    </div>
</section>

{{-- TENTANG RESTO SECTION --}}
<section id="tentang-resto" class="umkm-section">
    <div class="umkm-grid">
        <div>
            <div class="max-w-xl">
                <p class="umkm-label">TENTANG RESTO</p>
                <h2 class="umkm-title">Tentang<br><span>RestoBook</span></h2>
                <p class="umkm-desc">Platform andalan untuk melakukan reservasi meja restoran favorit dan mendukung pertumbuhan digital UMKM kuliner di Bandar Lampung.</p>
                
                <div class="umkm-feature">
                    <div class="umkm-feature-icon">💰</div>
                    <div>
                        <h4>Fee Transaksi 0%</h4>
                        <p>Keuntungan pemesanan sepenuhnya mengalir langsung milik pedagang lokal.</p>
                    </div>
                </div>
                
                <div class="umkm-feature">
                    <div class="umkm-feature-icon">📣</div>
                    <div>
                        <h4>Promosi Prioritas</h4>
                        <p>Kedai dan warung UMKM kecil mendapatkan eksposur promosi lebih luas di halaman utama aplikasi.</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="umkm-cards">
            <div class="umkm-card">
                <img class="umkm-card-img" src="https://images.unsplash.com/photo-1565299507177-b0ac66763828?auto=format&fit=crop&w=400&q=80" alt="Martabak">
                <h5>Martabak Bangka Sari</h5>
                <p>Kemiling • Cemilan</p>
                <a href="#" class="btn-kunjungi">Kunjungi</a>
            </div>
            <div class="umkm-card">
                <img class="umkm-card-img" src="https://images.unsplash.com/photo-1585032226651-759b368d7246?auto=format&fit=crop&w=400&q=80" alt="Mie Ayam">
                <h5>Mie Ayam Pak Jo</h5>
                <p>Sukabumi • Mie</p>
                <a href="#" class="btn-kunjungi">Kunjungi</a>
            </div>
        </div>
    </div>
</section>

<script>
// Menghilangkan semua pesan alert secara otomatis dalam waktu 3 detik
setTimeout(function() {
    const alerts = document.querySelectorAll('.success-alert');
    alerts.forEach(function(alert) {
        alert.remove();
    });
}, 3000);
</script>
@endsection