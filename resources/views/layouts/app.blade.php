<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RestoBook Lampung - @yield('title', 'Booking Restoran')</title>

    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary': '#E8500A',
                        'surface-warm': '#FFF1EC',
                        'on-surface': '#261813',
                    },
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                    },
                    borderRadius: {
                        'DEFAULT': '1rem',
                        'lg': '2rem',
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
    
    @yield('extra_styles')
</head>
<body class="bg-surface-warm text-slate-900 flex flex-col min-h-screen antialiased">
    
    <nav class="bg-white sticky top-0 z-50 py-4 px-8 shadow-sm">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <a href="{{ url('/') }}" class="flex items-center gap-2">
                <span class="text-primary text-2xl font-bold material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">restaurant</span>
                <span class="text-2xl font-extrabold text-[#963700] tracking-tight">Resto<span class="text-primary">Book</span></span>
            </a>

            <div class="hidden md:flex space-x-10 font-medium text-slate-500 text-sm">
                <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'text-primary font-bold' : 'hover:text-primary transition' }}">Jelajahi</a>
                
                @auth
                    <a href="{{ route('customer.reservations') ?? '#' }}" class="{{ request()->routeIs('customer.reservations') ? 'text-primary font-bold' : 'hover:text-primary transition' }}">Reservasi</a>
                @else
                    <a href="#" class="hover:text-primary transition">Reservasi</a>
                @endauth
                
                <a href="#" class="hover:text-primary transition">Tentang Kami</a>
                <a href="#" class="hover:text-primary transition">Bantuan</a>
            </div>

            <div class="flex gap-6 items-center text-sm">
                @guest
                    <a href="{{ route('register') }}" class="font-bold text-primary hover:text-[#C44005] transition">Daftar</a>
                    <a href="{{ route('login') }}" class="bg-primary text-white px-8 py-2.5 rounded-full font-bold hover:bg-[#C44005] transition shadow-md shadow-orange-200">Masuk</a>
                @endguest

                @auth
                        <div class="flex items-center gap-4">
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="font-bold text-primary hover:text-[#C44005] transition">Dashboard</a>
                        @elseif(auth()->user()->role === 'owner')
                            <a href="{{ route('owner.dashboard') ?? '#' }}" class="font-bold text-primary hover:text-[#C44005] transition">Dashboard</a>
                        @endif

                        <div class="flex items-center gap-3 bg-orange-50 px-5 py-2 rounded-full border border-orange-100">
                            <span class="font-bold text-primary">
                                {{ auth()->user()->name }}
                            </span>
                            <form action="{{ route('logout') }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="text-xs font-bold text-slate-500 hover:text-red-600 transition">
                                    Keluar
                                </button>
                            </form>
                        </div>
                    </div>
                @endauth
            </div>
        </div>
    </nav>

    <main class="flex-grow w-full">
        @yield('content')
    </main>

    <footer class="bg-white text-slate-800 py-16 mt-auto border-t border-gray-100">
        <div class="max-w-7xl mx-auto px-8 grid md:grid-cols-4 gap-8">
            <div class="md:col-span-2">
                <a href="{{ url('/') }}" class="flex items-center gap-2 mb-6">
                    <span class="text-primary text-2xl font-bold material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">restaurant</span>
                    <span class="text-2xl font-extrabold text-[#963700] tracking-tight">Resto<span class="text-primary">Book</span></span>
                </a>
                <p class="text-slate-500 leading-relaxed max-w-sm text-sm">Empowering local MSME culinary businesses in Bandar Lampung with instant and seamless reservations.</p>
            </div>
            <div>
                <h3 class="text-sm font-extrabold mb-6 text-slate-800 uppercase tracking-wider">Explore</h3>
                <ul class="text-slate-500 space-y-4 text-sm font-medium">
                    <li><a href="#" class="hover:text-primary transition">About Us</a></li>
                    <li><a href="#" class="hover:text-primary transition">Partner with Us</a></li>
                    <li><a href="#" class="hover:text-primary transition">Help Center</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-sm font-extrabold mb-6 text-slate-800 uppercase tracking-wider">Contact</h3>
                <p class="text-slate-500 mb-4 text-sm font-medium">Jl. Raden Intan No. 45<br>Bandar Lampung</p>
                <div class="flex space-x-4 mt-6">
                    <span class="w-10 h-10 bg-orange-50 text-primary rounded-full flex items-center justify-center cursor-pointer hover:bg-primary hover:text-white transition text-xs font-bold">IG</span>
                    <span class="w-10 h-10 bg-orange-50 text-primary rounded-full flex items-center justify-center cursor-pointer hover:bg-primary hover:text-white transition text-xs font-bold">FB</span>
                </div>
            </div>
        </div>
        
        <div class="max-w-7xl mx-auto px-8 mt-16 pt-8 border-t border-gray-100 flex flex-col md:flex-row justify-between items-center text-slate-400 text-xs font-bold">
            <p>© {{ date('Y') }} RestoBook Lampung. All rights reserved.</p>
            <div class="flex gap-6 mt-4 md:mt-0">
                <a href="#" class="hover:text-primary transition">Privacy Policy</a>
                <a href="#" class="hover:text-primary transition">Terms of Service</a>
            </div>
        </div>
    </footer>

</body>
</html>