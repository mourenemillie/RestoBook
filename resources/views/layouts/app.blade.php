<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RestoBook Lampung - @yield('title', 'Booking Restoran')</title>
    
    <!-- Menggunakan Tailwind dari branch Ilham -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
    
    <!-- Menggunakan yield styles dari branch kamu -->
    @yield('extra_styles')
</head>
<body class="bg-gray-50 text-slate-900 flex flex-col min-h-screen">
    
    {{-- NAVBAR --}}
    <nav class="bg-white sticky top-0 z-50 shadow-sm py-4">
        <div class="container mx-auto px-6 flex justify-between items-center">
            
            {{-- Logo --}}
            <a href="{{ route('home') }}" class="flex items-center gap-2">
                <div class="w-10 h-10 bg-orange-600 rounded-lg flex items-center justify-center text-white font-bold text-xl">R</div>
                <span class="text-2xl font-bold text-slate-800">Resto<span class="text-orange-600">Book</span></span>
            </a>

            {{-- Menu Links (Gabungan UI Ilham & Logika Route Kamu) --}}
            <div class="hidden md:flex space-x-8 font-medium">
                <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'text-orange-600 border-b-2 border-orange-600' : 'hover:text-orange-600 transition' }}">Explore</a>
                
                @auth
                    <a href="{{ route('customer.reservations') ?? '#' }}" class="{{ request()->routeIs('customer.reservations') ? 'text-orange-600 border-b-2 border-orange-600' : 'hover:text-orange-600 transition' }}">Reservasi Saya</a>
                @endauth
                
                <a href="#" class="hover:text-orange-600 transition">Tentang Kami</a>
                <a href="#" class="hover:text-orange-600 transition">Bantuan</a>
            </div>

            {{-- Auth Buttons (Logika Auth/Guest Kamu diterapkan ke UI Ilham) --}}
            <div class="flex gap-4 items-center">
                @guest
                    <a href="{{ route('login') }}" class="font-semibold text-slate-700 hover:text-orange-600 transition">Sign In</a>
                    <a href="{{ route('register') }}" class="bg-orange-600 text-white px-6 py-2 rounded-full font-semibold hover:bg-orange-700 transition shadow-lg shadow-orange-200">Daftar</a>
                @endguest

                @auth
                    <span class="text-sm font-medium text-slate-600 hidden md:block">
                        Halo, {{ auth()->user()->name }}
                    </span>

                    @if(auth()->user()->role === 'superadmin')
                        <a href="{{ route('admin.dashboard') }}" class="font-semibold text-slate-700 hover:text-orange-600 transition">Dashboard</a>
                    @elseif(auth()->user()->role === 'owner')
                        <a href="{{ route('owner.dashboard') ?? '#' }}" class="font-semibold text-slate-700 hover:text-orange-600 transition">Dashboard</a>
                    @endif

                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="font-semibold text-red-500 hover:text-red-700 transition">
                            Logout
                        </button>
                    </form>
                @endauth
            </div>
        </div>
    </nav>

    {{-- KONTEN HALAMAN --}}
    <main class="flex-grow">
        @yield('content')
    </main>

    {{-- FOOTER (Gabungan struktur Ilham dan teks UMKM Lampung milikmu) --}}
    <footer class="bg-slate-900 text-white py-12 mt-auto">
        <div class="container mx-auto px-6 grid md:grid-cols-3 gap-8 text-center md:text-left">
            <div>
                <h3 class="text-xl font-bold mb-4">RestoBook</h3>
                <p class="text-slate-400 leading-relaxed">Platform booking restoran & cafe terpercaya di Lampung. Dukung UMKM kuliner lokal Bandar Lampung.</p>
            </div>
            <div>
                <h3 class="text-lg font-semibold mb-4">Quick Links</h3>
                <ul class="text-slate-400 space-y-2">
                    <li><a href="#" class="hover:text-white transition">Tentang Kami</a></li>
                    <li><a href="#" class="hover:text-white transition">Bantuan</a></li>
                    <li><a href="#" class="hover:text-white transition">Syarat & Ketentuan</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-lg font-semibold mb-4">Kontak & Sosial Media</h3>
                <p class="text-slate-400 mb-4">Jl. Raden Intan No. 45, Bandar Lampung</p>
                <div class="flex justify-center md:justify-start space-x-4">
                    <span class="w-10 h-10 bg-slate-800 rounded-full flex items-center justify-center cursor-pointer hover:bg-orange-600 transition">IG</span>
                    <span class="w-10 h-10 bg-slate-800 rounded-full flex items-center justify-center cursor-pointer hover:bg-orange-600 transition">FB</span>
                </div>
            </div>
        </div>
        
        {{-- Footer Bottom --}}
        <div class="container mx-auto px-6 mt-12 pt-6 border-t border-slate-800 text-center text-slate-500 text-sm">
            © {{ date('Y') }} RestoBook Lampung. All rights reserved.
        </div>
    </footer>

</body>
</html>