@extends('layouts.app')

@section('content')
<style>
    :root {
        --primary-orange: #E67E00;
        --text-dark: #2D2D2D;
        --text-muted: #717171;
        --bg-light: #F8F9F8;
        --card-bg: #EDF1F0;
    }

    .checkout-body {
        background-color: var(--bg-light);
        color: var(--text-dark);
        line-height: 1.5;
        font-family: 'Plus Jakarta Sans', sans-serif;
        width: 100%;
        min-height: 100vh;
        padding-bottom: 60px;
    }

    /* --- MAIN LAYOUT --- */
    .checkout-container {
        max-width: 1200px;
        margin: 40px auto;
        display: grid;
        grid-template-columns: 1fr 380px;
        gap: 40px;
        padding: 0 20px;
    }

    @media (max-width: 768px) {
        .checkout-container {
            grid-template-columns: 1fr;
        }
    }

    .checkout-header span {
        color: var(--primary-orange);
        font-size: 12px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .checkout-header h1 {
        font-size: 48px;
        font-weight: 800;
        line-height: 1.1;
        margin-top: 10px;
        margin-bottom: 40px;
    }

    .checkout-header h1 em {
        font-style: normal;
        color: #8B4513;
    }

    /* --- INFO BOX --- */
    .info-card {
        background: white;
        border-radius: 24px;
        padding: 30px;
        border: 1px solid #E5E7EB;
        margin-bottom: 30px;
    }

    .info-title {
        font-size: 18px;
        font-weight: 700;
        margin-bottom: 15px;
        color: var(--text-dark);
    }

    .info-desc {
        color: var(--text-muted);
        font-size: 14px;
        line-height: 1.6;
    }

    /* --- SIDEBAR SUMMARY --- */
    .summary-card {
        background: #E9ECE9;
        border-radius: 32px;
        overflow: hidden;
        padding: 20px;
    }

    .res-image-wrapper {
        width: 100%;
        height: 180px;
        border-radius: 20px;
        position: relative;
        overflow: hidden;
        background-color: #cbd5e1;
    }

    .res-image-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .res-image-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(transparent, rgba(0,0,0,0.85));
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        padding: 15px;
        color: white;
        z-index: 2;
    }

    .summary-details {
        padding: 20px 10px;
    }

    .detail-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 12px;
        font-size: 14px;
    }

    .detail-row.total {
        margin-top: 20px;
        font-size: 20px;
        font-weight: 800;
    }

    .detail-row.total span:last-child {
        color: var(--primary-orange);
    }

    .btn-confirm {
        background: linear-gradient(to right, #914F0D, var(--primary-orange));
        color: white;
        width: 100%;
        border: none;
        padding: 18px;
        border-radius: 30px;
        font-weight: 700;
        font-size: 16px;
        margin-top: 10px;
        box-shadow: 0 10px 20px rgba(230, 126, 0, 0.3);
        cursor: pointer;
        transition: all 0.3s ease;
        text-align: center;
    }

    .btn-confirm:hover {
        transform: scale(1.02);
        opacity: 0.95;
    }

    .timer-alert {
        background: #FDF2E6;
        border-radius: 20px;
        padding: 15px;
        font-size: 12px;
        margin-top: 20px;
        display: flex;
        gap: 10px;
    }
</style>

<div class="checkout-body">
    <main class="checkout-container">
        <div class="content-left">
            <div class="checkout-header">
                <span>Checkout Aman</span>
                <h1>Selesaikan<br><em>reservasi Anda.</em></h1>
            </div>

            <div class="info-card">
                <div class="info-title">🔒 Pembayaran Otomatis via Midtrans</div>
                <p class="info-desc">
                    Kami mendukung berbagai metode pembayaran instan dan aman demi kenyamanan Anda. Setelah menekan tombol <strong>"Bayar Sekarang"</strong>, Anda dapat memilih metode pembayaran seperti Virtual Account Bank (BCA, Mandiri, BNI, BRI), E-Wallet (GoPay, ShopeePay, OVO), QRIS, maupun Kartu Kredit secara langsung melalui sistem resmi Midtrans.
                </p>
            </div>
            
            <div class="info-card" style="background: white;">
                <div class="info-title" style="font-size: 15px; color: #555;">📋 Detail Transaksi (Kode: {{ $booking->booking_code }})</div>
                <div class="info-desc" style="font-size: 13px; margin-top: 8px;">
                    • Nama Pemesan: <strong>{{ Auth::user()->name ?? 'Pelanggan' }}</strong><br>
                    • Status Tagihan: <span style="color: #E67E00; font-weight: bold; text-transform: uppercase;">{{ $booking->status }}</span>
                </div>
            </div>
        </div>

        <aside>
            <div class="summary-card">
                <div class="res-image-wrapper">
                    {{-- 🛠️ STRATEGI FALLBACK GAMBAR: Memastikan penanganan struktur folder upload admin --}}
                    @if($booking->restaurant && $booking->restaurant->image)
                        @if(Str::startsWith($booking->restaurant->image, 'http'))
                            <img src="{{ $booking->restaurant->image }}" alt="Restoran">
                        @elseif(file_exists(public_path('storage/restaurants/' . $booking->restaurant->image)))
                            <img src="{{ asset('storage/restaurants/' . $booking->restaurant->image) }}" alt="Restoran">
                        @else
                            <img src="{{ asset('storage/' . $booking->restaurant->image) }}" alt="Restoran">
                        @endif
                    @else
                        <img src="https://images.unsplash.com/photo-1534422298391-e4f8c172dddb?q=80&w=400" alt="Default">
                    @endif
                    
                    <div class="res-image-overlay">
                        <h3 style="font-size: 18px; font-weight:800; margin: 0;">{{ $booking->restaurant->name ?? 'Restoran Pilihan' }}</h3>
                        <p style="font-size: 12px; opacity: 0.9; margin: 4px 0 0 0;">{{ $booking->restaurant->address ?? 'Bandar Lampung' }}</p>
                    </div>
                </div>
                
                <div class="summary-details">
                    <div class="detail-row">
                        <span style="color: #666; font-weight: 500;">Tanggal & Waktu</span>
                        <span style="font-weight: 700;">
                            {{ $booking->reservation_date ? \Carbon\Carbon::parse($booking->reservation_date)->translatedFormat('M d, Y') : '-' }} • 
                            {{ $booking->reservation_time ? \Carbon\Carbon::parse($booking->reservation_time)->format('H:i') : '-' }} WIB
                        </span>
                    </div>
                    <div class="detail-row">
                        <span style="color: #666; font-weight: 500;">Tamu</span>
                        <span style="font-weight: 700;">{{ $booking->num_guests ?? '0' }} Orang</span>
                    </div>
                    <div class="detail-row">
                        <span style="color: #666; font-weight: 500;">Nomor Meja</span>
                        <span style="font-weight: 700;">Meja #{{ $booking->table->table_number ?? 'Ditentukan Sistem' }}</span>
                    </div>

                    <div style="border-top: 1px solid #CCC; margin: 15px 0;"></div>

                    <div class="detail-row">
                        <span style="color: #666; font-weight: 500;">Total Harga</span>
                        <span style="font-weight: bold;">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</span>
                    </div>

                    <div class="detail-row total">
                        <span>Total Tagihan</span>
                        <span>Rp {{ number_format($booking->total_price, 0, ',', '.') }}</span>
                    </div>

                    <button id="pay-button" class="btn-confirm">Bayar Sekarang</button>
                    
                    <p style="text-align: center; font-size: 10px; color: #999; margin-top: 15px; text-transform: uppercase; letter-spacing: 1px;">
                        🔒 Pembayaran Aman Terenkripsi
                    </p>
                </div>
            </div>

            <div class="timer-alert">
                <span>ℹ️</span>
                <p>Pembayaran harus segera diselesaikan untuk mengamankan ketersediaan meja Anda.</p>
            </div>
        </aside>
    </main>
</div>

{{-- SINKRONISASI AMAN: Menghubungkan variabel secara seragam ke config/midtrans.php tunggal --}}
@php
    $isProduction = config('midtrans.is_production');
    $clientKey = config('midtrans.client_key');
    $snapUrl = $isProduction ? 'https://app.midtrans.com/snap/snap.js' : 'https://app.sandbox.midtrans.com/snap/snap.js';
@endphp

<script type="text/javascript" src="{{ $snapUrl }}" data-client-key="{{ $clientKey }}"></script>

<script type="text/javascript">
    document.getElementById('pay-button').onclick = function(e){
        e.preventDefault();
        
        // SINKRONISASI VARIABEL: Membaca token aseli dari Controller ($snapToken)
        var snapToken = '{{ $snapToken }}';
        
        if(!snapToken || snapToken.trim() === '') {
            alert('Error: Snap Token kosong atau tidak valid. Silakan buat transaksi ulang.');
            return;
        }

        window.snap.pay(snapToken, {
            onSuccess: function(result){
                window.location.href = "{{ route('booking.success', ['booking_code' => $booking->booking_code]) }}";
            },
            onPending: function(result){
                window.location.href = "{{ route('booking.success', ['booking_code' => $booking->booking_code]) }}";
            },
            onError: function(result){
                alert("Proses pembayaran dibatalkan atau terjadi masalah gateway.");
            },
            onClose: function(){
                alert('Anda menutup jendela pembayaran sebelum menyelesaikan transaksi.');
            }
        });
    };
</script>
@endsection