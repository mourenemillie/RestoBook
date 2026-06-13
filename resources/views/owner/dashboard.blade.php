<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - RestoBook</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-orange: #e25c23;
            --primary-brown: #a63b0a;
            --bg-body: #fffaf8;
            --bg-sidebar: #ffffff;
            --text-main: #271f1d;
            --text-muted: #5e5450; /* Gelapkan dari #807773 */
            --border-color: #f2ebe8;
            --card-shadow: 0 4px 24px rgba(0, 0, 0, 0.02);
            
            --trend-green-bg: #e6f7ed;
            --trend-green-text: #219653;
            --trend-red-bg: #feeceb;
            --trend-red-text: #eb5757;
            --trend-neutral-bg: #faeaea;
            --trend-neutral-text: #c0776b;

            --font-family: 'Plus Jakarta Sans', sans-serif;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: var(--font-family);
            background-color: var(--bg-body);
            color: var(--text-main);
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            background-color: var(--bg-sidebar);
            border-right: 1px solid var(--border-color);
            display: flex;
            flex-direction: column;
            padding: 32px 0;
            flex-shrink: 0;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 0 28px;
            margin-bottom: 40px;
            color: var(--primary-orange);
            font-size: 20px;
            font-weight: 800;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0 28px;
            margin-bottom: 32px;
        }

        .user-profile img {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            object-fit: cover;
        }

        .user-info h4 {
            font-size: 14px;
            font-weight: 700;
            margin-bottom: 2px;
        }

        .user-info p {
            font-size: 11px;
            color: var(--text-muted);
        }

        .nav-menu {
            list-style: none;
            display: flex;
            flex-direction: column;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 16px 28px;
            color: var(--text-muted);
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            border-left: 4px solid transparent;
        }

        .nav-item svg {
            width: 20px;
            height: 20px;
            stroke-width: 2.5;
        }

        .nav-item.active {
            color: var(--primary-orange);
            background-color: #fff6f3;
            border-left-color: var(--primary-orange);
        }

        .logout {
            margin-top: auto;
            color: #d1302b;
            padding: 16px 28px;
            display: flex;
            align-items: center;
            gap: 14px;
            font-weight: 600;
            font-size: 14px;
            text-decoration: none;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            padding: 40px 48px;
            overflow-y: auto;
        }

        /* Header */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 32px;
        }

        .header-title h1 {
            font-size: 28px;
            font-weight: 800;
            margin-bottom: 8px;
            letter-spacing: -0.5px;
        }

        .header-title p {
            color: var(--text-muted);
            font-size: 15px;
            font-weight: 500;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .btn-icon {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background-color: #ffffff;
            border: 1px solid var(--border-color);
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            color: var(--text-main);
        }

        .btn-primary {
            background-color: var(--primary-brown);
            color: #ffffff;
            border: none;
            padding: 12px 24px;
            border-radius: 30px;
            font-weight: 600;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 24px;
        }

        .stat-card {
            background-color: #ffffff;
            border-radius: 20px;
            padding: 24px;
            box-shadow: var(--card-shadow);
        }

        .stat-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 24px;
        }

        .stat-icon {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .icon-orange { background-color: #fcece7; color: var(--primary-orange); }
        .icon-yellow { background-color: #fbf0df; color: #d97706; }
        .icon-brown { background-color: #f3e9e3; color: #854d0e; }
        .icon-red { background-color: #fbecec; color: #dc2626; }

        .stat-trend {
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .trend-up { background-color: var(--trend-green-bg); color: var(--trend-green-text); }
        .trend-down { background-color: var(--trend-red-bg); color: var(--trend-red-text); }
        .trend-neutral { background-color: var(--trend-neutral-bg); color: var(--trend-neutral-text); }

        .stat-title {
            font-size: 13px;
            font-weight: 500;
            color: var(--text-muted);
            margin-bottom: 8px;
        }

        .stat-value {
            font-size: 32px;
            font-weight: 800;
            color: var(--text-main);
            letter-spacing: -1px;
        }

        .stat-value span {
            font-size: 16px;
            font-weight: 600;
            color: var(--text-muted);
            letter-spacing: 0;
        }

        /* Middle Section */
        .middle-section {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 20px;
            margin-bottom: 24px;
        }

        .card {
            background-color: #ffffff;
            border-radius: 24px;
            padding: 28px;
            box-shadow: var(--card-shadow);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }

        .card-title {
            font-size: 18px;
            font-weight: 700;
        }

        .card-link {
            font-size: 13px;
            font-weight: 600;
            color: var(--primary-brown);
            text-decoration: none;
        }

        /* Table */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            text-align: left;
            font-size: 13px;
            font-weight: 500;
            color: var(--text-muted);
            padding-bottom: 16px;
            border-bottom: 1px solid var(--border-color);
        }

        td {
            padding: 16px 0;
            font-size: 14px;
            font-weight: 600;
            vertical-align: middle;
        }

        .customer-cell {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .avatar-initial {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: 700;
            font-size: 14px;
            color: #ffffff;
        }

        .bg-avatar-1 { background-color: #d95a1a; }
        .bg-avatar-2 { background-color: #8a6a4b; }
        .bg-avatar-3 { background-color: #ecc9c0; color: #a63b0a; }

        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
            display: inline-block;
        }

        .status-waiting { background-color: #fbdeb4; color: #b45309; }
        .status-confirmed { background-color: #d1f4e0; color: #15803d; }
        .status-done { background-color: #fce3dd; color: #9f1239; }

        .btn-more {
            background: none;
            border: none;
            cursor: pointer;
            color: var(--text-muted);
            padding: 4px;
        }

        /* Table Status */
        .table-status-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
            margin-bottom: 24px;
        }

        .table-circle {
            aspect-ratio: 1;
            border-radius: 50%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .table-circle h5 {
            font-size: 16px;
            font-weight: 800;
            margin-bottom: 2px;
            color: var(--text-main);
        }

        .table-circle span {
            font-size: 11px;
            font-weight: 600;
        }

        .t-empty { background-color: #fdede8; }
        .t-empty span { color: #885c54; }
        
        .t-filled { background-color: #def6e9; }
        .t-filled span { color: #2e7a51; }
        
        .t-booked { background-color: #f8cf9c; }
        .t-booked span { color: #8b4e05; }

        .table-legend {
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 12px;
            font-weight: 600;
            color: var(--text-main);
        }

        .legend-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
        }

        .dot-empty { background-color: #f7d2c6; }
        .dot-filled { background-color: #85d9a9; }
        .dot-booked { background-color: #f5b767; }

        /* Chart Section */
        .chart-container {
            height: 220px;
            display: flex;
            align-items: flex-end;
            gap: 2%;
            padding-bottom: 30px;
            border-bottom: 1px solid var(--border-color);
            margin-bottom: 16px;
        }

        .bar-wrapper {
            flex: 1;
            height: 100%;
            display: flex;
            align-items: flex-end;
            position: relative;
        }

        .bar {
            width: 100%;
            border-radius: 4px 4px 0 0;
        }

        .chart-labels {
            display: flex;
            justify-content: space-between;
            padding: 0 2%;
        }

        .chart-labels span {
            font-size: 13px;
            font-weight: 500;
            color: var(--text-muted);
            width: calc(100% / 7);
            text-align: center;
        }

        /* Responsive Adjustments */
        @media (max-width: 992px) {
            body { flex-direction: column; }
            .sidebar { width: 100%; border-right: none; border-bottom: 1px solid var(--border-color); padding: 16px; align-items: flex-start; }
            .logo { margin-bottom: 16px; padding: 0; }
            .user-profile { margin-bottom: 16px; padding: 0; display: none; }
            .nav-menu { display: flex; width: 100%; overflow-x: auto; gap: 8px; padding-bottom: 8px; flex-direction: row; }
            .nav-item { margin-bottom: 0; padding: 10px 16px; white-space: nowrap; }
            .main-content { max-width: 100%; padding: 20px; }
            .stats-grid { grid-template-columns: repeat(2, 1fr); }
            .header { flex-direction: column; align-items: flex-start; gap: 16px; }
            .header-actions { width: 100%; justify-content: space-between; }
        }
        @media (max-width: 576px) {
            .stats-grid { grid-template-columns: 1fr; }
            .table-responsive { overflow-x: auto; display: block; width: 100%; }
            th, td { white-space: nowrap; }
            .content-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

    <aside class="sidebar">
        <div class="logo">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <path d="M3 2v7c0 1.1.9 2 2 2h4a2 2 0 0 0 2-2V2"></path>
                <path d="M7 2v20"></path>
                <path d="M21 15V2v0a5 5 0 0 0-5 5v6c0 1.1.9 2 2 2h3zm0 0v7"></path>
            </svg>
            RestoBook
        </div>

        <div class="user-profile">
            <img src="{{ auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) . '&background=E8500A&color=fff' }}" alt="Resto Owner">
            <div class="user-info">
                <h4>Resto Owner</h4>
                <p>Manage your resto</p>
            </div>
        </div>

        <nav class="nav-menu">
            <a href="{{ route('owner.dashboard') }}" class="nav-item active">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="3" width="7" height="7"></rect>
                    <rect x="14" y="3" width="7" height="7"></rect>
                    <rect x="14" y="14" width="7" height="7"></rect>
                    <rect x="3" y="14" width="7" height="7"></rect>
                </svg>
                Dashboard
            </a>
            <a href="{{ route('owner.reservasi') }}" class="nav-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                    <line x1="16" y1="2" x2="16" y2="6"></line>
                    <line x1="8" y1="2" x2="8" y2="6"></line>
                    <line x1="3" y1="10" x2="21" y2="10"></line>
                </svg>
                Reservasi
            </a>
            <a href="{{ route('owner.kelola-meja') }}" class="nav-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 2v7c0 1.1.9 2 2 2h4a2 2 0 0 0 2-2V2"></path>
                    <path d="M7 2v20"></path>
                    <path d="M21 15V2v0a5 5 0 0 0-5 5v6c0 1.1.9 2 2 2h3zm0 0v7"></path>
                </svg>
                Kelola Menu dan Meja
            </a>
            <a href="{{ route('owner.settings') }}" class="nav-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="3"></circle>
                    <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path>
                </svg>
                Pengaturan
            </a>
            
            <form action="{{ route('logout') }}" method="POST" id="logout-form-owner-dashboard">
                @csrf
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form-owner-dashboard').submit();" class="logout">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                        <polyline points="16 17 21 12 16 7"></polyline>
                        <line x1="21" y1="12" x2="9" y2="12"></line>
                    </svg>
                    Logout
                </a>
            </form>
        </nav>
    </aside>

    <main class="main-content">
        <header class="header">
            <div>
                <div class="header-title">
                    <h1>Selamat Datang, Owner!</h1>
                    <p>Berikut adalah ringkasan aktivitas restoran Anda hari ini.</p>
                </div>
            </div>
            <div class="header-actions">
                <button class="btn-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                        <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                    </svg>
                </button>

            </div>
        </header>

        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon icon-orange">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                    </div>
                    <div class="stat-trend trend-up">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="22 7 13.5 15.5 8.5 10.5 2 17"></polyline>
                            <polyline points="16 7 22 7 22 13"></polyline>
                        </svg>
                        12%
                    </div>
                </div>
                <div class="stat-title">Total Reservasi</div>
<div class="stat-value">{{ $totalReservasi }}</div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon icon-yellow">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                            <line x1="16" y1="2" x2="16" y2="6"></line>
                            <line x1="8" y1="2" x2="8" y2="6"></line>
                            <line x1="3" y1="10" x2="21" y2="10"></line>
                        </svg>
                    </div>
                    <div class="stat-trend trend-up">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="22 7 13.5 15.5 8.5 10.5 2 17"></polyline>
                            <polyline points="16 7 22 7 22 13"></polyline>
                        </svg>
                        5%
                    </div>
                </div>
               <div class="stat-title">Menunggu Konfirmasi</div>
<div class="stat-value">{{ $reservasiAktif }}</div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon icon-brown">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 6h16"></path><path d="M4 6v12"></path><path d="M20 6v12"></path><path d="M4 10h16"></path>
                        </svg>
                    </div>
                    <div class="stat-trend trend-neutral">
                        Stabil
                    </div>
                </div>
                <div class="stat-title">Meja Tersedia</div>
<div class="stat-value">
    {{ $mejaTersedia }}<span>/{{ $totalMeja }}</span>
</div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon icon-red">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="15" y1="9" x2="9" y2="15"></line>
                            <line x1="9" y1="9" x2="15" y2="15"></line>
                        </svg>
                    </div>
                    <div class="stat-trend trend-down">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="22 17 13.5 8.5 8.5 13.5 2 7"></polyline>
                            <polyline points="16 17 22 17 22 11"></polyline>
                        </svg>
                        2%
                    </div>
                </div>
                <div class="stat-title">Reservasi Tidak Hadir</div>
<div class="stat-value">{{ $reservasiBatal }}</div>
            </div>
        </div>

        <div class="middle-section">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Reservasi Terbaru</h2>
                    <a href="#" class="card-link">Lihat Semua</a>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Nama Pelanggan</th>
                            <th>Waktu</th>
                            <th>Tamu</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                   <tbody>
@forelse($reservations as $reservation)
<tr>
    <td>
        <div class="customer-cell">
            <div class="avatar-initial bg-avatar-1">
                {{ strtoupper(substr($reservation->user->name ?? 'U', 0, 1)) }}
            </div>

            {{ $reservation->user->name ?? 'User' }}
        </div>
    </td>

    <td>
        {{ \Carbon\Carbon::parse($reservation->reservation_time)->format('H:i') }}
    </td>

    <td>
        {{ $reservation->num_guests }} Orang
    </td>

    <td>
        <span class="status-badge status-waiting">
            {{ ucfirst($reservation->status) }}
        </span>
    </td>

    <td>
        <a href="{{ route('owner.reservasi.show', [
    'id' => $reservation->id,
    'from' => 'dashboard'
]) }}">
            Detail
        </a>
    </td>
</tr>
@empty
<tr>
    <td colspan="5" style="text-align: center; padding: 40px 20px; color: var(--text-muted);">
        <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="margin: 0 auto 12px; color: #d1cbc8; display: block;">
            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
            <line x1="16" y1="2" x2="16" y2="6"></line>
            <line x1="8" y1="2" x2="8" y2="6"></line>
            <line x1="3" y1="10" x2="21" y2="10"></line>
        </svg>
        <p style="font-weight: 600; font-size: 14px; margin-bottom: 4px; color: var(--text-main);">Belum ada reservasi terbaru</p>
        <p style="font-size: 13px;">Data reservasi pelanggan akan muncul di sini.</p>
    </td>
</tr>
@endforelse
</tbody>
                </table>
            </div>

            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Status Meja</h2>
                    <button class="btn-icon" style="width: 32px; height: 32px; border:none; background:transparent;">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="1 4 1 10 7 10"></polyline>
                            <polyline points="23 20 23 14 17 14"></polyline>
                            <path d="M20.49 9A9 9 0 0 0 5.64 5.64L1 10m22 4l-4.64 4.36A9 9 0 0 1 3.51 15"></path>
                        </svg>
                    </button>
                </div>
                <div style="padding: 10px 0;">
                    @php
                        $tersedia = $mejaTersedia;
                        $terisi = max(0, $totalMeja - $mejaTersedia);
                        
                        $pctTersedia = $totalMeja > 0 ? round(($tersedia / $totalMeja) * 100) : 0;
                        $pctTerisi = $totalMeja > 0 ? round(($terisi / $totalMeja) * 100) : 0;
                    @endphp
                    <div style="display: flex; justify-content: space-between; margin-bottom: 8px; font-size: 13px; font-weight: 600;">
                        <span style="color: #2e7a51;">Tersedia ({{ $pctTersedia }}%)</span>
                        <span style="color: #9f1239;">Terisi / Dipesan ({{ $pctTerisi }}%)</span>
                    </div>
                    <div style="width: 100%; height: 12px; background: #f2ebe8; border-radius: 6px; display: flex; overflow: hidden; margin-bottom: 20px;">
                        <div style="width: {{ $pctTersedia }}%; background: #85d9a9;" title="{{ $tersedia }} Meja Tersedia"></div>
                        <div style="width: {{ $pctTerisi }}%; background: #fca5a5;" title="{{ $terisi }} Meja Terisi"></div>
                    </div>
                    <p style="font-size: 12px; color: var(--text-muted); text-align: center;">Total {{ $totalMeja }} Meja ({{ $tersedia }} Tersedia, {{ $terisi }} Terisi/Dipesan)</p>
                </div>
            </div>
        </div>

        <div class="card">
            <h2 class="card-title" style="margin-bottom: 30px;">Tren Reservasi Mingguan</h2>
            
            <div style="position: relative; padding-left: 30px;">
                <div style="position: absolute; left: 0; top: 0; bottom: 46px; display: flex; flex-direction: column; justify-content: space-between; font-size: 11px; color: var(--text-muted); text-align: right; width: 20px;">
                    <span>50</span>
                    <span>40</span>
                    <span>30</span>
                    <span>20</span>
                    <span>10</span>
                    <span>0</span>
                </div>
                
                <div style="position: absolute; left: 30px; right: 0; top: 6px; bottom: 46px; display: flex; flex-direction: column; justify-content: space-between; pointer-events: none;">
                    <div style="border-top: 1px dashed #e5e5e5; width: 100%;"></div>
                    <div style="border-top: 1px dashed #e5e5e5; width: 100%;"></div>
                    <div style="border-top: 1px dashed #e5e5e5; width: 100%;"></div>
                    <div style="border-top: 1px dashed #e5e5e5; width: 100%;"></div>
                    <div style="border-top: 1px dashed #e5e5e5; width: 100%;"></div>
                    <div style="border-top: 1px solid var(--border-color); width: 100%;"></div>
                </div>
                
                <div class="chart-container" style="border-bottom: none; margin-bottom: 0; position: relative; z-index: 1;">
                    <div class="bar-wrapper"><div class="bar" style="height: 28%; background-color: #f1dfd5;" title="14 Reservasi"></div></div>
                    <div class="bar-wrapper"><div class="bar" style="height: 42%; background-color: #dfbfae;" title="21 Reservasi"></div></div>
                    <div class="bar-wrapper"><div class="bar" style="height: 35%; background-color: #e5cdbf;" title="17 Reservasi"></div></div>
                    <div class="bar-wrapper"><div class="bar" style="height: 55%; background-color: #c19175;" title="27 Reservasi"></div></div>
                    <div class="bar-wrapper"><div class="bar" style="height: 85%; background-color: #9e3d09;" title="42 Reservasi"></div></div>
                    <div class="bar-wrapper"><div class="bar" style="height: 60%; background-color: #bc774f;" title="30 Reservasi"></div></div>
                    <div class="bar-wrapper"><div class="bar" style="height: 48%; background-color: #ceaa94;" title="24 Reservasi"></div></div>
                </div>
                
                <div class="chart-labels" style="padding-left: 0; margin-top: -16px;">
                    <span>Sen</span>
                    <span>Sel</span>
                    <span>Rab</span>
                    <span>Kam</span>
                    <span>Jum</span>
                    <span>Sab</span>
                    <span>Min</span>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
