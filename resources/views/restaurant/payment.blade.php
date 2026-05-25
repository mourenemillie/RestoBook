@extends('layouts.app')

@section('content')
<div class="bg-[#fafafa] min-h-screen py-12 font-['Plus_Jakarta_Sans',sans-serif]">
    <div class="container mx-auto px-6 max-w-6xl">
        <span class="text-orange-600 font-bold uppercase tracking-widest text-xs">Checkout Aman</span>
        <h1 class="text-4xl font-black text-slate-900 mt-2 mb-10">Selesaikan Reservasi Anda</h1>

        {{-- Pesan Peringatan Validasi Input File Bukti Struk/Metode Pembayaran --}}
        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-800 rounded-2xl text-sm font-medium">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- SINKRON: Mengarah ke route('booking.pay') sesuai isi routes/web.php Anda --}}
        <form action="{{ route('booking.pay', $booking->booking_code) }}" method="POST" enctype="multipart/form-data" class="flex flex-col lg:flex-row gap-8">
            @csrf

            {{-- KIRI: METODE PEMBAYARAN & UPLOAD --}}
            <div class="lg:w-2/3 space-y-8">
                <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100">
                    <div class="flex items-center gap-3 mb-8">
                        <div class="bg-orange-100 p-2 rounded-xl text-xl">💳</div>
                        <h2 class="text-xl font-black text-slate-800">Metode Pembayaran</h2>
                    </div>

                    <div class="grid md:grid-cols-2 gap-6">
                        {{-- Bank Transfer --}}
                        <div class="space-y-4">
                            <p class="text-sm font-bold text-gray-400 uppercase tracking-wider">Transfer Bank</p>
                            
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-2xl border-2 border-orange-600 cursor-pointer real-radio-card transition-all duration-200">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center font-bold text-blue-800 shadow-sm text-xs">BCA</div>
                                    <span class="font-bold text-slate-700">BCA Transfer</span>
                                </div>
                                <input type="radio" name="payment_method" value="BCA" checked class="sr-only">
                                <div class="radio-dot w-5 h-5 rounded-full border-4 border-orange-600 bg-white"></div>
                            </div>

                            <div class="flex items-center justify-between p-4 bg-white rounded-2xl border border-gray-100 cursor-pointer hover:bg-gray-50 transition-all real-radio-card duration-200">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center font-bold text-blue-500 shadow-sm text-xs">Mandiri</div>
                                    <span class="font-bold text-slate-700">Mandiri Transfer</span>
                                </div>
                                <input type="radio" name="payment_method" value="MANDIRI" class="sr-only">
                                <div class="radio-dot w-5 h-5 rounded-full border border-gray-200 bg-white"></div>
                            </div>
                        </div>

                        {{-- E-Wallet --}}
                        <div class="space-y-4">
                            <p class="text-sm font-bold text-gray-400 uppercase tracking-wider">E-wallet</p>
                            
                            <div class="flex items-center justify-between p-4 bg-white rounded-2xl border border-gray-100 cursor-pointer hover:bg-gray-50 transition-all real-radio-card duration-200">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center font-bold text-blue-400 shadow-sm text-xs">GoPay</div>
                                    <span class="font-bold text-slate-700">GoPay</span>
                                </div>
                                <input type="radio" name="payment_method" value="GOPAY" class="sr-only">
                                <div class="radio-dot w-5 h-5 rounded-full border border-gray-200 bg-white"></div>
                            </div>

                            <div class="flex items-center justify-between p-4 bg-white rounded-2xl border border-gray-100 cursor-pointer hover:bg-gray-50 transition-all real-radio-card duration-200">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center font-bold text-purple-600 shadow-sm text-xs">OVO</div>
                                    <span class="font-bold text-slate-700">OVO</span>
                                </div>
                                <input type="radio" name="payment_method" value="OVO" class="sr-only">
                                <div class="radio-dot w-5 h-5 rounded-full border border-gray-200 bg-white"></div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Upload Bukti --}}
                <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100">
                    <div class="flex items-center gap-3 mb-8">
                        <div class="bg-orange-100 p-2 rounded-xl text-xl">☁️</div>
                        <h2 class="text-xl font-black text-slate-800">Upload Bukti Pembayaran</h2>
                    </div>
                    <div class="border-2 border-dashed border-gray-200 rounded-[2rem] p-12 flex flex-col items-center justify-center text-center group hover:border-orange-200 transition-all relative">
                        <div class="w-16 h-16 bg-orange-50 text-orange-600 rounded-2xl flex items-center justify-center mb-4 text-2xl">📄</div>
                        <p class="font-black text-slate-800 mb-1" id="file-label-text">Letakkan struk Anda di sini</p>
                        <p class="text-xs text-gray-400 mb-6 font-medium max-w-[200px]">Format: JPG, PNG (Maks 5MB)</p>
                        <input type="file" name="payment_proof" id="payment_proof" class="absolute inset-0 opacity-0 cursor-pointer" onchange="updateFileName(this)" required>
                        <button type="button" class="px-6 py-3 bg-gray-100 text-slate-700 font-bold rounded-xl pointer-events-none">Pilih File</button>
                    </div>
                </div>
            </div>

            {{-- KANAN: RINGKASAN DATA ASLI DATABASE --}}
            <div class="lg:w-1/3">
                <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100 sticky top-10">
                    <div class="relative rounded-3xl overflow-hidden h-40 mb-6">
                        <img src="https://images.unsplash.com/photo-1534422298391-e4f8c172dddb?q=80&w=400" class="w-full h-full object-cover" alt="Banner Resto">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent flex flex-col justify-end p-6">
                            <h3 class="font-black text-white">{{ $booking->restaurant_name }}</h3>
                            <p class="text-xs text-white/70">Kode: {{ $booking->booking_code }}</p>
                        </div>
                    </div>

                    <div class="space-y-4 mb-8 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-400 font-medium">Tanggal & Jam</span>
                            <span class="font-bold text-slate-800">{{ date('d M Y', strtotime($booking->booking_date)) }} • {{ $booking->booking_time }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-400 font-medium">Jumlah Tamu</span>
                            <span class="font-bold text-slate-800">{{ $booking->number_of_people }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-400 font-medium">Area Meja</span>
                            <span class="font-bold text-slate-800 font-mono text-xs">{{ $booking->table_area }}</span>
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

                    <button type="submit" class="w-full bg-orange-600 text-white py-5 rounded-3xl font-black text-lg shadow-xl shadow-orange-100 hover:bg-orange-700 transition-all transform hover:scale-[1.02]">
                        Konfirmasi Pembayaran
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    function updateFileName(input) {
        const textLabel = document.getElementById('file-label-text');
        if (input.files && input.files[0]) {
            textLabel.innerText = "Terpilih: " + input.files[0].name;
            textLabel.className = "font-black text-orange-600 mb-1";
        }
    }

    document.querySelectorAll('.real-radio-card').forEach(card => {
        card.addEventListener('click', function() {
            document.querySelectorAll('.real-radio-card').forEach(c => {
                c.classList.remove('border-orange-600', 'bg-gray-50', 'border-2');
                c.classList.add('border-gray-100', 'bg-white', 'border');
                c.querySelector('.radio-dot').className = "radio-dot w-5 h-5 rounded-full border border-gray-200 bg-white";
                c.querySelector('input[type="radio"]').checked = false;
            });

            this.classList.remove('border-gray-100', 'bg-white', 'border');
            this.classList.add('border-orange-600', 'bg-gray-50', 'border-2');
            
            const targetRadio = this.querySelector('input[type="radio"]');
            targetRadio.checked = true;
            
            this.querySelector('.radio-dot').className = "radio-dot w-5 h-5 rounded-full border-4 border-orange-600 bg-white";
        });
    });
</script>
@endsection