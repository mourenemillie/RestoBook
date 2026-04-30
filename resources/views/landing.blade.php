@extends('layouts.app')

@section('content')
<div class="bg-white">
    <section class="container mx-auto px-6 py-12 md:py-20 flex flex-col md:flex-row items-center gap-12">
        <div class="md:w-1/2">
            <div class="inline-block px-4 py-2 bg-orange-50 border border-orange-100 rounded-full text-orange-600 text-sm font-bold mb-6">
                📍 #1 Reservasi Restoran di Lampung
            </div>
            <h1 class="text-5xl md:text-6xl font-bold leading-tight text-slate-900">
                Booking Meja Kini <br> <span class="text-orange-600">Lebih Mudah</span>
            </h1>
            <p class="text-gray-500 mt-6 text-lg max-w-md leading-relaxed">
                Temukan restoran terbaik di Bandar Lampung dan lakukan reservasi instan tanpa perlu mengantri.
            </p>
            
            <div class="mt-10 bg-white p-2 rounded-2xl shadow-2xl flex flex-col md:flex-row gap-2 border border-gray-100">
                <input type="text" placeholder="Cari Bakso Sony, Wood Stairs..." class="flex-1 p-4 rounded-xl outline-none focus:ring-2 focus:ring-orange-100 text-slate-700">
                <button class="bg-orange-600 text-white px-8 py-4 rounded-xl font-bold hover:bg-orange-700 transition shadow-lg shadow-orange-200">Cari Sekarang</button>
            </div>
        </div>
        
        <div class="md:w-1/2 relative">
            <div class="absolute -top-10 -left-10 w-32 h-32 bg-orange-200 rounded-full blur-3xl opacity-50"></div>
            <img src="https://images.pexels.com/photos/1581384/pexels-photo-1581384.jpeg?auto=compress&cs=tinysrgb&w=800" alt="Restaurant" class="rounded-3xl shadow-2xl relative z-10 rotate-2 hover:rotate-0 transition duration-500 object-cover w-full h-[450px]">
            <div class="absolute -bottom-6 -right-6 bg-white p-6 rounded-2xl shadow-xl z-20 animate-bounce border border-gray-50">
                <span class="text-orange-600 font-bold text-xl">⭐ 4.9</span>
                <p class="text-xs text-gray-400 font-bold uppercase tracking-wider mt-1">Rating Tertinggi</p>
            </div>
        </div>
    </section>

    <section class="container mx-auto px-6 py-16">
        <div class="flex justify-between items-end mb-12">
            <div>
                <h2 class="text-3xl font-bold text-slate-800">Restoran Terpopuler</h2>
                <p class="text-gray-500 mt-2">Pilihan favorit para foodies di Lampung minggu ini.</p>
            </div>
            <a href="#" class="text-orange-600 font-bold hover:text-orange-700 transition flex items-center gap-2">
                Lihat Semua →
            </a>
        </div>

        <div class="grid md:grid-cols-3 gap-10">
            @php
                $dummyResto = [
                    [
                        'name' => 'Bakso Sony', 
                        'loc' => 'Jl. Wolter Monginsidi', 
                        'img' => 'https://upload.wikimedia.org/wikipedia/commons/2/28/Bakso_mi_bihun.jpg', 
                        'tag' => 'Favorit Lokal'
                    ],
                    [
                        'name' => 'Pindang Riu', 
                        'loc' => 'Way Halim', 
                        // Link gambar baru (Ikan Pindang/Gulai Ikan) yang lebih stabil
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
            <div class="bg-white rounded-[2rem] overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-500 group border border-gray-100 flex flex-col h-full">
                <div class="relative overflow-hidden">
                    <img src="{{ $resto['img'] }}" alt="{{ $resto['name'] }}" class="w-full h-64 object-cover group-hover:scale-110 transition duration-700">
                    <div class="absolute top-4 left-4 bg-white/90 backdrop-blur px-4 py-1.5 rounded-full text-xs font-black text-orange-600 uppercase tracking-widest shadow-sm">
                        {{ $resto['tag'] }}
                    </div>
                </div>
                <div class="p-8 flex flex-col flex-1">
                    <h3 class="text-2xl font-bold text-slate-800 group-hover:text-orange-600 transition">{{ $resto['name'] }}</h3>
                    <p class="text-gray-400 flex items-center gap-2 mt-2 font-medium text-sm">
                        📍 {{ $resto['loc'] }}
                    </p>
                    <div class="flex justify-between items-center mt-auto pt-8">
                        <div class="text-orange-500 font-bold">★★★★★</div>
                        <a href="#" class="bg-slate-900 text-white hover:bg-orange-600 px-6 py-2.5 rounded-xl text-sm font-bold transition-all shadow-lg">
                            Detail Resto
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    <section class="container mx-auto px-6 py-10 mb-20">
        <div class="bg-orange-600 rounded-[3rem] p-10 md:p-16 flex flex-col md:flex-row items-center justify-between gap-8 shadow-2xl shadow-orange-200">
            <div class="text-white md:w-2/3">
                <h2 class="text-4xl font-bold mb-4">Dukung UMKM Kuliner Lampung 🍜</h2>
                <p class="text-orange-100 text-lg leading-relaxed">
                    Setiap reservasi yang Anda lakukan membantu pengusaha lokal untuk terus berkembang dan menyajikan hidangan terbaik bagi masyarakat.
                </p>
            </div>
            <div class="md:w-1/3 flex justify-end">
                <button class="bg-white text-orange-600 px-10 py-5 rounded-2xl font-bold hover:bg-orange-50 transition shadow-xl text-lg">
                    Gabung Jadi Mitra
                </button>
            </div>
        </div>
    </section>
</div>
@endsection