@extends('layouts.app')

@section('content')
<div class="bg-surface-warm pb-24">
    <!-- Hero Section -->
    <section class="max-w-7xl mx-auto px-8 py-12 md:py-20 flex flex-col md:flex-row items-center gap-16">
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
            
            <div class="mt-10 bg-white p-2 rounded-full shadow-[0_20px_50px_rgba(232,80,10,0.08)] flex items-center border border-orange-50 max-w-xl relative">
                <div class="flex flex-1 items-center px-5 gap-3">
                    <span class="material-symbols-outlined text-slate-400 text-xl">search</span>
                    <input type="text" placeholder="Cari nama restoran atau lokasi..." class="w-full py-3 outline-none text-slate-700 text-sm font-medium bg-transparent border-none focus:ring-0">
                </div>
                <button class="bg-primary text-white px-8 py-3.5 rounded-full text-sm font-bold hover:bg-[#C44005] transition shadow-md shadow-orange-900/10 whitespace-nowrap">
                    Cari Meja
                </button>
            </div>
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

    <!-- Restoran Terpopuler Section -->
    <section class="max-w-7xl mx-auto px-8 py-20 mt-10">
        <div class="flex justify-between items-end mb-12">
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
                        'img' => 'https://images.pexels.com/photos/2233729/pexels-photo-2233729.jpeg?auto=compress&cs=tinysrgb&w=600', 
                        'tag' => 'Favorit Lokal',
                        'price' => 'Rp 35.000',
                        'rating' => '4.8'
                    ],
                    [
                        'name' => 'Pindang Riu', 
                        'loc' => 'Way Halim', 
                        'img' => 'https://images.pexels.com/photos/2098085/pexels-photo-2098085.jpeg?auto=compress&cs=tinysrgb&w=600', 
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
                    
                    <div class="flex justify-between items-center mt-auto pt-6 border-t border-slate-50">
                        <div>
                            <p class="text-[11px] text-slate-400 font-bold uppercase tracking-wider mb-1">Mulai dari</p>
                            <p class="text-[#2D2320] font-extrabold">{{ $resto['price'] }}</p>
                        </div>
                        <a href="#" class="bg-primary text-white hover:bg-[#C44005] px-6 py-2.5 rounded-full text-sm font-bold transition-all transform hover:-translate-y-0.5 shadow-md shadow-orange-900/10">
                            Pesan
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    <!-- Dukung UMKM Section -->
    <section class="max-w-7xl mx-auto px-8 py-10 mb-20">
        <div class="bg-primary rounded-[3rem] p-10 md:p-16 flex flex-col md:flex-row items-center justify-between gap-12 shadow-2xl shadow-orange-900/20 relative overflow-hidden">
            
            <div class="text-white md:w-1/2 relative z-10 text-center md:text-left">
                <h2 class="text-4xl md:text-5xl font-extrabold mb-6 leading-tight">Dukung UMKM <br> Kuliner Lampung 🍜</h2>
                <p class="text-orange-50/90 text-base leading-relaxed mb-10 font-medium">
                    Setiap reservasi membantu pengusaha lokal berkembang dan menyajikan hidangan terbaik bagi masyarakat.
                </p>
                <button class="bg-white text-primary px-10 py-4 rounded-full font-bold hover:bg-orange-50 transition-all shadow-xl text-sm uppercase tracking-wider">
                    Gabung Mitra
                </button>
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