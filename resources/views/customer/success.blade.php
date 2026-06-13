@extends('layouts.app')

@section('content')
<style>
    /* --- OPTIMASI KETIKA NOTA DICETAK (PRINT MODE) --- */
    @media print {
        /* Sembunyikan navigasi, footer, tombol aksi, dan ikon centang atas */
        nav, footer, .no-print, .btn-action-area, .success-icon-wrapper {
            display: none !important;
        }
        
        /* Netralkan background abu-abu bawaan browser */
        .bg-\[\#fafafa\], body, html {
            background: #ffffff !important;
            background-color: #ffffff !important;
            color: #000000 !important;
            padding: 0 !important;
            margin: 0 !important;
        }
        
        /* Hilangkan bayangan kartu agar teks menempel rapi di kertas */
        .shadow-sm, .border, .main-card-invoice {
            border: none !important;
            box-shadow: none !important;
            padding: 0 !important;
            margin-top: 10px !important;
        }
        
        .container {
            max-width: 100% !important;
            width: 100% !important;
            padding: 0 !important;
        }

        /* Pastikan teks total tagihan tetap kontras saat dicetak */
        .text-slate-800, .text-slate-900, .text-orange-600 {
            color: #000000 !important;
        }
    }
</style>

<div class="bg-[#fafafa] min-h-screen py-16 flex items-center font-['Plus_Jakarta_Sans',sans-serif]">
    <div class="container mx-auto px-6 max-w-2xl text-center">
        
        {{-- Ikon Sukses --}}
        <div class="success-icon-wrapper inline-flex items-center justify-center w-24 h-24 bg-emerald-50 rounded-[2rem] text-emerald-500 mb-8 shadow-sm border border-emerald-100">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>

        <span class="text-emerald-600 font-bold uppercase tracking-widest text-xs block mb-2 print:text-black">Pembayaran Berhasil</span>
        <h1 class="text-4xl font-black text-slate-900 mb-4 print:text-2xl print:text-left">Meja Anda Telah Diamankan!</h1>
        <p class="text-gray-500 max-w-md mx-auto mb-10 text-sm print:mb-6 print:text-left print:mx-0">
            Terima kasih! Reservasi Anda di <span class="font-bold text-slate-700 print:text-black">{{ $booking->restaurant->name ?? 'Restoran Pilihan' }}</span> telah dikonfirmasi secara otomatis oleh sistem kami.
        </p>

        {{-- KARTU DETAIL KODE BOOKING --}}
        <div class="main-card-invoice bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100 text-left mb-10 relative overflow-hidden print:mb-4 print:p-0">
            <div class="absolute top-0 right-0 w-32 h-32 bg-orange-500/5 rounded-full blur-2xl no-print"></div>
            
            <div class="flex justify-between items-center pb-6 border-b border-gray-100 mb-6 print:mb-4">
                <div>
                    <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">Kode Booking</p>
                    <p class="text-xl font-black text-orange-600 tracking-wide mt-0.5 print:text-black">{{ $booking->booking_code }}</p>
                </div>
                <div class="bg-emerald-50 text-emerald-700 px-4 py-2 rounded-xl text-xs font-extrabold uppercase print:border print:border-black print:text-black">
                    Status: Lunas
                </div>
            </div>

            <div class="grid grid-cols-2 gap-y-4 text-sm print:text-xs">
                <div>
                    <p class="text-gray-400 font-medium">Tanggal Kedatangan</p>
                    <p class="font-bold text-slate-800 mt-0.5 print:text-black">
                        {{ $booking->reservation_date ? \Carbon\Carbon::parse($booking->reservation_date)->translatedFormat('d F Y') : '-' }}
                    </p>
                </div>
                <div>
                    <p class="text-gray-400 font-medium">Jam Kedatangan</p>
                    <p class="font-bold text-slate-800 mt-0.5 print:text-black">
                        {{ $booking->reservation_time ? \Carbon\Carbon::parse($booking->reservation_time)->format('H:i') : '-' }} WIB
                    </p>
                </div>
                <div>
                    <p class="text-gray-400 font-medium">Jumlah Tamu</p>
                    <p class="font-bold text-slate-800 mt-0.5 print:text-black">{{ $booking->num_guests ?? '0' }} Orang</p>
                </div>
                <div>
                    <p class="text-gray-400 font-medium">Nomor Meja</p>
                    <p class="font-bold text-slate-800 mt-0.5 print:text-black">Meja #{{ $booking->table->table_number ?? 'Ditentukan' }}</p>
                </div>
            </div>

            <div class="mt-6 pt-6 border-t border-gray-50 flex justify-between items-center bg-gray-50 -mx-8 -mb-8 px-8 py-4 rounded-b-[2.5rem] print:bg-white print:mx-0 print:mb-0 print:px-0 print:border-t print:border-black">
                <span class="text-xs font-bold text-slate-500 uppercase print:text-black">Total Dana Ditransfer</span>
                <span class="text-lg font-black text-slate-800 print:text-black">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</span>
            </div>
        </div>

        {{-- AREA TOMBOL AKSYON --}}
        <div class="btn-action-area flex flex-col sm:flex-row gap-4 justify-center no-print">
            <a href="{{ url('/home') }}" class="bg-orange-600 text-white px-8 py-4 rounded-2xl font-bold hover:bg-orange-700 transition-all shadow-lg shadow-orange-100 flex items-center justify-center gap-2">
                Kembali ke Beranda
            </a>
            <button onclick="prosesCetakNota()" class="bg-white text-slate-700 border border-gray-200 px-8 py-4 rounded-2xl font-bold hover:bg-gray-50 transition-all flex items-center justify-center gap-2">
                🖨️ Cetak Nota Tiket
            </button>
        </div>

    </div>
</div>

<script type="text/javascript">
    /**
     * Mengamankan fungsi cetak dengan interupsi waktu singkat (delay)
     * agar browser memiliki nafas untuk merender layout cetak tanpa nge-blank.
     */
    function prosesCetakNota() {
        setTimeout(function() {
            window.print();
        }, 300);
    }
</script>
@endsection