<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RestoBook – @yield('title', 'Dashboard')</title>

    <!-- FONT -->
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- ICON -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">

    <!-- GLOBAL CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <!-- PAGE CSS (opsional dari tiap halaman) -->
    @yield('extra-css')

    <!-- LUCIDE -->
    <script src="https://unpkg.com/lucide@latest"></script>
</head>

<body>

<div class="container">

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <div class="logo">
            <i data-lucide="utensils-crossed"></i>
            <span>RestoBook</span>
        </div>
        
        <div class="user-profile">
            <img src="https://via.placeholder.com/40" alt="Owner">
            <div class="user-info">
                <h4>Resto Owner</h4>
                <p>Manage your table</p>
            </div>
        </div>

        <nav class="menu">
            <a href="{{ route('owner.dashboard') }}"
               class="{{ request()->routeIs('owner.dashboard') ? 'active' : '' }}">
               <i data-lucide="layout-dashboard"></i> Dashboard
            </a>

            <a href="{{ route('owner.reservasi') }}"
               class="{{ request()->routeIs('owner.reservasi') ? 'active' : '' }}">
               <i data-lucide="calendar-check"></i> Reservasi
            </a>

            <a href="#"><i data-lucide="utensils"></i> Kelola Menu dan Meja</a>
            <a href="#"><i data-lucide="settings"></i> Pengaturan</a>
        </nav>

        <div class="logout">
            <a href="#"><i data-lucide="log-out"></i> Logout</a>
        </div>
    </aside>

    <!-- MAIN CONTENT -->
    @yield('content')

</div>

<script>
    lucide.createIcons();
</script>

</body>
</html>