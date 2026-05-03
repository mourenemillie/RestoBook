@extends('layouts.app')

@section('content')
<div class="bg-white">
    <section class="container mx-auto px-6 py-12 md:py-20 flex flex-col md:flex-row items-center gap-12">
        <div class="md:w-1/2">
            <div class="inline-block px-4 py-2 bg-orange-50 border border-orange-100 rounded-full text-orange-600 text-sm font-bold mb-6">
                📍 #1 Reservasi Restoran di Lampung
            </div>
            <h1 class="text-5xl md:text-7xl font-extrabold leading-tight text-slate-900 tracking-tight">
                Booking Meja Kini <br> <span class="text-orange-600">Lebih Mudah</span>
            </h1>
            <p class="text-gray-500 mt-6 text-xl max-w-md leading-relaxed font-medium">
                Temukan restoran terbaik di Bandar Lampung dan lakukan reservasi instan tanpa perlu mengantri.
            </p>
            
            <div class="mt-10 bg-white p-3 rounded-3xl shadow-[0_20px_50px_rgba(0,0,0,0.1)] flex flex-col md:flex-row gap-3 border border-gray-100 max-w-xl">
                <div class="flex flex-1 items-center px-4 gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <input type="text" placeholder="Cari Bakso Sony, Wood Stairs..." class="w-full py-3 outline-none text-slate-700 font-medium">
                </div>
                <button class="bg-orange-600 text-white px-10 py-4 rounded-2xl font-bold hover:bg-orange-700 transition shadow-lg shadow-orange-200">
                    Cari Sekarang
                </button>
            </div>
        </div>
        
        <div class="md:w-1/2 relative">
            <div class="absolute -top-10 -left-10 w-48 h-48 bg-orange-200 rounded-full blur-[80px] opacity-40"></div>
            <div class="relative z-10 p-4 bg-white rounded-[2.5rem] shadow-2xl border border-gray-50 rotate-2">
                <img src="https://images.pexels.com/photos/1581384/pexels-photo-1581384.jpeg?auto=compress&cs=tinysrgb&w=800" alt="Interior" class="rounded-[2rem] object-cover w-full h-[500px]">
                <div class="absolute -bottom-8 -right-8 bg-white p-6 rounded-[2rem] shadow-2xl z-20 border border-gray-50 flex flex-col items-center animate-bounce">
                    <span class="text-orange-600 font-black text-3xl">⭐ 4.9</span>
                    <p class="text-[10px] text-gray-400 font-black uppercase tracking-[0.2em]">Rating Tertinggi</p>
                </div>
            </div>
        </div>
    </section>

    <section class="container mx-auto px-6 py-16">
        <div class="flex justify-between items-end mb-16">
            <div>
                <h2 class="text-4xl font-black text-slate-900 tracking-tight">Restoran Terpopuler</h2>
                <div class="h-1.5 w-24 bg-orange-600 rounded-full mt-4"></div>
            </div>
            <a href="#" class="text-orange-600 font-bold text-lg flex items-center gap-2 hover:translate-x-2 transition-transform">
                Lihat Semua →
            </a>
        </div>

        <div class="grid md:grid-cols-3 gap-12">
            @php
                $dummyResto = [
                    [
                        'name' => 'Bakso Sony', 
                        'loc' => 'Jl. Wolter Monginsidi', 
                        'img' => 'https://images.pexels.com/photos/2233729/pexels-photo-2233729.jpeg?auto=compress&cs=tinysrgb&w=600', 
                        'tag' => 'Favorit Lokal'
                    ],
                    [
                        'name' => 'Pindang Riu', 
                        'loc' => 'Way Halim', 
                        'img' => 'https://images.pexels.com/photos/2098085/pexels-photo-2098085.jpeg?auto=compress&cs=tinysrgb&w=600', 
                        'tag' => 'Khas Lampung'
                    ],
                    [
                        'name' => 'Wood Stairs', 
                        'loc' => 'Antasari', 
                        'img' => 'https://images.pexels.com/photos/941861/pexels-photo-941861.jpeg?auto=compress&cs=tinysrgb&w=600', 
                        'tag' => 'Premium'
                    ],
                ];
            @endphp

            @foreach($dummyResto as $resto)
            <div class="bg-white rounded-[3rem] overflow-hidden shadow-[0_10px_40px_rgba(0,0,0,0.04)] hover:shadow-[0_30px_60px_rgba(0,0,0,0.1)] transition-all duration-500 group border border-gray-50 flex flex-col h-full">
                <div class="relative overflow-hidden h-72">
                    <img src="{{ $resto['img'] }}" alt="{{ $resto['name'] }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-1000">
                    <div class="absolute top-6 left-6 bg-white/90 backdrop-blur-md px-5 py-2 rounded-2xl text-[11px] font-black text-orange-600 uppercase tracking-widest shadow-lg">
                        {{ $resto['tag'] }}
                    </div>
                </div>
                <div class="p-10 flex flex-col flex-1">
                    <h3 class="text-3xl font-black text-slate-800 group-hover:text-orange-600 transition">{{ $resto['name'] }}</h3>
                    <p class="text-gray-400 flex items-center gap-3 mt-4 font-semibold">
                        📍 {{ $resto['loc'] }}
                    </p>
                    <div class="flex justify-between items-center mt-auto pt-10 border-t border-gray-50">
                        <div class="text-orange-400 flex gap-1">★★★★★</div>
                        <a href="#" class="bg-slate-900 text-white hover:bg-orange-600 px-10 py-4 rounded-2xl text-sm font-black uppercase tracking-widest transition-all transform group-hover:-translate-y-1 shadow-xl">
                            Pesan
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    <section class="container mx-auto px-6 py-10 mb-24">
        <div class="bg-orange-600 rounded-[4rem] p-10 md:p-20 flex flex-col md:flex-row items-center justify-between gap-12 shadow-[0_40px_80px_rgba(249,115,22,0.25)] relative overflow-hidden">
            
            <div class="text-white md:w-1/2 relative z-10 text-center md:text-left">
                <h2 class="text-4xl md:text-5xl font-black mb-6 leading-tight">Dukung UMKM <br> Kuliner Lampung 🍜</h2>
                <p class="text-orange-50 text-xl leading-relaxed opacity-90 mb-10">
                    Setiap reservasi membantu pengusaha lokal berkembang dan menyajikan hidangan terbaik bagi masyarakat.
                </p>
                <a href="{{ route('register') }}" class="inline-block bg-white text-orange-600 px-12 py-5 rounded-[2rem] font-black hover:bg-orange-50 transition-all shadow-2xl uppercase tracking-widest text-lg">
                    Gabung Mitra
                </a>
            </div>

            <div class="md:w-1/2 relative h-80 flex items-center justify-center">
                <div class="absolute w-56 h-56 md:w-72 md:h-72 rounded-[3rem] overflow-hidden border-[10px] border-orange-500 shadow-2xl transform -rotate-12 -translate-x-16">
                    <img src="https://images.pexels.com/photos/1211887/pexels-photo-1211887.jpeg?auto=compress&cs=tinysrgb&w=400" class="w-full h-full object-cover">
                </div>
                
                <div class="absolute w-56 h-56 md:w-72 md:h-72 rounded-[3rem] overflow-hidden border-[10px] border-orange-400 shadow-2xl transform rotate-6 translate-x-12 z-20">
                    <img src="https://images.pexels.com/photos/262959/pexels-photo-262959.jpeg?auto=compress&cs=tinysrgb&w=400" class="w-full h-full object-cover">
                </div>
            </div>

            <div class="absolute -top-20 -right-20 w-80 h-80 bg-orange-500 rounded-full opacity-20"></div>
        </div>
    </section>
</div>
@endsection