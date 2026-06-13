@extends('layouts.app')

@section('content')
<style>
    /* Reset & Base Style */
    .resto-container {
        max-width: 1200px;
        margin: 40px auto;
        padding: 0 20px;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    /* Hero Section */
    .resto-hero {
        width: 100%;
        height: 400px;
        border-radius: 35px;
        background-size: cover;
        background-position: center;
        display: flex;
        align-items: flex-end;
        padding: 40px;
        color: white;
        margin-bottom: 40px;
    }
    .badge-status {
        background: #fbbf24;
        color: #000;
        padding: 6px 14px;
        border-radius: 10px;
        font-size: 12px;
        font-weight: 800;
        margin-bottom: 15px;
        display: inline-block;
    }

    /* Layout Grid */
    .resto-grid {
        display: grid;
        grid-template-columns: 1.8fr 1fr;
        gap: 40px;
    }

    /* Menu Cards */
    .menu-section-title { font-size: 24px; font-weight: 800; margin-bottom: 25px; }
    .menu-list { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
    
    .menu-card {
        background: #f8f9fa;
        border-radius: 25px;
        overflow: hidden;
        border: 1px solid #eee;
        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02);
    }
    .menu-img-wrapper {
        width: 100%;
        aspect-ratio: 16/10; 
        overflow: hidden;
    }
    .menu-img-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }
    .menu-card:hover .menu-img-wrapper img {
        transform: scale(1.04);
    }
    .menu-info { padding: 20px; }
    .menu-price { font-weight: 800; color: #d97706; font-size: 18px; margin-top: 10px; display: block; }

    /* Wide Menu Card */
    .menu-card-wide {
        grid-column: span 2;
        display: flex;
        background: #f8f9fa;
        border-radius: 25px;
        overflow: hidden;
    }
    .menu-card-wide img { width: 200px; height: 100%; object-fit: cover; }

    /* Sidebar Booking Box */
    .booking-box {
        background: white;
        padding: 35px;
        border-radius: 30px;
        box-shadow: 0 20px 40px rgba(0,0,0,0.05);
        border: 1px solid #f1f1f1;
        height: fit-content;
        position: sticky;
        top: 20px;
    }
    .input-field {
        width: 100%;
        padding: 15px;
        background: #f3f4f6;
        border: none;
        border-radius: 12px;
        margin-top: 8px;
        margin-bottom: 20px;
        font-weight: 600;
        outline: none;
        font-family: inherit;
    }
    .btn-reserve {
        width: 100%;
        background: #e95a1e;
        color: white;
        padding: 18px;
        border-radius: 15px;
        font-weight: 700;
        border: none;
        cursor: pointer;
        transition: 0.3s;
        display: block;
        text-align: center;
        text-decoration: none;
    }
    .btn-reserve:hover { background: #b45309; color: white; transform: translateY(-2px); box-shadow: 0 10px 20px rgba(233,90,30,0.2); }

    /* Alert Notification Style */
    .alert-danger {
        background: #fef2f2;
        color: #991b1b;
        padding: 15px;
        border-radius: 12px;
        margin-bottom: 20px;
        font-size: 13px;
        border: 1px solid #fee2e2;
    }
    .alert-danger ul { margin: 0; padding-left: 20px; }

    /* Responsive */
    @media (max-width: 768px) {
        .resto-grid { grid-template-columns: 1fr; }
        .resto-hero { height: 300px; }
        .menu-list { grid-template-columns: 1fr; }
        .menu-card-wide { flex-direction: column; }
        .menu-card-wide img { width: 100%; height: 150px; }
    }
</style>

<div class="resto-container">
    {{-- RESTAURANT HERO --}}
    @php
        // Deteksi Gambar Hero Utama Restoran
        $heroImage = ($restaurant->image && file_exists(public_path('storage/' . $restaurant->image))) 
            ? asset('storage/' . $restaurant->image) 
            : 'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?q=80&w=1200';
            
        // Jika data tiruan terpaksa keluar, kita sesuaikan gambar heronya agar estetik
        if(empty($restaurant->image)) {
            if(str_contains(strtolower($restaurant->name), 'sate')) {
                $heroImage = 'https://images.unsplash.com/photo-1555396273-367ea4eb4db5?auto=format&fit=crop&w=1200&q=80';
            } elseif(str_contains(strtolower($restaurant->name), 'bakso')) {
                $heroImage = 'https://images.unsplash.com/photo-1569050467447-ce54b3bbc37d?auto=format&fit=crop&w=1200&q=80';
            } elseif(str_contains(strtolower($restaurant->name), 'kopi')) {
                $heroImage = 'https://images.unsplash.com/photo-1501339847302-ac426a4a7cbb?auto=format&fit=crop&w=1200&q=80';
            }
        }
    @endphp
    
    <div class="resto-hero" style="background: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.7)), url('{{ $heroImage }}'); background-size: cover; background-position: center;">
        <div>
            <span class="badge-status">TERPOPULER</span>
            <h1 style="font-size: 42px; font-weight: 900; margin: 0; text-shadow: 0 2px 4px rgba(0,0,0,0.3);">{{ $restaurant->name }}</h1>
            <p style="opacity: 0.9; font-weight: 500; text-shadow: 0 1px 2px rgba(0,0,0,0.3);">⭐ 4.8 (1.2k+ Reviews) • 📍 {{ $restaurant->address }}</p>
        </div>
    </div>

    <div class="resto-grid">
        {{-- MAIN CONTENT --}}
        <div class="main-content">
            <h2 class="menu-section-title">Tentang Restoran</h2>
            <p style="color: #555; line-height: 1.8; margin-bottom: 40px; font-size: 15px;">
                {{ $restaurant->description ?? 'Ikon kuliner terbaik di kota ini. Menyajikan berbagai hidangan lezat dengan bahan berkualitas tinggi dan pelayanan yang ramah. Nikmati pengalaman bersantap yang tak terlupakan bersama kami.' }}
            </p>

            <h2 class="menu-section-title">Menu Pilihan</h2>
            <div class="menu-list">
                @php
                    // LOGIKA INTEGRASI: Jika DB kosong, kita injeksi list menu dummy berdasarkan jenis resto
                    $displayMenus = $restaurant->menus;
                    if($displayMenus->isEmpty()) {
                        if(str_contains(strtolower($restaurant->name), 'bakso')) {
                            $dummyMenus = [
                                (object)['id' => 101, 'name' => 'Bakso Kosongan Sony', 'category' => 'Makanan Utama', 'price' => 25000, 'image' => null],
                                (object)['id' => 102, 'name' => 'Mie Ayam Bakso Sony', 'category' => 'Makanan Utama', 'price' => 22000, 'image' => null],
                                (object)['id' => 103, 'name' => 'Es Teh Manis Segar', 'category' => 'Minuman', 'price' => 5000, 'image' => null],
                                (object)['id' => 104, 'name' => 'Kerupuk Putih Kaleng', 'category' => 'Cemilan', 'price' => 2000, 'image' => null],
                            ];
                        } elseif(str_contains(strtolower($restaurant->name), 'kopi')) {
                            $dummyMenus = [
                                (object)['id' => 201, 'name' => 'Kopi Susu Gula Aren', 'category' => 'Minuman Coffee', 'price' => 18000, 'image' => null],
                                (object)['id' => 202, 'name' => 'Manual Brewing robusta', 'category' => 'Minuman Coffee', 'price' => 15000, 'image' => null],
                                (object)['id' => 203, 'name' => 'Roti Bakar Cokelat', 'category' => 'Cemilan', 'price' => 12000, 'image' => null],
                                (object)['id' => 204, 'name' => 'Kentang Goreng Keju', 'category' => 'Cemilan', 'price' => 14000, 'image' => null],
                            ];
                        } else {
                            // Default Sate Padang / Lainnya
                            $dummyMenus = [
                                (object)['id' => 301, 'name' => 'Sate Padang Daging Sapi', 'category' => 'Makanan Utama', 'price' => 30000, 'image' => null],
                                (object)['id' => 302, 'name' => 'Sate Lidah Kuah Kental', 'category' => 'Makanan Utama', 'price' => 35000, 'image' => null],
                                (object)['id' => 303, 'name' => 'Keripik Singkong Pedas', 'category' => 'Cemilan', 'price' => 5000, 'image' => null],
                                (object)['id' => 304, 'name' => 'Es Jeruk Peras', 'category' => 'Minuman', 'price' => 8000, 'image' => null],
                            ];
                        }
                        $displayMenus = collect($dummyMenus);
                    }
                @endphp

                @forelse($displayMenus->take(4) as $menu)
                    @php
                        // Set visual gambar default menu pintar berdasarkan nama/kata kunci hidangan
                        $defaultMenuImg = 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?q=80&w=600&sig=' . $menu->id;
                        if(str_contains(strtolower($menu->name), 'bakso')) {
                            $defaultMenuImg = 'https://images.unsplash.com/photo-1534422298391-e4f8c172dddb?q=80&w=500';
                        } elseif(str_contains(strtolower($menu->name), 'sate')) {
                            $defaultMenuImg = 'https://images.unsplash.com/photo-1626132647523-66f5bf380027?q=80&w=500';
                        } elseif(str_contains(strtolower($menu->name), 'kopi')) {
                            $defaultMenuImg = 'https://images.unsplash.com/photo-1509042239860-f550ce710b93?q=80&w=500';
                        } elseif(str_contains(strtolower($menu->name), 'teh') || str_contains(strtolower($menu->name), 'jeruk')) {
                            $defaultMenuImg = 'https://images.unsplash.com/photo-1556679343-c7306c1976bc?q=80&w=500';
                        }

                        $menuImage = ($menu->image && file_exists(public_path('storage/' . $menu->image))) 
                            ? asset('storage/' . $menu->image) 
                            : $defaultMenuImg;
                    @endphp
                    <div class="menu-card">
                        <div class="menu-img-wrapper">
                            <img src="{{ $menuImage }}" alt="{{ $menu->name }}">
                        </div>
                        <div class="menu-info">
                            <h3 style="margin:0; font-size: 18px; color: #1f2937;">{{ $menu->name }}</h3>
                            <p style="font-size: 13px; color: #888; margin: 5px 0;">{{ $menu->category }}</p>
                            <span class="menu-price">Rp {{ number_format($menu->price, 0, ',', '.') }}</span>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-400 italic" style="grid-column: span 2; color: #9ca3af;">Belum ada menu yang terdaftar.</p>
                @endforelse
            </div>
        </div>

        {{-- SIDEBAR ACTION BOX --}}
        <div class="sidebar">
            <div class="booking-box" style="text-align: center;">
                <h3 style="margin-top: 0; margin-bottom: 10px; font-size: 22px; color: #1f2937; font-weight: 800;">Ingin Makan di Sini?</h3>
                <p style="color: #666; margin-bottom: 25px; font-size: 14px; line-height: 1.5;">Reservasi meja dengan mudah, pilih menu, dan nikmati hidangan tanpa antre!</p>
                
                {{-- BERHASIL DIPERBARUI: Menggunakan parameter array asosiatif eksplisit demi keandalan URL --}}
                <a href="{{ route('customer.reservations.create', ['restaurant_id' => $restaurant->id]) }}" class="btn-reserve">
                    Pesan Meja & Menu Sekarang
                </a>
                
                <p style="font-size: 12px; color: #aaa; text-align: center; margin-top: 15px;">
                    Aman terintegrasi dengan pembayaran online.
                </p>

                <div style="background: #fff8f0; padding: 20px; border-radius: 20px; margin-top: 25px; border: 1px dashed #e95a1e; text-align: left;">
                    <p style="margin: 0; font-size: 13px; color: #374151;">🕒 <strong>Jam Buka:</strong> 
                        {{ $restaurant->open_time ? \Carbon\Carbon::parse($restaurant->open_time)->format('H:i') : '09:00' }} - 
                        {{ $restaurant->close_time ? \Carbon\Carbon::parse($restaurant->close_time)->format('H:i') : '21:00' }}
                    </p>
                    <p style="margin: 10px 0 0; font-size: 13px; color: #374151;">🚗 <strong>Fasilitas:</strong> Parkir &amp; Musholla</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection