<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RestoBook – @yield('title', 'Dashboard')</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display&family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
    *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }
    :root {
    --primary:  #E8714A;
    --primary-light: #FFF4EE;
    --bg:       #F6F5F2;
    --white:    #FFFFFF;
    --border:   #E8E6E1;
    --text:     #1A1A18;
    --muted:    #9A9690;
}

    body {
        font-family: 'DM Sans', sans-serif;
        background: var(--bg);
        display: flex;
        min-height: 100vh;
        color: var(--text);
    }

    /* SIDEBAR */
    .sidebar {
        width: 200px;
        background: var(--white);
        border-right: 1px solid var(--border);
        display: flex;
        flex-direction: column;
        padding: 22px 0 0;
        position: fixed;
        top: 0; left: 0;
        height: 100vh;
        z-index: 50;
    }

    .sb-brand {
        display: flex; align-items: center; gap: 10px;
        padding: 0 18px 20px;
        border-bottom: 1px solid var(--border);
        margin-bottom: 10px;
    }

    .sb-avatar {
        width: 36px; height: 36px; border-radius: 50%;
        background: var(--primary);
        color: #fff; font-weight: 700; font-size: 14px;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
    }

    .sb-brand-info .sb-role { font-size: 10.5px; color: var(--primary); font-weight: 700; }
    .sb-brand-info .sb-name { font-size: 13.5px; font-weight: 700; color: var(--text); }
    .sb-brand-info .sb-sub  { font-size: 10.5px; color: var(--muted); }

    .sb-nav a {
        display: flex; align-items: center; gap: 10px;
        padding: 10px 18px;
        font-size: 13.5px; font-weight: 500;
        color: var(--muted);
        text-decoration: none;
        border-left: 3px solid transparent;
        transition: all .18s;
    }

    .sb-nav a:hover  { color: var(--primary); background: var(--primary-light); }
    .sb-nav a.active { color: var(--primary); background: var(--primary-light); border-left-color: var(--primary); font-weight: 700; }

    .sb-nav a i { font-size: 16px; }

    /* MAIN */
    .main {
        margin-left: 200px;
        flex: 1;
        padding: 32px 36px 0;
    }
</style>


@yield('extra-css')
<head>
<body>
<aside class="sidebar">
    <div class="sb-brand">
        <div class="sb-avatar">R</div>
        <div class="sb-brand-info">
            <div class="sb-role">Resto Owner</div>
            <div class="sb-name">RestoBook</div>
            <div class="sb-sub">Manage your table</div>
        </div>
    </div>
    <nav class="sb-nav">
        <a href="{{ route('owner.dashboard') }}" class="{{ request()->routeIs('owner.dashboard') ? 'active' : '' }}">
            <i class="bi bi-grid-1x2-fill"></i> Dashboard
        </a>
        <a href="#"><i class="bi bi-calendar-check"></i> Reservasi</a>
        <a href="#"><i class="bi bi-journal-bookmark-fill"></i> Kelola Menu</a>
        <a href="#"><i class="bi bi-bar-chart-line-fill"></i> Statistik</a>
        <a href="#"><i class="bi bi-gear-fill"></i> Pengaturan</a>
    </nav>
</aside>

<main class="main">
    @if(session('success'))
    <div style="background:#EDFAF3;border:1px solid #B2DFCE;color:#1a6640;border-radius:8px;padding:10px 16px;margin-bottom:16px;font-size:13px;font-weight:600;">
        ✓ {{ session('success') }}
    </div>
    @endif
    @yield('content')
</main>
</body>
</html>