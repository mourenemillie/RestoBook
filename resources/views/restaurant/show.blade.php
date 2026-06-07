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
        background: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.7)), 
                    url('https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?q=80&w=1200');
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
        background: #d97706;
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
    .btn-reserve:hover { background: #b45309; color: white; }

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
    <div class="resto-hero" style="background: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.7)), url('{{ $restaurant->image ? asset('storage/'.$restaurant->image) : 'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?q=80&w=1200' }}'); background-size: cover; background-position: center;">
        <div>
            <span class="badge-status">TERPOPULER</span>
            <h1 style="font-size: 42px; font-weight: 900; margin: 0;">{{ $restaurant->name }}</h1>
            <p style="opacity: 0.9;">⭐ 4.8 (1.2k+ Reviews) • 📍 {{ $restaurant->address }}</p>
        </div>
    </div>

    <div class="resto-grid">
        <div class="main-content">
            <h2 class="menu-section-title">Tentang Restoran</h2>
            <p style="color: #666; line-height: 1.8; margin-bottom: 40px;">
                Ikon kuliner terbaik di kota ini. Menyajikan berbagai hidangan lezat dengan bahan berkualitas tinggi dan pelayanan yang ramah. Nikmati pengalaman bersantap yang tak terlupakan bersama kami.
            </p>

            <h2 class="menu-section-title">Menu Pilihan</h2>
            <div class="menu-list">
                @forelse($restaurant->menus->take(4) as $menu)
                <div class="menu-card">
                    <div class="menu-img-wrapper">
                        <img src="{{ $menu->image ? asset('storage/'.$menu->image) : 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?q=80&w=600' }}" alt="{{ $menu->name }}">
                    </div>
                    <div class="menu-info">
                        <h3 style="margin:0">{{ $menu->name }}</h3>
                        <p style="font-size: 13px; color: #888; margin: 5px 0;">{{ $menu->category }}</p>
                        <span class="menu-price">Rp {{ number_format($menu->price, 0, ',', '.') }}</span>
                    </div>
                </div>
                @empty
                <p>Belum ada menu.</p>
                @endforelse
            </div>
        </div>

        <div class="sidebar">
            <div class="booking-box" style="text-align: center;">
                <h3 style="margin-top: 0; margin-bottom: 10px; font-size: 22px;">Ingin Makan di Sini?</h3>
                <p style="color: #666; margin-bottom: 25px; font-size: 14px;">Reservasi meja dengan mudah, pilih menu, dan nikmati hidangan tanpa antre!</p>
                
                <a href="{{ route('customer.reservations.create', $restaurant->id) }}" class="btn-reserve" style="text-decoration: none;">
                    Pesan Meja & Menu Sekarang
                </a>
                
                <p style="font-size: 12px; color: #aaa; text-align: center; margin-top: 15px;">
                    Aman terintegrasi dengan pembayaran online.
                </p>

                <div style="background: #fff8f0; padding: 20px; border-radius: 20px; margin-top: 25px; border: 1px dashed #d97706;">
                    <p style="margin: 0; font-size: 13px;">🕒 <strong>Jam Buka:</strong> 09:00 - 21:00</p>
                    <p style="margin: 10px 0 0; font-size: 13px;">🚗 <strong>Fasilitas:</strong> Parkir & Musholla</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection