<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - RestoBook Admin</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');

        :root {
            --primary-orange: #eb5e28;
            --primary-orange-light: #fff5f0;
            --dark-brown: #a04015;
            --bg-color: #f5f8f7;
            --text-dark: #1e293b;
            --text-gray: #64748b;
            --border-color: #e2e8f0;
            --success-green: #10b981;
            --badge-bg: #fdeee9;
            --badge-text: #b25838;
            --badge-pending-bg: #fce7e7;
            --badge-pending-text: #c53030;
            --table-header-bg: #fdf6f3;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        body {
            background-color: var(--bg-color);
            display: flex;
            min-height: 100vh;
            color: var(--text-dark);
        }

        /* Sidebar */
        .sidebar {
            width: 260px;
            background-color: #ffffff;
            display: flex;
            flex-direction: column;
            border-right: 1px solid var(--border-color);
            padding: 24px 0;
            flex-shrink: 0;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0 24px;
            margin-bottom: 40px;
        }

        .logo-icon {
            width: 28px;
            height: 28px;
            background-color: var(--primary-orange);
            border-radius: 6px;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            font-weight: 700;
        }

        .logo span {
            color: var(--primary-orange);
            font-weight: 700;
            font-size: 18px;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0 24px;
            margin-bottom: 32px;
        }

        .user-profile img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }

        .user-info h4 {
            font-size: 14px;
            font-weight: 700;
            margin-bottom: 2px;
        }

        .user-info p {
            font-size: 12px;
            color: var(--text-gray);
        }

        .nav-menu {
            list-style: none;
            display: flex;
            flex-direction: column;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 14px 24px;
            color: var(--text-gray);
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            border-left: 4px solid transparent;
        }

        .nav-item svg {
            width: 20px;
            height: 20px;
            fill: currentColor;
        }

        .nav-item.active {
            color: var(--primary-orange);
            background-color: var(--primary-orange-light);
            border-left-color: var(--primary-orange);
        }

        .logout {
            margin-top: auto;
            color: #d84824;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            padding: 32px 40px;
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
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 4px;
            color: var(--text-dark);
        }

        .header-title p {
            color: var(--text-gray);
            font-size: 16px;
            font-weight: 500;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .btn-notification {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #f3dfd8;
            border: none;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            position: relative;
        }

        .btn-notification svg {
            width: 20px;
            height: 20px;
            color: var(--dark-brown);
        }

        .btn-notification::after {
            content: '';
            position: absolute;
            top: 10px;
            right: 12px;
            width: 6px;
            height: 6px;
            background-color: #ef4444;
            border-radius: 50%;
        }

        .btn-export {
            background-color: var(--dark-brown);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 24px;
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
            margin-bottom: 32px;
        }

        .stat-card {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 20px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.02);
            min-height: 120px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: -20px;
            right: -20px;
            width: 100px;
            height: 100px;
            background-color: #fff1eb;
            border-radius: 50%;
            z-index: 1;
        }

        .stat-content {
            position: relative;
            z-index: 2;
        }

        .stat-title {
            font-size: 14px;
            color: var(--text-gray);
            font-weight: 500;
            margin-bottom: 4px;
            max-width: 70%;
        }

        .stat-value {
            font-size: 24px;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 12px;
        }

        .stat-trend {
            font-size: 12px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .stat-trend.positive { color: var(--success-green); }
        .stat-trend.neutral { color: var(--text-gray); }

        .stat-icon {
            position: absolute;
            top: 20px;
            right: 20px;
            width: 36px;
            height: 36px;
            background-color: var(--dark-brown);
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            z-index: 2;
        }
        
        .stat-icon.light-brown {
            background-color: #b7876a;
        }

        /* Approval Section */
        .section-card {
            background: #ffffff;
            border-radius: 20px;
            padding: 24px;
            margin-bottom: 32px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.02);
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 24px;
        }

        .section-title-wrap {
            display: flex;
            align-items: flex-start;
            gap: 12px;
        }

        .section-icon {
            color: var(--dark-brown);
            margin-top: 2px;
        }

        .section-title h2 {
            font-size: 16px;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 4px;
        }

        .section-title p {
            font-size: 13px;
            color: var(--text-gray);
        }

        .badge-pending {
            background-color: var(--badge-pending-bg);
            color: var(--badge-pending-text);
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
        }

        .approval-list {
            display: flex;
            flex-direction: column;
        }

        .approval-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px 0;
            border-top: 1px solid var(--border-color);
        }

        .approval-item:first-child {
            border-top: none;
            padding-top: 0;
        }

        .restaurant-info {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .restaurant-img {
            width: 60px;
            height: 60px;
            border-radius: 8px;
            object-fit: cover;
            background-color: #f1e6e2;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #b8988b;
        }

        .restaurant-details h3 {
            font-size: 15px;
            font-weight: 600;
            margin-bottom: 4px;
        }

        .restaurant-location {
            display: flex;
            align-items: center;
            gap: 4px;
            font-size: 13px;
            color: var(--text-gray);
            margin-bottom: 8px;
        }

        .tags {
            display: flex;
            gap: 8px;
        }

        .tag {
            background-color: #f5e9e6;
            color: #8c5b49;
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: 600;
        }

        .action-buttons {
            display: flex;
            gap: 12px;
        }

        .btn-outline {
            background: white;
            border: 1px solid var(--text-dark);
            color: var(--text-dark);
            padding: 8px 24px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 13px;
            cursor: pointer;
        }

        .btn-filled {
            background: var(--dark-brown);
            border: 1px solid var(--dark-brown);
            color: white;
            padding: 8px 24px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 13px;
            cursor: pointer;
        }

        /* Table Section */
        .table-section {
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.02);
            overflow: hidden;
        }

        .table-header {
            padding: 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .table-title {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 16px;
            font-weight: 600;
            color: var(--text-dark);
        }

        .table-controls {
            display: flex;
            gap: 12px;
        }

        .search-box {
            display: flex;
            align-items: center;
            gap: 8px;
            border: 1px solid var(--border-color);
            padding: 8px 16px;
            border-radius: 8px;
            width: 260px;
        }

        .search-box input {
            border: none;
            outline: none;
            width: 100%;
            font-size: 13px;
            color: var(--text-dark);
        }

        .search-box svg {
            color: var(--text-gray);
            width: 16px;
            height: 16px;
        }

        .btn-filter {
            display: flex;
            align-items: center;
            gap: 8px;
            background: white;
            border: 1px solid var(--border-color);
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 500;
            color: var(--text-dark);
            cursor: pointer;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background-color: var(--table-header-bg);
        }

        th {
            text-align: left;
            padding: 16px 24px;
            font-size: 13px;
            font-weight: 600;
            color: var(--text-dark);
        }

        td {
            padding: 16px 24px;
            border-bottom: 1px solid #f1f5f9;
            font-size: 13px;
            vertical-align: middle;
        }

        .rest-cell {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .rest-avatar {
            width: 36px;
            height: 36px;
            background-color: #fca5a5; /* matching visual orange-ish */
            background-image: linear-gradient(to bottom right, #fdbba7, #f79678);
            color: white;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: 700;
            font-size: 16px;
        }

        .rest-info-text h4 {
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 2px;
        }

        .rest-info-text p {
            font-size: 11px;
            color: var(--text-gray);
        }

        .status {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 12px;
            font-weight: 600;
            background-color: #ecfdf5;
            color: var(--success-green);
            padding: 4px 10px;
            border-radius: 12px;
        }

        .status .dot {
            width: 6px;
            height: 6px;
            background-color: var(--success-green);
            border-radius: 50%;
        }

        .action-icon {
            color: var(--dark-brown);
            cursor: pointer;
        }

        .table-footer {
            text-align: center;
            padding: 20px;
            border-top: 1px solid var(--border-color);
        }

        .table-footer a {
            color: var(--dark-brown);
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
        }

    </style>
</head>
<body>

    <aside class="sidebar">
        <div class="logo">
            <div class="logo-icon">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/000000/svg">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 14c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4z" fill="white"/>
                </svg>
            </div>
            <span>RestoBook Admin</span>
        </div>

        <div class="user-profile">
            <img src="https://i.pravatar.cc/150?img=11" alt="Admin Sistem">
            <div class="user-info">
                <h4>Admin Sistem</h4>
            </div>
        </div>

        <nav class="nav-menu">
            <a href="{{ route('admin.dashboard') }}" class="nav-item active">
                <svg viewBox="0 0 24 24"><path d="M4 13h6c.55 0 1-.45 1-1V4c0-.55-.45-1-1-1H4c-.55 0-1 .45-1 1v8c0 .55.45 1 1 1zm0 8h6c.55 0 1-.45 1-1v-4c0-.55-.45-1-1-1H4c-.55 0-1 .45-1 1v4c0 .55.45 1 1 1zm10 0h6c.55 0 1-.45 1-1v-8c0-.55-.45-1-1-1h-6c-.55 0-1 .45-1 1v8c0 .55.45 1 1 1zM13 4v4c0 .55.45 1 1 1h6c.55 0 1-.45 1-1V4c0-.55-.45-1-1-1h-6c-.55 0-1 .45-1 1z"/></svg>
                Dashboard
            </a>
            <a href="{{ route('admin.restaurants') }}" class="nav-item">
                <svg viewBox="0 0 24 24"><path d="M11 9H9V2H7v7H5V2H3v7c0 2.12 1.66 3.84 3.75 3.97V22h2.5v-9.03C11.34 12.84 13 11.12 13 9V2h-2v7zm5-3v8h2.5v8H21V2c-2.76 0-5 2.24-5 4z"/></svg>
                Kelola Restoran
            </a>
            <a href="{{ route('admin.users') }}" class="nav-item">
                <svg viewBox="0 0 24 24"><path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/></svg>
                Kelola User
            </a>
            <a href="#" class="nav-item">
                <svg viewBox="0 0 24 24"><path d="M19.14,12.94c0.04-0.3,0.06-0.61,0.06-0.94c0-0.32-0.02-0.64-0.06-0.94l2.03-1.58c0.18-0.14,0.23-0.41,0.12-0.61 l-1.92-3.32c-0.12-0.22-0.37-0.29-0.59-0.22l-2.39,0.96c-0.5-0.38-1.03-0.7-1.62-0.94L14.4,2.81c-0.04-0.24-0.24-0.41-0.48-0.41 h-3.84c-0.24,0-0.43,0.17-0.47,0.41L9.25,5.35C8.66,5.59,8.12,5.92,7.63,6.29L5.24,5.33c-0.22-0.08-0.47,0-0.59,0.22L2.73,8.87 C2.62,9.08,2.66,9.34,2.86,9.48l2.03,1.58C4.84,11.36,4.8,11.69,4.8,12s0.02,0.64,0.06,0.94l-2.03,1.58 c-0.18,0.14-0.23,0.41-0.12,0.61l1.92,3.32c0.12,0.22,0.37,0.29,0.59,0.22l2.39-0.96c0.5,0.38,1.03,0.7,1.62,0.94l0.36,2.54 c0.05,0.24,0.24,0.41,0.48,0.41h3.84c0.24,0,0.43-0.17,0.47-0.41l0.36-2.54c0.59-0.24,1.13-0.56,1.62-0.94l2.39,0.96 c0.22,0.08,0.47,0,0.59-0.22l1.92-3.32c0.12-0.22,0.07-0.49-0.12-0.61L19.14,12.94z M12,15.6c-1.98,0-3.6-1.62-3.6-3.6 s1.62-3.6,3.6-3.6s3.6,1.62,3.6,3.6S13.98,15.6,12,15.6z"/></svg>
                Pengaturan
            </a>
            
            <form action="{{ route('logout') }}" method="POST" id="logout-form-admin">
                @csrf
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form-admin').submit();" class="nav-item logout">
                    <svg viewBox="0 0 24 24"><path d="M17 7l-1.41 1.41L18.17 11H8v2h10.17l-2.58 2.58L17 17l5-5zM4 5h8V3H4c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h8v-2H4V5z"/></svg>
                    Logout
                </a>
            </form>
        </nav>
    </aside>

    <main class="main-content">
        <header class="header">
            <div class="header-title">
                <h1>Super Admin</h1>
                <p>Sistem Manajemen Platform RestoBook</p>
            </div>
            <div class="header-actions">
                <button class="btn-notification">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
                </button>
                <button class="btn-export">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                    Export Laporan
                </button>
            </div>
        </header>

        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                </div>
                <div class="stat-content">
                    <div class="stat-title">Total Restoran</div>
                    <div class="stat-value">248</div>
                    <div class="stat-trend positive">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline><polyline points="17 6 23 6 23 12"></polyline></svg>
                        +12 pendaftar bulan ini
                    </div>
                </div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon light-brown">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                </div>
                <div class="stat-content">
                    <div class="stat-title">Total User</div>
                    <div class="stat-value">12,450</div>
                    <div class="stat-trend positive">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline><polyline points="17 6 23 6 23 12"></polyline></svg>
                        +840 pengguna baru bulan ini
                    </div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon light-brown">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                </div>
                <div class="stat-content">
                    <div class="stat-title">Reservasi Aktif</div>
                    <div class="stat-value">892</div>
                    <div class="stat-trend neutral">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                        15 masuk hari ini
                    </div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="6" width="20" height="12" rx="2"></rect><circle cx="12" cy="12" r="2"></circle><path d="M6 12h.01M18 12h.01"></path></svg>
                </div>
                <div class="stat-content">
                    <div class="stat-title">Pendapatan Platform</div>
                    <div class="stat-value">Rp 42.5M</div>
                    <div class="stat-trend positive">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline><polyline points="17 6 23 6 23 12"></polyline></svg>
                        +5.2% dibanding bulan lalu
                    </div>
                </div>
            </div>
        </div>

        <section class="section-card">
            <div class="section-header">
                <div class="section-title-wrap">
                    <div class="section-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path><rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect><path d="M9 14h6"></path><path d="M9 10h6"></path><path d="M9 18h6"></path></svg>
                    </div>
                    <div class="section-title">
                        <h2>Restoran Menunggu Approval</h2>
                        <p>Review dan verifikasi pendaftaran mitra baru</p>
                    </div>
                </div>
                <div class="badge-pending">3 Pending</div>
            </div>

            <div class="approval-list">
                <div class="approval-item">
                    <div class="restaurant-info">
                        <img src="https://images.unsplash.com/photo-1555939594-58d7cb561ad1?w=100&h=100&fit=crop" alt="Sate Taichan" class="restaurant-img">
                        <div class="restaurant-details">
                            <h3>Sate Taichan Bang Ocit</h3>
                            <div class="restaurant-location">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                                Tanjung Karang Pusat
                            </div>
                            <div class="tags">
                                <span class="tag">UMKM Mikro</span>
                                <span class="tag">Halal</span>
                            </div>
                        </div>
                    </div>
                    <div class="action-buttons">
                        <button class="btn-outline">Tolak</button>
                        <button class="btn-filled">Setujui</button>
                    </div>
                </div>

                <div class="approval-item">
                    <div class="restaurant-info">
                        <div class="restaurant-img">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
                        </div>
                        <div class="restaurant-details">
                            <h3>Kopi Kenangan</h3>
                            <div class="restaurant-location">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                                Kedaton
                            </div>
                            <div class="tags">
                                <span class="tag">Cafe</span>
                            </div>
                        </div>
                    </div>
                    <div class="action-buttons">
                        <button class="btn-outline">Tolak</button>
                        <button class="btn-filled">Setujui</button>
                    </div>
                </div>
            </div>
        </section>

        <section class="table-section">
            <div class="table-header">
                <div class="table-title">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><ellipse cx="12" cy="5" rx="9" ry="3"></ellipse><path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"></path><path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"></path></svg>
                    Semua Restoran
                </div>
                <div class="table-controls">
                    <div class="search-box">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                        <input type="text" placeholder="Cari nama restoran...">
                    </div>
                    <button class="btn-filter">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"></polygon></svg>
                        Filter
                    </button>
                </div>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Nama Restoran</th>
                        <th>Lokasi</th>
                        <th>Status</th>
                        <th>Reservasi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="rest-cell">
                                <div class="rest-avatar">W</div>
                                <div class="rest-info-text" style="display: flex; align-items: center; gap: 8px;">
                                    <h4 style="margin-bottom: 0;">Waroeng Steak & Shake</h4>
                                    <span style="font-size: 10px; color: var(--text-gray); background: #f1f5f9; padding: 2px 6px; border-radius: 4px; font-weight: 600;">ID: RST-001</span>
                                </div>
                            </div>
                        </td>
                        <td>Way Halim</td>
                        <td>
                            <div class="status">
                                <div class="dot"></div> Aktif
                            </div>
                        </td>
                        <td>145</td>
                        <td>
                            <svg class="action-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="rest-cell">
                                <div class="rest-avatar">W</div>
                                <div class="rest-info-text" style="display: flex; align-items: center; gap: 8px;">
                                    <h4 style="margin-bottom: 0;">Waroeng Djontor Kedaton</h4>
                                    <span style="font-size: 10px; color: var(--text-gray); background: #f1f5f9; padding: 2px 6px; border-radius: 4px; font-weight: 600;">ID: RST-002</span>
                                </div>
                            </div>
                        </td>
                        <td>Kedaton</td>
                        <td>
                            <div class="status">
                                <div class="dot"></div> Aktif
                            </div>
                        </td>
                        <td>60</td>
                        <td>
                            <svg class="action-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="table-footer">
                <a href="#">Lihat Semua Data</a>
            </div>
        </section>
    </main>

</body>
</html>