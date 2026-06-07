@extends('layouts.app')

@section('content')
<div class="bg-[#fafafa] min-h-screen py-12 font-['Plus_Jakarta_Sans',sans-serif]">
    <div class="container mx-auto px-6 max-w-6xl">
        <span class="text-orange-600 font-bold uppercase tracking-widest text-xs">Checkout Aman</span>
        <h1 class="text-4xl font-black text-slate-900 mt-2 mb-10 text-center">Selesaikan Reservasi Anda</h1>

        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-800 rounded-2xl text-sm font-medium">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="flex justify-center">
            <div class="lg:w-1/2 w-full">
                <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100">
                    <div class="relative rounded-3xl overflow-hidden h-40 mb-6">
                        <img src="https://images.unsplash.com/photo-1534422298391-e4f8c172dddb?q=80&w=400" class="w-full h-full object-cover" alt="Banner Resto">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent flex flex-col justify-end p-6">
                            <h3 class="font-black text-white">RestoBook Partner</h3>
                            <p class="text-xs text-white/70">Kode: {{ $booking->booking_code }}</p>
                        </div>
                    </div>

                    <div class="space-y-4 mb-8 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-400 font-medium">Tanggal & Jam</span>
                            <span class="font-bold text-slate-800">{{ date('d M Y', strtotime($booking->reservation_date)) }} • {{ \Carbon\Carbon::parse($booking->reservation_time)->format('H:i') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-400 font-medium">Jumlah Tamu</span>
                            <span class="font-bold text-slate-800">{{ $booking->num_guests }} Orang</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-400 font-medium">Keterangan Tambahan</span>
                            <span class="font-bold text-slate-800 font-mono text-xs">{{ $booking->notes }}</span>
                        </div>
                    </div>

                    <div class="space-y-3 pt-6 border-t border-gray-50 mb-8">
                        <div class="flex justify-between text-sm text-gray-400">
                            <span>Biaya Konsumsi Menu</span>
                            <span>Rp {{ number_format(max(0, $booking->total_price - 2000), 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-sm text-gray-400">
                            <span>Biaya Layanan</span>
                            <span>Rp 2.000</span>
                        </div>
                        <div class="flex justify-between items-center pt-2">
                            <span class="font-black text-slate-800">Total Tagihan</span>
                            <span class="font-black text-orange-600 text-2xl">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <button id="pay-button" class="w-full bg-orange-600 text-white py-5 rounded-3xl font-black text-lg shadow-xl shadow-orange-100 hover:bg-orange-700 transition-all transform hover:scale-[1.02]">
                        Bayar Sekarang
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ env('MIDTRANS_IS_PRODUCTION') ? 'https://app.midtrans.com/snap/snap.js' : 'https://app.sandbox.midtrans.com/snap/snap.js' }}" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
<script>
    document.getElementById('pay-button').onclick = function(){
        snap.pay('{{ $booking->snap_token }}', {
            onSuccess: function(result){
                window.location.href = "{{ route('booking.success', $booking->booking_code) }}";
            },
            onPending: function(result){
                window.location.href = "{{ route('booking.success', $booking->booking_code) }}";
            },
            onError: function(result){
                alert("Pembayaran Gagal!");
            },
            onClose: function(){
                alert('Anda menutup popup tanpa menyelesaikan pembayaran');
            }
        });
    };
</script>
@endsection