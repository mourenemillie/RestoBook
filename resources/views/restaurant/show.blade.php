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
    <div class="resto-hero">
        <div>
            <span class="badge-status">TERPOPULER</span>
            <h1 style="font-size: 42px; font-weight: 900; margin: 0;">Bakso Son Haji Sony</h1>
            <p style="opacity: 0.9;">⭐ 4.8 (1.2k+ Reviews) • 📍 Jl. Wolter Monginsidi, Lampung</p>
        </div>
    </div>

    <div class="resto-grid">
        <div class="main-content">
            <h2 class="menu-section-title">Tentang Restoran</h2>
            <p style="color: #666; line-height: 1.8; margin-bottom: 40px;">
                Ikon kuliner legendaris di Lampung sejak 1970. Terkenal dengan resep rahasia bakso daging sapi pilihan dengan tekstur kenyal yang khas dan kuah gurih yang kaya rasa.
            </p>

            <h2 class="menu-section-title">Menu Pilihan</h2>
            <div class="menu-list">
                <div class="menu-card">
                    <div class="menu-img-wrapper">
                        <img src="https://images.unsplash.com/photo-1534422298391-e4f8c172dddb?q=80&w=600" alt="Bakso Sony">
                    </div>
                    <div class="menu-info">
                        <h3 style="margin:0">Bakso Super</h3>
                        <p style="font-size: 13px; color: #888; margin: 5px 0;">Bakso urat sapi murni dengan bihun.</p>
                        <span class="menu-price">Rp 25.000</span>
                    </div>
                </div>

                <div class="menu-card">
                    <div class="menu-img-wrapper">
                        <img src="https://images.unsplash.com/photo-1585032226651-759b368d7246?q=80&w=600" alt="Mie Ayam">
                    </div>
                    <div class="menu-info">
                        <h3 style="margin:0">Mie Ayam</h3>
                        <p style="font-size: 13px; color: #888; margin: 5px 0;">Mie pangsit dengan ayam kecap manis gurih.</p>
                        <span class="menu-price">Rp 18.000</span>
                    </div>
                </div>

                <div class="menu-card-wide">
                    <img src="https://images.unsplash.com/photo-1613478223719-2ab802602423?q=80&w=400" alt="Minuman">
                    <div class="menu-info">
                        <h3 style="margin:0">Es Jeruk Peras</h3>
                        <p style="font-size: 13px; color: #888; margin: 5px 0;">Jeruk peras asli Lampung yang segar.</p>
                        <span class="menu-price">Rp 8.000</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="sidebar">
            <form action="{{ route('restaurant.booking') }}" method="POST" class="booking-box">
                @csrf
                
                {{-- Data Nama Restoran Tersembunyi --}}
                <input type="hidden" name="restaurant_name" value="Bakso Son Haji Sony">

                <h3 style="margin-top: 0; margin-bottom: 20px;">Pesan Meja</h3>
                
                {{-- Penanganan Error Validasi Masukan Form dari Laravel Controller --}}
                @if ($errors->any())
                    <div class="alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <label style="font-size: 12px; font-weight: 800; color: #888;">TANGGAL</label>
                <input type="date" name="booking_date" class="input-field" value="{{ old('booking_date', date('Y-m-d')) }}" required>

                <label style="font-size: 12px; font-weight: 800; color: #888;">JAM KEDATANGAN</label>
                <select name="booking_time" class="input-field" required>
                    <option value="10:00" {{ old('booking_time') == '10:00' ? 'selected' : '' }}>10:00 WIB</option>
                    <option value="12:00" {{ old('booking_time') == '12:00' || !old('booking_time') ? 'selected' : '' }}>12:00 WIB</option>
                    <option value="14:00" {{ old('booking_time') == '14:00' ? 'selected' : '' }}>14:00 WIB</option>
                    <option value="16:00" {{ old('booking_time') == '16:00' ? 'selected' : '' }}>16:00 WIB</option>
                    <option value="19:00" {{ old('booking_time') == '19:00' ? 'selected' : '' }}>19:00 WIB</option>
                </select>

                <label style="font-size: 12px; font-weight: 800; color: #888;">AREA MEJA</label>
                <select name="table_area" class="input-field" required>
                    <option value="Area Utama (Non-Smoking)" {{ old('table_area') == 'Area Utama (Non-Smoking)' ? 'selected' : '' }}>Area Utama (Non-Smoking)</option>
                    <option value="Area Jendela (City View)" {{ old('table_area') == 'Area Jendela (City View)' ? 'selected' : '' }}>Area Jendela (City View)</option>
                    <option value="Area Outdoor (Smoking)" {{ old('table_area') == 'Area Outdoor (Smoking)' ? 'selected' : '' }}>Area Outdoor (Smoking)</option>
                    <option value="VIP Room (Private)" {{ old('table_area') == 'VIP Room (Private)' ? 'selected' : '' }}>VIP Room (Private)</option>
                </select>

                <label style="font-size: 12px; font-weight: 800; color: #888;">JUMLAH TAMU</label>
                <select name="number_of_people" class="input-field" required>
                    <option value="2 Orang" {{ old('number_of_people') == '2 Orang' ? 'selected' : '' }}>2 Orang</option>
                    <option value="4 Orang" {{ old('number_of_people') == '4 Orang' ? 'selected' : '' }}>4 Orang</option>
                    <option value="6 Orang" {{ old('number_of_people') == '6 Orang' ? 'selected' : '' }}>6 Orang</option>
                    <option value="8 Orang" {{ old('number_of_people') == '8 Orang' ? 'selected' : '' }}>8 Orang</option>
                </select>

                <button type="submit" class="btn-reserve">
                    Booking Sekarang
                </button>
                
                <p style="font-size: 12px; color: #aaa; text-align: center; margin-top: 15px;">
                    Konfirmasi aman terintegrasi dengan metode pembayaran instan.
                </p>

                <div style="background: #fff8f0; padding: 20px; border-radius: 20px; margin-top: 25px; border: 1px dashed #d97706;">
                    <p style="margin: 0; font-size: 13px;">🕒 <strong>Jam Buka:</strong> 09:00 - 21:00</p>
                    <p style="margin: 10px 0 0; font-size: 13px;">🚗 <strong>Fasilitas:</strong> Parkir & Musholla</p>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection