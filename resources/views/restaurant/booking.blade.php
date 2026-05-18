@extends('layouts.app')

@section('content')
<div class="bg-[#fafafa] min-h-screen py-12 font-['Plus_Jakarta_Sans',sans-serif]">
    <div class="container mx-auto px-6 max-w-6xl">
        <div class="flex flex-col lg:flex-row gap-8">
            
            {{-- KIRI: FORM RESERVASI --}}
            <div class="lg:w-2/3">
                <span class="text-orange-600 font-bold uppercase tracking-widest text-xs">Detail Reservasi</span>
                <h1 class="text-4xl font-black text-slate-900 mt-2 mb-4">Amankan Meja Anda di Bakso Sony</h1>
                <p class="text-gray-500 mb-10">Nikmati cita rasa legendaris dengan kenyamanan ekstra. Isi detail di bawah ini untuk menyelesaikan pemesanan meja Anda.</p>

                <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100">
                    <form action="#" method="POST">
                        @csrf
                        <div class="grid md:grid-cols-2 gap-6 mb-8">
                            <div>
                                <label class="block text-slate-700 font-bold mb-3">Pilih Tanggal</label>
                                <div class="relative">
                                    <input type="date" class="w-full bg-gray-50 border-none rounded-2xl p-4 text-gray-600 focus:ring-2 focus:ring-orange-500 outline-none font-semibold" value="{{ date('Y-m-d') }}">
                                </div>
                            </div>
                            <div>
                                <label class="block text-slate-700 font-bold mb-3">Jumlah Tamu</label>
                                <select class="w-full bg-gray-50 border-none rounded-2xl p-4 text-gray-600 focus:ring-2 focus:ring-orange-500 outline-none appearance-none font-semibold">
                                    <option>2 Orang</option>
                                    <option>4 Orang</option>
                                    <option>6+ Orang</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-8">
                            <label class="block text-slate-700 font-bold mb-4">Pilihan Jam Kedatangan</label>
                            <div class="flex flex-wrap gap-3">
                                @foreach(['10:00', '12:00', '14:00', '17:00', '19:00', '20:00'] as $time)
                                    <button type="button" class="px-6 py-3 rounded-2xl font-bold transition-all {{ $time == '12:00' ? 'bg-orange-50 text-orange-600 border-2 border-orange-600' : 'bg-gray-50 text-gray-400 border-2 border-transparent hover:border-gray-200' }}">
                                        {{ $time }}
                                    </button>
                                @endforeach
                            </div>
                        </div>

                        <div class="mb-8">
                            <div class="flex justify-between items-center mb-4">
                                <label class="block text-slate-700 font-bold">Pilihan Area Meja</label>
                                <span class="text-orange-600 text-xs font-bold uppercase cursor-pointer hover:underline">Lihat Denah Lokasi</span>
                            </div>
                            <div class="relative rounded-[2rem] overflow-hidden h-64 bg-slate-200 border border-gray-100">
                                <img src="https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?q=80&w=800" class="w-full h-full object-cover opacity-60">
                                <div class="absolute inset-0 flex items-center justify-center gap-4 px-6">
                                    <button type="button" class="bg-orange-600 text-white p-4 rounded-2xl shadow-xl flex flex-col items-center min-w-[90px] border-2 border-white transform scale-110">
                                        <span class="text-[10px] font-bold uppercase">Jendela</span>
                                        <span class="font-black text-lg">01</span>
                                    </button>
                                    <button type="button" class="bg-white/90 backdrop-blur text-slate-600 p-4 rounded-2xl flex flex-col items-center min-w-[90px] shadow-sm">
                                        <span class="text-[10px] font-bold uppercase">Tengah</span>
                                        <span class="font-black text-lg">04</span>
                                    </button>
                                    <button type="button" class="bg-white/90 backdrop-blur text-slate-600 p-4 rounded-2xl flex flex-col items-center min-w-[90px] shadow-sm">
                                        <span class="text-[10px] font-bold uppercase">Lantai 2</span>
                                        <span class="font-black text-lg">12</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            {{-- KANAN: RINGKASAN PESANAN (SIDEBAR) --}}
            <div class="lg:w-1/3">
                <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100 sticky top-10">
                    <div class="flex items-center gap-4 mb-6 pb-6 border-b border-gray-50">
                        <div class="w-16 h-16 bg-slate-100 rounded-2xl overflow-hidden shadow-sm">
                            <img src="{{ asset('img/bakso_super.jpg') }}" class="w-full h-full object-cover">
                        </div>
                        <div>
                            <h3 class="font-black text-slate-800">Bakso Haji Sony</h3>
                            <p class="text-xs text-gray-400 font-medium">📍 Wolter Monginsidi, Lampung</p>
                            <span class="inline-block mt-1 px-2 py-0.5 bg-orange-50 text-orange-600 text-[10px] font-bold rounded-lg uppercase">Legendaris • Bakso</span>
                        </div>
                    </div>

                    <div class="space-y-4 mb-6">
                        <div class="flex justify-between items-center">
                            <span class="text-sm font-bold text-slate-800">Pesanan Menu</span>
                            <span class="text-orange-600 text-xs font-bold cursor-pointer hover:underline">Ubah</span>
                        </div>
                        
                        <div class="flex justify-between text-sm">
                            <div>
                                <p class="font-bold text-slate-700">Bakso Super</p>
                                <p class="text-[10px] text-gray-400">Porsi Utama • 1x</p>
                            </div>
                            <span class="font-bold text-slate-800">Rp 25.000</span>
                        </div>

                        <div class="flex justify-between text-sm">
                            <div>
                                <p class="font-bold text-slate-700">Es Jeruk Peras</p>
                                <p class="text-[10px] text-gray-400">Minuman • 1x</p>
                            </div>
                            <span class="font-bold text-slate-800">Rp 8.000</span>
                        </div>
                    </div>

                    <div class="space-y-2 border-t border-gray-50 pt-6 mb-6">
                        <div class="flex justify-between text-sm text-gray-400 font-medium">
                            <span>Subtotal</span>
                            <span>Rp 33.000</span>
                        </div>
                        <div class="flex justify-between text-sm text-gray-400 font-medium">
                            <span>Biaya Layanan (Pajak)</span>
                            <span>Rp 2.000</span>
                        </div>
                    </div>

                    <div class="flex justify-between items-center mb-8">
                        <span class="font-black text-slate-800 text-lg">Estimasi Total</span>
                        <span class="font-black text-orange-600 text-2xl">Rp 35.000</span>
                    </div>

                    {{-- UPDATE: TOMBOL SEKARANG MENGARAH KE HALAMAN PEMBAYARAN --}}
                    <a href="{{ route('restaurant.payment') }}" class="w-full bg-orange-600 text-white py-5 rounded-3xl font-black text-lg shadow-xl shadow-orange-100 hover:bg-orange-700 transition-all flex items-center justify-center gap-3 transform hover:-translate-y-1">
                        Lanjut ke Pembayaran 
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>

                    <div class="mt-6 flex items-start gap-3 bg-gray-50 p-4 rounded-2xl border border-gray-100">
                        <div class="bg-orange-100 p-2 rounded-xl text-lg">🛡️</div>
                        <div>
                            <p class="text-[11px] font-bold text-slate-800 uppercase tracking-wider">Booking Aman</p>
                            <p class="text-[10px] text-gray-400 leading-relaxed">Data pembayaran Anda dienkripsi secara otomatis dan aman.</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection