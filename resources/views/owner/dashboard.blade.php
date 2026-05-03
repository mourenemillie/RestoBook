@extends('layouts.app')

@section('title', 'Owner Dashboard - RestoBook Lampung')

@section('content')
<section style="padding: 96px 48px; max-width: 1100px; margin: 0 auto;">
    <header style="display:flex; align-items:flex-end; justify-content:space-between; gap:16px; margin-bottom:40px;">
        <div>
            <h1 style="font-size:38px; font-weight:800; margin-bottom:8px;">Owner Dashboard</h1>
            <p style="color:#595c5a;">Pantau restoran dan reservasi Anda dalam satu tempat.</p>
        </div>
    </header>

    <div style="display:grid; grid-template-columns:repeat(2, minmax(0, 1fr)); gap:24px; margin-bottom:40px;">
        <div style="background:#fff; padding:28px; border-radius:32px; box-shadow:0 20px 50px rgba(0,0,0,0.05);">
            <div style="font-size:14px; font-weight:700; color:#8c4a00; text-transform:uppercase; letter-spacing:1px; margin-bottom:12px;">Restoran Anda</div>
            <div style="font-size:34px; font-weight:800; color:#2c2f2e;">6</div>
            <p style="color:#595c5a; margin-top:12px;">Restoran aktif yang terhubung ke RestoBook.</p>
        </div>
        <div style="background:#fff; padding:28px; border-radius:32px; box-shadow:0 20px 50px rgba(0,0,0,0.05);">
            <div style="font-size:14px; font-weight:700; color:#8c4a00; text-transform:uppercase; letter-spacing:1px; margin-bottom:12px;">Reservasi Hari Ini</div>
            <div style="font-size:34px; font-weight:800; color:#2c2f2e;">18</div>
            <p style="color:#595c5a; margin-top:12px;">Klien yang akan datang ke restoran Anda hari ini.</p>
        </div>
    </div>

    <div style="background:#fff; padding:32px; border-radius:32px; box-shadow:0 20px 50px rgba(0,0,0,0.05);">
        <h2 style="font-size:24px; font-weight:800; margin-bottom:16px;">Reservasi Terbaru</h2>
        <ul style="display:grid; gap:14px; list-style:none; padding:0; margin:0;">
            <li style="padding:18px 22px; border-radius:24px; background:#f8faf6; color:#2c2f2e;">20:00 - 4 orang - Restoran Lampung Delight - Status: Dikonfirmasi</li>
            <li style="padding:18px 22px; border-radius:24px; background:#f8faf6; color:#2c2f2e;">19:30 - 2 orang - Kopi Nusantara - Status: Menunggu</li>
            <li style="padding:18px 22px; border-radius:24px; background:#f8faf6; color:#2c2f2e;">18:00 - 6 orang - Warung Mak Nyak - Status: Dibatalkan</li>
        </ul>
    </div>
</section>
@endsection
