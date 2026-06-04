@extends('layouts.app')

@section('content')
<div class="bg-white">
    {{-- HERO SECTION --}}
    <section class="container mx-auto px-6 py-12 md:py-20 flex flex-col md:flex-row items-center gap-12">
        <div class="md:w-1/2">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 bg-[#FFD9C9] rounded-full text-primary text-[10px] font-extrabold mb-6 tracking-widest uppercase">
                <span class="material-symbols-outlined text-sm">storefront</span> MSME EMPOWERMENT
            </div>
            <h1 class="text-5xl md:text-[64px] font-extrabold leading-[1.1] text-[#2D2320] tracking-tight">
                Booking Meja Kini <br><span class="text-primary">Lebih Mudah</span>
            </h1>
            <p class="text-slate-500 mt-6 text-base max-w-md leading-relaxed font-medium">
                Temukan dan pesan meja di restoran favoritmu di Bandar Lampung. Dukung UMKM lokal dengan pengalaman bersantap yang lebih baik.
            </p>
            {{-- FORM PENCARIAN --}}
            <form action="{{ route('restaurant.show') }}" method="GET" class="mt-10 bg-white p-3 rounded-3xl shadow-[0_20px_50px_rgba(0,0,0,0.1)] flex flex-col md:flex-row gap-3 border border-gray-100 max-w-xl">
                <div class="flex flex-1 items-center px-4 gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <input type="text" name="search" placeholder="Cari Bakso Sony, Wood Stairs..." class="w-full py-3 outline-none text-slate-700 font-medium">
                </div>
                <button type="submit" class="bg-orange-600 text-white px-10 py-4 rounded-2xl font-bold hover:bg-orange-700 transition shadow-lg shadow-orange-200">
                    Cari Sekarang
                </button>
            </form>
        </div>
        
        <div class="md:w-1/2 relative w-full flex justify-end">
            <!-- Hero Image -->
            <div class="relative z-10 w-full max-w-lg">
                <img src="https://images.pexels.com/photos/1581384/pexels-photo-1581384.jpeg?auto=compress&cs=tinysrgb&w=800" alt="Interior Restoran" class="w-full h-[550px] object-cover rounded-[3rem] shadow-2xl shadow-orange-900/10">
                
                <!-- Floating Card -->
                <div class="absolute -bottom-6 -left-16 bg-white px-6 py-5 rounded-2xl shadow-[0_20px_40px_rgba(0,0,0,0.08)] flex items-center gap-4 z-20 border border-gray-50">
                    <div class="w-10 h-10 bg-[#FFF1EC] rounded-full flex items-center justify-center text-primary border border-orange-100">
                        <span class="material-symbols-outlined text-xl">check_circle</span>
                    </div>
                    <div>
                        <p class="text-[#2D2320] font-extrabold text-sm">500+ UMKM</p>
                        <p class="text-xs text-slate-500 font-medium mt-0.5">Bergabung Bersama Kami</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- RESTORAN TERPOPULER SECTION --}}
    <section class="container mx-auto px-6 py-16">
        <div class="flex justify-between items-end mb-16">
            <div>
                <h2 class="text-4xl font-extrabold text-[#2D2320] tracking-tight">Restoran Terpopuler</h2>
                <div class="h-1.5 w-24 bg-primary rounded-full mt-4"></div>
            </div>
            <a href="#" class="text-primary font-bold text-sm flex items-center gap-2 hover:translate-x-2 transition-transform uppercase tracking-wider">
                Lihat Semua &rarr;
            </a>
        </div>

        <div class="grid md:grid-cols-3 gap-10">
            @php
                $dummyResto = [
                    [
                        'name' => 'Bakso Sony',
                        'loc' => 'Jl. Wolter Monginsidi',
                        'img' => asset('img/bakso_super.jpg'),
                        'tag' => 'Favorit Lokal',
                        'price' => 'Rp 35.000',
                        'rating' => '4.8'
                    ],
                    [
                        'name' => 'Pindang Riu',
                        'loc' => 'Way Halim',
                        'img' => asset('img/pindang_riu.jpeg'),
                        'tag' => 'Khas Lampung',
                        'price' => 'Rp 50.000',
                        'rating' => '4.7'
                    ],
                    [
                        'name' => 'Wood Stairs',
                        'loc' => 'Antasari',
                        'img' => 'https://images.pexels.com/photos/941861/pexels-photo-941861.jpeg?auto=compress&cs=tinysrgb&w=600',
                        'tag' => 'Premium',
                        'price' => 'Rp 150.000',
                        'rating' => '4.9'
                    ],
                ];
            @endphp

            @foreach($dummyResto as $resto)
            <div class="bg-white rounded-[2rem] overflow-hidden shadow-sm hover:shadow-[0_30px_60px_rgba(232,80,10,0.08)] transition-all duration-500 group flex flex-col h-full border border-gray-100 p-3 relative">
                <div class="relative overflow-hidden h-64 rounded-3xl">
                    <img src="{{ $resto['img'] }}" alt="{{ $resto['name'] }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                    <div class="absolute top-4 right-4 bg-white/95 backdrop-blur-sm px-3 py-1.5 rounded-full text-xs font-bold text-slate-800 shadow-sm flex items-center gap-1">
                        <span class="text-yellow-400 text-sm">★</span> {{ $resto['rating'] }}
                    </div>
                </div>
                <div class="px-5 py-6 flex flex-col flex-1">
                    <div class="flex gap-2 mb-4">
                        <span class="bg-[#FFF1EC] text-primary px-3 py-1 rounded-full text-[10px] font-extrabold tracking-widest uppercase">
                            {{ $resto['tag'] }}
                        </span>
                    </div>
                    <h3 class="text-xl font-extrabold text-[#2D2320] group-hover:text-primary transition mb-2">{{ $resto['name'] }}</h3>
                    <p class="text-slate-500 flex items-center gap-2 text-sm font-medium mb-6">
                        <span class="material-symbols-outlined text-lg">location_on</span> {{ $resto['loc'] }}
                    </p>
                    <div class="flex justify-between items-center mt-auto pt-10 border-t border-gray-50">
                        <div class="text-orange-400 flex gap-1">★★★★★</div>
                        <a href="{{ route('restaurant.show') }}" class="bg-slate-900 text-white hover:bg-orange-600 px-10 py-4 rounded-2xl text-sm font-black uppercase tracking-widest transition-all transform group-hover:-translate-y-1 shadow-xl">
                            Pesan
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    {{-- UMKM SECTION --}}
    <section class="container mx-auto px-6 py-10 mb-24">
        <div class="bg-orange-600 rounded-[4rem] p-10 md:p-20 flex flex-col md:flex-row items-center justify-between gap-12 shadow-[0_40px_80px_rgba(249,115,22,0.25)] relative overflow-hidden">
            <div class="text-white md:w-1/2 relative z-10 text-center md:text-left">
                <h2 class="text-4xl md:text-5xl font-extrabold mb-6 leading-tight">Dukung UMKM <br> Kuliner Lampung 🍜</h2>
                <p class="text-orange-50/90 text-base leading-relaxed mb-10 font-medium">
                    Setiap reservasi membantu pengusaha lokal berkembang dan menyajikan hidangan terbaik bagi masyarakat.
                </p>
                <a href="{{ route('register') }}" class="inline-block bg-white text-orange-600 px-12 py-5 rounded-[2rem] font-black hover:bg-orange-50 transition-all shadow-2xl uppercase tracking-widest text-lg">
                    Gabung Mitra
                </a>
            </div>

            <div class="md:w-1/2 relative h-80 flex items-center justify-center">
                <div class="absolute w-56 h-56 md:w-72 md:h-72 rounded-3xl overflow-hidden border-8 border-[#C44005] shadow-2xl transform -rotate-6 -translate-x-10">
                    <img src="https://images.pexels.com/photos/1211887/pexels-photo-1211887.jpeg?auto=compress&cs=tinysrgb&w=400" class="w-full h-full object-cover">
                </div>
                
                <div class="absolute w-56 h-56 md:w-72 md:h-72 rounded-3xl overflow-hidden border-8 border-[#E8500A] shadow-2xl transform rotate-6 translate-x-10 z-20">
                    <img src="https://images.pexels.com/photos/262959/pexels-photo-262959.jpeg?auto=compress&cs=tinysrgb&w=400" class="w-full h-full object-cover">
                </div>
            </div>

            <div class="absolute -top-32 -right-32 w-96 h-96 bg-white rounded-full opacity-5 blur-3xl"></div>
        </div>
    </section>
</div>
@endsection