@extends('layouts.app')

@section('title', 'Semua Restoran - RestoBook Lampung')

@section('extra_styles')
<style>
/* Meminjam gaya dari halaman utama untuk grid restoran */
.restaurant-section { background: #eff1ef; padding: 60px 48px 96px; min-height: 80vh; }
.restaurant-inner { max-width: 1280px; margin: 0 auto; }
.section-header { margin-bottom: 40px; text-align: center; }
.section-title { font-size: 36px; font-weight: 800; color: #2c2f2e; letter-spacing: -0.9px; margin-bottom: 8px; }
.section-sub { font-size: 18px; color: #595c5a; }
.restaurant-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(350px, 1fr)); gap: 32px; }
.resto-card { background: white; border-radius: 48px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.05); }
.resto-img-wrap { position: relative; height: 256px; overflow: hidden; }
.resto-img-wrap img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s; }
.resto-card:hover .resto-img-wrap img { transform: scale(1.05); }
.resto-body { padding: 28px 32px 32px; }
.resto-name { font-size: 22px; font-weight: 700; color: #2c2f2e; margin-bottom: 8px; }
.resto-location { font-size: 14px; color: #595c5a; margin-bottom: 20px; display: flex; align-items: center; gap: 6px; }
.resto-hours { margin-top: 8px; font-size: 14px; color: #666; }
.resto-footer { display: flex; align-items: center; justify-content: space-between; padding-top: 16px; border-top: 1px solid #f0f0f0; margin-top: 16px; }
.badge-available { background: #ffc78a; color: #683e00; font-size: 11px; font-weight: 700; padding: 4px 12px; border-radius: 9999px; }
.btn-booking { background: linear-gradient(135deg, #8c4a00 0%, #fd8b00 100%); color: #fff0e7; font-size: 13px; font-weight: 700; padding: 8px 24px; border-radius: 9999px; text-decoration: none; border: none; cursor: pointer; }
</style>
@endsection

@section('content')
<section class="restaurant-section">
    <div class="restaurant-inner">
        <div class="section-header">
            <h2 class="section-title">Semua Restoran</h2>
            <p class="section-sub">Temukan berbagai pilihan kuliner terbaik untukmu.</p>
        </div>

        <div class="restaurant-grid">
            @forelse($restaurants as $resto)
                <div class="resto-card">
                    <div class="resto-img-wrap" onclick="window.location='{{ route('restaurant.show', $resto->id) }}'" style="cursor: pointer;">
                        <img src="{{ $resto->image ? (Str::startsWith($resto->image, 'http') ? $resto->image : asset('storage/'.$resto->image)) : 'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?w=400' }}" alt="{{ $resto->name }}">
                    </div>

                    <div class="resto-body">
                        <div class="resto-name" onclick="window.location='{{ route('restaurant.show', $resto->id) }}'" style="cursor: pointer;">{{ $resto->name }}</div>
                        <div class="resto-location">📍 {{ $resto->address }}, {{ $resto->city }}</div>
                        <div class="resto-hours">🕒 {{ \Carbon\Carbon::parse($resto->open_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($resto->close_time)->format('H:i') }}</div>
                        <div class="resto-hours" style="margin-top: 4px;">📞 {{ $resto->phone }}</div>

                        <div class="resto-footer">
                            <span class="badge-available">TERSEDIA</span>
                            <a href="{{ route('customer.reservations.create', $resto->id) }}" class="btn-booking">Pesan</a>
                        </div>
                    </div>
                </div>
            @empty
                <div style="grid-column: 1 / -1; text-align: center; padding: 60px; background: white; border-radius: 32px;">
                    <div style="font-size: 40px; margin-bottom: 16px;">🏪</div>
                    <h3 style="font-size: 20px; font-weight: 700; color: #2c2f2e;">Belum ada restoran</h3>
                    <p style="color: #595c5a;">Saat ini belum ada restoran yang terdaftar.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>
@endsection
