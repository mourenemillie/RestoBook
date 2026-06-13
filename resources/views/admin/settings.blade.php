<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan - RestoBook Admin</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap');
        :root {
            --primary-orange: #e25c23;
            --primary-orange-light: #fff6f3;
            --dark-brown: #a63b0a;
            --bg-color: #fffaf8;
            --text-dark: #271f1d;
            --text-gray: #807773;
            --border-color: #f2ebe8;
            --success-green: #219653;
            --badge-bg: #fdeee9;
            --badge-text: #b25838;
            --badge-pending-bg: #feeceb;
            --badge-pending-text: #eb5757;
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

        .tabs {
            display: flex;
            gap: 16px;
            margin-bottom: 24px;
            border-bottom: 1px solid var(--border-color);
        }

        .tab-btn {
            padding: 12px 24px;
            background: none;
            border: none;
            font-size: 14px;
            font-weight: 600;
            color: var(--text-gray);
            cursor: pointer;
            border-bottom: 3px solid transparent;
            transition: all 0.2s;
        }

        .tab-btn:hover {
            color: var(--primary-orange);
        }

        .tab-btn.active {
            color: var(--primary-orange);
            border-bottom-color: var(--primary-orange);
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
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
            .content-grid { grid-template-columns: 1fr !important; }
        }
        @media (max-width: 576px) {
            .stats-grid { grid-template-columns: 1fr; }
            .table-responsive { overflow-x: auto; display: block; width: 100%; }
            th, td { white-space: nowrap; }
            .form-row { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

    <aside class="sidebar">
        <a href="{{ route('admin.dashboard') }}" class="logo" style="text-decoration: none;">
            <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1; font-size: 28px; color: var(--primary-orange);">restaurant</span>
            <span style="font-weight: 800; font-size: 20px; color: #a63b0a; letter-spacing: -0.5px;">Resto<span style="color: var(--primary-orange);">Book</span> <span style="font-weight: 600; color: #271f1d; font-size: 16px; margin-left: 4px;">Admin</span></span>
        </a>

        <div class="user-profile">
            <div style="width: 40px; height: 40px; border-radius: 50%; background: var(--border-color); display: flex; align-items: center; justify-content: center; color: var(--text-gray);">
                <svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
            </div>
            <div class="user-info">
                <h4>Admin Sistem</h4>
            </div>
        </div>

        <nav class="nav-menu">
            <a href="{{ route('admin.dashboard') }}" class="nav-item">
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
            <a href="{{ route('admin.settings') }}" class="nav-item active">
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
                <h1>Pengaturan Sistem</h1>
                <p>Kelola konfigurasi dan pengaturan dasar platform RestoBook</p>
            </div>
        </header>

        @if(session('success'))
            <div style="background: #ecfdf5; color: var(--success-green); padding: 16px; border-radius: 12px; margin-bottom: 24px; font-weight: 500; display: flex; align-items: center; gap: 8px;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"></polyline></svg>
                {{ session('success') }}
            </div>
        @endif
        
        @if($errors->any())
            <div style="background: #feeceb; color: #eb5757; padding: 16px; border-radius: 12px; margin-bottom: 24px; font-weight: 500;">
                <ul style="margin-left: 20px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="tabs">
            <button class="tab-btn active" onclick="openTab(event, 'profil')">Profil & Keamanan</button>
            <button class="tab-btn" onclick="openTab(event, 'global')">Pengaturan Global</button>
        </div>

        <form action="{{ route('admin.settings.update') }}" method="POST">
            @csrf
            
            <!-- TAB PROFIL -->
            <section id="profil" class="tab-content active section-card">
                <div class="section-header">
                    <div class="section-title-wrap">
                        <div class="section-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                        </div>
                        <div class="section-title">
                            <h2>Profil & Keamanan Akun</h2>
                            <p>Atur nama, email, dan kata sandi untuk akun Super Admin</p>
                        </div>
                    </div>
                </div>
                
                <div style="padding: 10px 0;">
                    <div style="margin-bottom: 24px;">
                        <label style="display: block; font-weight: 600; margin-bottom: 8px; color: var(--text-dark);">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" style="width: 100%; max-width: 500px; padding: 14px 16px; border: 1px solid var(--border-color); border-radius: 12px; font-size: 15px; outline: none; background: #fafafa; color: var(--text-dark); transition: all 0.2s;" onfocus="this.style.borderColor='var(--primary-orange)'; this.style.background='#fff';" onblur="this.style.borderColor='var(--border-color)'; this.style.background='#fafafa';">
                    </div>
                    
                    <div style="margin-bottom: 24px;">
                        <label style="display: block; font-weight: 600; margin-bottom: 8px; color: var(--text-dark);">Alamat Email</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" style="width: 100%; max-width: 500px; padding: 14px 16px; border: 1px solid var(--border-color); border-radius: 12px; font-size: 15px; outline: none; background: #fafafa; color: var(--text-dark); transition: all 0.2s;" onfocus="this.style.borderColor='var(--primary-orange)'; this.style.background='#fff';" onblur="this.style.borderColor='var(--border-color)'; this.style.background='#fafafa';">
                    </div>

                    <hr style="border: 0; border-top: 1px solid var(--border-color); margin: 32px 0;">
                    
                    <div style="margin-bottom: 24px;">
                        <label style="display: block; font-weight: 600; margin-bottom: 8px; color: var(--text-dark);">Password Baru (Opsional)</label>
                        <input type="password" name="password" placeholder="Kosongkan jika tidak ingin mengubah password" style="width: 100%; max-width: 500px; padding: 14px 16px; border: 1px solid var(--border-color); border-radius: 12px; font-size: 15px; outline: none; background: #fafafa; color: var(--text-dark); transition: all 0.2s;" onfocus="this.style.borderColor='var(--primary-orange)'; this.style.background='#fff';" onblur="this.style.borderColor='var(--border-color)'; this.style.background='#fafafa';">
                    </div>
                    
                    <div style="margin-bottom: 24px;">
                        <label style="display: block; font-weight: 600; margin-bottom: 8px; color: var(--text-dark);">Konfirmasi Password Baru</label>
                        <input type="password" name="password_confirmation" placeholder="Ulangi password baru di sini" style="width: 100%; max-width: 500px; padding: 14px 16px; border: 1px solid var(--border-color); border-radius: 12px; font-size: 15px; outline: none; background: #fafafa; color: var(--text-dark); transition: all 0.2s;" onfocus="this.style.borderColor='var(--primary-orange)'; this.style.background='#fff';" onblur="this.style.borderColor='var(--border-color)'; this.style.background='#fafafa';">
                    </div>
                </div>
            </section>

            <!-- TAB GLOBAL -->
            <section id="global" class="tab-content section-card">
                <div class="section-header">
                    <div class="section-title-wrap">
                        <div class="section-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>
                        </div>
                        <div class="section-title">
                            <h2>Pengaturan Global</h2>
                            <p>Atur identitas platform RestoBook yang dilihat pengunjung</p>
                        </div>
                    </div>
                </div>
                
                <div style="padding: 10px 0;">
                    <div style="margin-bottom: 24px;">
                        <label style="display: block; font-weight: 600; margin-bottom: 8px; color: var(--text-dark);">Nama Aplikasi / Platform</label>
                        <input type="text" name="app_name" value="{{ old('app_name', $settings['app_name'] ?? 'RestoBook') }}" style="width: 100%; max-width: 500px; padding: 14px 16px; border: 1px solid var(--border-color); border-radius: 12px; font-size: 15px; outline: none; background: #fafafa; color: var(--text-dark);">
                    </div>
                    
                    <div style="margin-bottom: 24px;">
                        <label style="display: block; font-weight: 600; margin-bottom: 8px; color: var(--text-dark);">Email Customer Service</label>
                        <input type="email" name="contact_email" value="{{ old('contact_email', $settings['contact_email'] ?? 'support@restobook.com') }}" style="width: 100%; max-width: 500px; padding: 14px 16px; border: 1px solid var(--border-color); border-radius: 12px; font-size: 15px; outline: none; background: #fafafa; color: var(--text-dark);">
                    </div>

                    <div style="margin-bottom: 24px;">
                        <label style="display: block; font-weight: 600; margin-bottom: 8px; color: var(--text-dark);">Nomor WhatsApp CS</label>
                        <input type="text" name="contact_phone" value="{{ old('contact_phone', $settings['contact_phone'] ?? '081234567890') }}" style="width: 100%; max-width: 500px; padding: 14px 16px; border: 1px solid var(--border-color); border-radius: 12px; font-size: 15px; outline: none; background: #fafafa; color: var(--text-dark);">
                    </div>

                    <div style="display: flex; gap: 20px; max-width: 500px;">
                        <div style="flex: 1; margin-bottom: 24px;">
                            <label style="display: block; font-weight: 600; margin-bottom: 8px; color: var(--text-dark);">Mata Uang Default</label>
                            <input type="text" name="currency" value="{{ old('currency', $settings['currency'] ?? 'IDR') }}" style="width: 100%; padding: 14px 16px; border: 1px solid var(--border-color); border-radius: 12px; font-size: 15px; outline: none; background: #fafafa; color: var(--text-dark);">
                        </div>
                        <div style="flex: 1; margin-bottom: 24px;">
                            <label style="display: block; font-weight: 600; margin-bottom: 8px; color: var(--text-dark);">Zona Waktu</label>
                            <input type="text" name="timezone" value="{{ old('timezone', $settings['timezone'] ?? 'Asia/Jakarta') }}" style="width: 100%; padding: 14px 16px; border: 1px solid var(--border-color); border-radius: 12px; font-size: 15px; outline: none; background: #fafafa; color: var(--text-dark);">
                        </div>
                    </div>
                </div>
            </section>

            
            <div style="margin-top: 24px; margin-bottom: 40px; text-align: right;">
                <button type="submit" style="background: var(--dark-brown); color: white; padding: 14px 28px; border: none; border-radius: 12px; font-weight: 600; font-size: 15px; cursor: pointer; display: inline-flex; align-items: center; gap: 8px; transition: all 0.2s; box-shadow: 0 4px 12px rgba(166, 59, 10, 0.2);" onmouseover="this.style.transform='translateY(-2px)';" onmouseout="this.style.transform='translateY(0)';">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg>
                    Simpan Semua Perubahan
                </button>
            </div>
        </form>
    </main>

    <script>
        function openTab(evt, tabName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tab-content");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].classList.remove("active");
            }
            tablinks = document.getElementsByClassName("tab-btn");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].classList.remove("active");
            }
            document.getElementById(tabName).classList.add("active");
            evt.currentTarget.classList.add("active");
        }
    </script>

</body>
</html>