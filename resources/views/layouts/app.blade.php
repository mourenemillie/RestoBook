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
    
    <!-- Navbar dengan efek Glassmorphism (Transparan & Sticky) -->
    <nav class="bg-white/80 backdrop-blur-md sticky top-0 z-50 py-4 px-8 shadow-sm border-b border-gray-100/50">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <!-- Logo Aplikasi -->
            <a href="{{ url('/') }}" class="flex items-center gap-2">
                <span class="text-primary text-2xl font-bold material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">restaurant</span>
                <span class="text-2xl font-extrabold text-[#963700] tracking-tight">Resto<span class="text-primary">Book</span></span>
            </a>

            <!-- Menu Navigasi Tengah -->
            <div class="hidden md:flex space-x-10 font-medium text-slate-500 text-sm">
                <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'text-primary font-bold border-b-[1.5px] border-primary pb-1' : 'hover:text-primary transition border-b-[1.5px] border-transparent pb-1' }}">Jelajahi</a>
                
                @auth
                    @if(auth()->user()->role === 'customer')
                        <a href="{{ route('customer.reservations') }}" class="{{ request()->routeIs('customer.reservations') ? 'text-primary font-bold border-b-[1.5px] border-primary pb-1' : 'hover:text-primary transition border-b-[1.5px] border-transparent pb-1' }}">Riwayat Reservasi</a>
                    @endif
                @else
                    <a href="{{ url('/#reservasi') }}" class="hover:text-primary transition border-b-[1.5px] border-transparent pb-1">Reservasi</a>
                @endauth
                
                <a href="{{ url('/#tentang-resto') }}" class="hover:text-primary transition border-b-[1.5px] border-transparent pb-1">Tentang Kami</a>
            </div>

            <!-- Bagian Kanan (Login/Profil) -->
            <div class="flex gap-6 items-center text-sm">
                @guest
                    <a href="{{ route('register') }}" class="font-bold text-primary hover:text-[#C44005] transition">Daftar</a>
                    <a href="{{ route('login') }}" class="bg-primary text-white px-8 py-2.5 rounded-full font-bold hover:bg-[#C44005] transition shadow-md shadow-orange-200">Masuk</a>
                @endguest

                @auth
                    <div class="flex items-center gap-4">
                        <!-- Link Dashboard khusus Admin/Owner -->
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="font-bold text-primary hover:text-[#C44005] transition bg-orange-50 px-4 py-2 rounded-full">Dashboard Admin</a>
                        @elseif(auth()->user()->role === 'owner')
                            <a href="{{ route('owner.dashboard') }}" class="font-bold text-primary hover:text-[#C44005] transition bg-orange-50 px-4 py-2 rounded-full">Kelola Restoran</a>
                        @endif

                        <!-- Profil Pengguna -->
                        <div class="flex items-center gap-3 bg-white px-3 py-1.5 rounded-full border border-gray-200 shadow-sm hover:shadow-md transition">
                            <!-- Foto Profil (Menampilkan default jika tidak ada, atau yang diupload/dari google) -->
                            <img src="{{ auth()->user()->avatar ? (Str::startsWith(auth()->user()->avatar, 'http') ? auth()->user()->avatar : asset('storage/' . auth()->user()->avatar)) : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) . '&background=E8500A&color=fff' }}" alt="Profile" class="w-8 h-8 rounded-full object-cover border border-gray-100">
                            
                            <span class="font-bold text-slate-800 pr-2">
                                {{ auth()->user()->name }}
                            </span>
                            
                            <!-- Tombol Logout -->
                            <form action="{{ route('logout') }}" method="POST" class="inline border-l border-gray-200 pl-3 pr-2">
                                @csrf
                                <button type="submit" class="text-xs font-bold text-red-500 hover:text-red-700 transition flex items-center gap-1">
                                    <span class="material-symbols-outlined" style="font-size: 16px;">logout</span>
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
                <p class="text-slate-500 leading-relaxed max-w-sm text-sm">Memberdayakan UMKM kuliner di Bandar Lampung dengan sistem reservasi instan dan mudah bagi semua kalangan.</p>
            </div>
            <div>
                <h3 class="text-sm font-extrabold mb-6 text-slate-800 uppercase tracking-wider">Jelajahi</h3>
                <ul class="text-slate-500 space-y-4 text-sm font-medium">
                    <li><a href="#" class="hover:text-primary transition">Tentang Kami</a></li>
                    <li><a href="{{ route('register') }}?role=owner" class="hover:text-primary transition">Gabung Jadi Mitra</a></li>
                    <li><a href="#" class="hover:text-primary transition">Pusat Bantuan</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-sm font-extrabold mb-6 text-slate-800 uppercase tracking-wider">Kontak</h3>
                <p class="text-slate-500 mb-4 text-sm font-medium">Jl. Raden Intan No. 45<br>Bandar Lampung</p>
                <div class="flex space-x-4 mt-6">
                    <span class="w-10 h-10 bg-orange-50 text-primary rounded-full flex items-center justify-center cursor-pointer hover:bg-primary hover:text-white transition text-xs font-bold">IG</span>
                    <span class="w-10 h-10 bg-orange-50 text-primary rounded-full flex items-center justify-center cursor-pointer hover:bg-primary hover:text-white transition text-xs font-bold">FB</span>
                </div>
            </div>
        </div>
        
        <div class="max-w-7xl mx-auto px-8 mt-16 pt-8 border-t border-gray-100 flex flex-col md:flex-row justify-between items-center text-slate-400 text-xs font-bold">
            <p>© {{ date('Y') }} RestoBook Lampung. Hak cipta dilindungi.</p>
            <div class="flex gap-6 mt-4 md:mt-0">
                <a href="#" class="hover:text-primary transition">Kebijakan Privasi</a>
                <a href="#" class="hover:text-primary transition">Syarat Ketentuan</a>
            </div>
        </div>
    </footer>

</body>
</html>