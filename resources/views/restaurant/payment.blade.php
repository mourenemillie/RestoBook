@extends('layouts.app')

@section('content')
<div class="bg-[#fafafa] min-h-screen py-12 font-['Plus_Jakarta_Sans',sans-serif]">
    <div class="container mx-auto px-6 max-w-6xl">
        <span class="text-orange-600 font-bold uppercase tracking-widest text-xs">Checkout Aman</span>
        <h1 class="text-4xl font-black text-slate-900 mt-2 mb-10">Selesaikan Reservasi Anda</h1>

        <div class="flex flex-col lg:flex-row gap-8">
            {{-- KIRI: METODE PEMBAYARAN --}}
            <div class="lg:w-2/3 space-y-8">
                {{-- Pilih Metode --}}
                <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100">
                    <div class="flex items-center gap-3 mb-8">
                        <div class="bg-orange-100 p-2 rounded-xl text-xl">💳</div>
                        <h2 class="text-xl font-black text-slate-800">Metode Pembayaran</h2>
                    </div>

                    <div class="grid md:grid-cols-2 gap-6">
                        {{-- Bank Transfer --}}
                        <div class="space-y-4">
                            <p class="text-sm font-bold text-gray-400 uppercase tracking-wider">Transfer Bank</p>
                            <label class="flex items-center justify-between p-4 bg-gray-50 rounded-2xl border-2 border-orange-600 cursor-pointer">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center font-bold text-blue-800 shadow-sm text-xs">BCA</div>
                                    <span class="font-bold text-slate-700">BCA Transfer</span>
                                </div>
                                <div class="w-5 h-5 rounded-full border-4 border-orange-600 bg-white"></div>
                            </label>
                            <label class="flex items-center justify-between p-4 bg-white rounded-2xl border border-gray-100 cursor-pointer hover:bg-gray-50 transition-all">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center font-bold text-blue-500 shadow-sm text-xs">Mandiri</div>
                                    <span class="font-bold text-slate-700">Mandiri Transfer</span>
                                </div>
                                <div class="w-5 h-5 rounded-full border border-gray-200 bg-white"></div>
                            </label>
                        </div>

                        {{-- E-Wallet --}}
                        <div class="space-y-4">
                            <p class="text-sm font-bold text-gray-400 uppercase tracking-wider">E-wallet</p>
                            <label class="flex items-center justify-between p-4 bg-white rounded-2xl border border-gray-100 cursor-pointer hover:bg-gray-50 transition-all">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center font-bold text-blue-400 shadow-sm text-xs">GoPay</div>
                                    <span class="font-bold text-slate-700">GoPay</span>
                                </div>
                                <div class="w-5 h-5 rounded-full border border-gray-200 bg-white"></div>
                            </label>
                            <label class="flex items-center justify-between p-4 bg-white rounded-2xl border border-gray-100 cursor-pointer hover:bg-gray-50 transition-all">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center font-bold text-purple-600 shadow-sm text-xs">OVO</div>
                                    <span class="font-bold text-slate-700">OVO</span>
                                </div>
                                <div class="w-5 h-5 rounded-full border border-gray-200 bg-white"></div>
                            </label>
                        </div>
                    </div>
                </div>

                {{-- Upload Bukti --}}
                <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100">
                    <div class="flex items-center gap-3 mb-8">
                        <div class="bg-orange-100 p-2 rounded-xl text-xl">☁️</div>
                        <h2 class="text-xl font-black text-slate-800">Upload Bukti Pembayaran</h2>
                    </div>
                    
                    <div class="border-2 border-dashed border-gray-100 rounded-[2rem] p-12 flex flex-col items-center justify-center text-center group hover:border-orange-200 transition-all">
                        <div class="w-16 h-16 bg-orange-50 text-orange-600 rounded-2xl flex items-center justify-center mb-4 text-2xl transform group-hover:scale-110 transition-all">📄</div>
                        <p class="font-black text-slate-800 mb-1">Letakkan struk Anda di sini</p>
                        <p class="text-xs text-gray-400 mb-6 font-medium text-pretty max-w-[200px]">Format yang diterima: JPG, PNG, PDF (Maks 5MB)</p>
                        <button class="px-6 py-3 bg-gray-100 text-slate-700 font-bold rounded-xl hover:bg-gray-200 transition-all">Pilih File</button>
                    </div>
                </div>
            </div>

            {{-- KANAN: RINGKASAN FINAL --}}
            <div class="lg:w-1/3">
                <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100 sticky top-10">
                    <div class="relative rounded-3xl overflow-hidden h-40 mb-6">
                        <img src="https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?q=80&w=400" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent flex flex-col justify-end p-6">
                            <h3 class="font-black text-white">Bakso Haji Sony</h3>
                            <p class="text-xs text-white/70">Fine Dining & Bakso Legendaris</p>
                        </div>
                    </div>

                    <div class="space-y-4 mb-8 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-400 font-medium">Tanggal & Jam</span>
                            <span class="font-bold text-slate-800">20 Nov 2024 • 12:00</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-400 font-medium">Jumlah Tamu</span>
                            <span class="font-bold text-slate-800">2 Orang</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-400 font-medium">Meja</span>
                            <span class="font-bold text-slate-800 font-mono text-xs">T-01 (View Jendela)</span>
                        </div>
                    </div>

                    <div class="space-y-3 pt-6 border-t border-gray-50 mb-8">
                        <div class="flex justify-between text-sm text-gray-400">
                            <span>Biaya Booking</span>
                            <span>Rp 33.000</span>
                        </div>
                        <div class="flex justify-between text-sm text-gray-400">
                            <span>Layanan (5%)</span>
                            <span>Rp 2.000</span>
                        </div>
                        <div class="flex justify-between items-center pt-2">
                            <span class="font-black text-slate-800">Total Tagihan</span>
                            <span class="font-black text-orange-600 text-2xl">Rp 35.000</span>
                        </div>
                    </div>

                    <button class="w-full bg-orange-600 text-white py-5 rounded-3xl font-black text-lg shadow-xl shadow-orange-100 hover:bg-orange-700 transition-all transform hover:scale-[1.02]">
                        Konfirmasi Pembayaran
                    </button>

                    <div class="mt-6 p-4 bg-orange-50 rounded-2xl flex gap-3 items-start border border-orange-100">
                        <div class="text-lg">🕒</div>
                        <p class="text-[10px] leading-relaxed text-orange-800 font-medium italic">
                            Pembayaran harus diselesaikan dalam waktu **15:00** menit untuk mengamankan meja pilihan Anda.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection