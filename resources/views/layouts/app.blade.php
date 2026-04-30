<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RestoBook Lampung - @yield('title', 'Booking Restoran')</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f5f7f4;
            color: #18181b;
        }

        /* NAVBAR */
        .navbar {
            position: sticky;
            top: 0;
            z-index: 100;
            width: 100%;
            background: rgba(245, 247, 244, 0.85);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(0,0,0,0.06);
        }

        .navbar-inner {
            max-width: 1280px;
            margin: 0 auto;
            padding: 24px 48px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .navbar-brand {
            font-size: 24px;
            font-weight: 800;
            color: #ea580c;
            letter-spacing: -1.2px;
            text-decoration: none;
        }

        .navbar-links {
            display: flex;
            gap: 40px;
            align-items: center;
            list-style: none;
        }

        .navbar-links a {
            font-size: 16px;
            font-weight: 500;
            color: #52525b;
            text-decoration: none;
            letter-spacing: -0.4px;
            transition: color 0.2s;
        }

        .navbar-links a:hover,
        .navbar-links a.active {
            color: #ea580c;
            font-weight: 700;
            border-bottom: 2px solid #ea580c;
            padding-bottom: 2px;
        }

        .navbar-actions {
            display: flex;
            gap: 24px;
            align-items: center;
        }

        .btn-signin {
            font-size: 16px;
            font-weight: 500;
            color: #52525b;
            text-decoration: none;
            transition: color 0.2s;
        }

        .btn-signin:hover { color: #ea580c; }

        .btn-login {
            background: linear-gradient(135deg, #8c4a00 0%, #fd8b00 100%);
            color: #fff0e7;
            font-size: 16px;
            font-weight: 700;
            padding: 12px 32px;
            border-radius: 9999px;
            text-decoration: none;
            box-shadow: 0 20px 25px -5px rgba(140,74,0,0.1), 0 8px 10px -6px rgba(140,74,0,0.1);
            transition: opacity 0.2s;
        }

        .btn-login:hover { opacity: 0.9; }

        /*MAIN CONTENT*/
        main {
            min-height: calc(100vh - 96px);
        }

        /*FOOTER*/
        footer {
            background: #18181b;
            color: #a1a1aa;
            padding: 64px 48px 32px;
        }

        .footer-inner {
            max-width: 1280px;
            margin: 0 auto;
        }

        .footer-brand {
            font-size: 24px;
            font-weight: 800;
            color: #ea580c;
            margin-bottom: 12px;
        }

        .footer-desc {
            font-size: 14px;
            line-height: 1.6;
            max-width: 300px;
            margin-bottom: 32px;
        }

        .footer-bottom {
            border-top: 1px solid #3f3f46;
            padding-top: 24px;
            margin-top: 48px;
            font-size: 14px;
            display: flex;
            justify-content: space-between;
        }

        @yield('styles')
    </style>
    @yield('extra_styles')
</head>
<body>

    {{-- NAVBAR --}}
    <nav class="navbar">
        <div class="navbar-inner">
            {{-- Logo --}}
            <a href="{{ route('home') }}" class="navbar-brand">RestoBook</a>

            {{-- Menu Links --}}
            <ul class="navbar-links">
                <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Explore</a></li>
                @auth
                    <li><a href="{{ route('customer.reservations') }}" class="{{ request()->routeIs('customer.reservations') ? 'active' : '' }}">Reservasi Saya</a></li>
                @endauth
                <li><a href="#">Tentang Kami</a></li>
                <li><a href="#">Bantuan</a></li>
            </ul>

            {{-- Auth Buttons --}}
            <div class="navbar-actions">
                @guest
                    <a href="{{ route('login') }}" class="btn-signin">Sign In</a>
                    <a href="{{ route('register') }}" class="btn-login">Daftar</a>
                @endguest

                @auth
                    <span style="font-size:14px; color:#52525b;">
                        Halo, {{ auth()->user()->name }}
                    </span>

                    @if(auth()->user()->role === 'superadmin')
                        <a href="{{ route('admin.dashboard') }}" class="btn-signin">Dashboard</a>
                    @elseif(auth()->user()->role === 'owner')
                        <a href="{{ route('owner.dashboard') }}" class="btn-signin">Dashboard</a>
                    @endif

                    <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn-login" style="border:none; cursor:pointer;">
                            Logout
                        </button>
                    </form>
                @endauth
            </div>
        </div>
    </nav>

    {{-- KONTEN HALAMAN --}}
    <main>
        @yield('content')
    </main>

    {{-- FOOTER --}}
    <footer>
        <div class="footer-inner">
            <div class="footer-brand">RestoBook</div>
            <p class="footer-desc">Platform booking restoran & cafe terpercaya di Lampung. Dukung UMKM kuliner lokal Bandar Lampung.</p>
            <div class="footer-bottom">
                <span>© 2026 RestoBook Lampung. All rights reserved.</span>
                <span>Jl. Raden Intan No. 45, Bandar Lampung</span>
            </div>
        </div>
    </footer>

</body>
</html>