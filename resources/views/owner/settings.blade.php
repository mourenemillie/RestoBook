<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan - RestoBook</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #E95A1E;
            --primary-light: #FDF1EB;
            --bg-body: #FCF8F6;
            --bg-card: #FFFFFF;
            --text-dark: #202020;
            --text-muted: #7E7E7E;
            --border: #F0F0F0;
            --border-input: #E4E4E4;
            --sidebar-w: 260px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        body {
            background-color: var(--bg-body);
            color: var(--text-dark);
            display: flex;
            min-height: 100vh;
        }

        /* --- SIDEBAR --- */
        .sidebar {
            width: var(--sidebar-w);
            background: var(--bg-card);
            border-right: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            padding: 30px 0;
            position: fixed;
            height: 100vh;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 20px;
            font-weight: 800;
            color: var(--primary);
            padding: 0 30px;
            margin-bottom: 40px;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0 30px;
            margin-bottom: 40px;
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
            color: var(--text-muted);
        }

        .nav-menu {
            display: flex;
            flex-direction: column;
            gap: 5px;
            flex-grow: 1;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 30px;
            text-decoration: none;
            color: var(--text-muted);
            font-weight: 600;
            font-size: 14px;
            border-left: 4px solid transparent;
        }

        .nav-item svg {
            width: 18px;
            height: 18px;
            stroke: currentColor;
            fill: none;
            stroke-width: 2;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .nav-item.active {
            background-color: var(--primary-light);
            color: var(--primary);
            border-left-color: var(--primary);
        }

        .logout-btn {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 30px;
            text-decoration: none;
            color: #D32F2F;
            font-weight: 600;
            font-size: 14px;
            margin-top: auto;
        }

        .logout-btn svg {
            width: 18px;
            height: 18px;
            stroke: currentColor;
            fill: none;
            stroke-width: 2;
        }

        /* --- MAIN CONTENT --- */
        .main-content {
            margin-left: var(--sidebar-w);
            flex-grow: 1;
            padding: 40px 50px;
            max-width: 1200px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 30px;
        }

        .header-title h1 {
            font-size: 28px;
            font-weight: 800;
            margin-bottom: 6px;
        }

        .header-title p {
            font-size: 14px;
            color: var(--text-muted);
        }

        .header-actions {
            display: flex;
            gap: 16px;
            align-items: center;
        }

        .btn-icon {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: var(--bg-card);
            border: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: var(--text-dark);
        }

        .btn-icon svg { width: 20px; height: 20px; stroke: currentColor; fill: none; stroke-width: 2; }

        .btn-primary {
            background: var(--primary);
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
        }

        .btn-primary svg { width: 16px; height: 16px; stroke: white; fill: none; stroke-width: 2; }

        .btn-outline {
            background: transparent;
            color: var(--primary);
            border: 1px solid var(--primary);
            width: 100%;
            padding: 14px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            cursor: pointer;
            margin-top: 15px;
        }

        .btn-outline svg { width: 16px; height: 16px; stroke: currentColor; fill: none; stroke-width: 2; }

        /* --- LAYOUT GRID --- */
        .content-grid {
            display: grid;
            grid-template-columns: 1.2fr 0.8fr;
            gap: 30px;
        }

        .card {
            background: var(--bg-card);
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.02);
        }

        .card-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 24px;
        }

        .icon-box {
            width: 36px;
            height: 36px;
            background: var(--primary-light);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
        }

        .icon-box svg { width: 18px; height: 18px; stroke: currentColor; fill: none; stroke-width: 2; }

        .card-header h2 {
            font-size: 18px;
            font-weight: 700;
        }

        /* --- FORMS --- */
        .form-group {
            margin-bottom: 20px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .form-label {
            display: block;
            font-size: 11px;
            font-weight: 700;
            color: var(--text-muted);
            margin-bottom: 8px;
            letter-spacing: 0.5px;
        }

        .form-control {
            width: 100%;
            padding: 14px 16px;
            border: 1px solid var(--border-input);
            border-radius: 12px;
            font-size: 14px;
            color: var(--text-dark);
            outline: none;
            transition: border-color 0.2s;
        }

        .form-control:focus {
            border-color: var(--primary);
        }

        textarea.form-control {
            resize: none;
            height: 90px;
        }

        /* --- INFO BANNER --- */
        .info-banner {
            background: var(--primary-light);
            border-radius: 12px;
            padding: 16px 20px;
            display: flex;
            align-items: flex-start;
            gap: 12px;
            margin-top: 10px;
        }

        .info-banner svg {
            width: 20px;
            height: 20px;
            fill: var(--primary);
            flex-shrink: 0;
        }

        .info-banner p {
            font-size: 13px;
            color: var(--text-dark);
            line-height: 1.5;
        }

        /* --- LIST ITEMS & TOGGLES --- */
        .list-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-bottom: 20px;
            margin-bottom: 20px;
            border-bottom: 1px solid var(--border);
        }

        .list-item:last-child {
            padding-bottom: 0;
            margin-bottom: 0;
            border-bottom: none;
        }

        .item-text h3 {
            font-size: 14px;
            font-weight: 700;
            margin-bottom: 4px;
        }

        .item-text p {
            font-size: 12px;
            color: var(--text-muted);
        }

        /* Toggle Switch */
        .toggle {
            position: relative;
            width: 44px;
            height: 24px;
        }

        .toggle input { display: none; }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0; left: 0; right: 0; bottom: 0;
            background-color: #E0E0E0;
            transition: .3s;
            border-radius: 24px;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 18px;
            width: 18px;
            left: 3px;
            bottom: 3px;
            background-color: white;
            transition: .3s;
            border-radius: 50%;
        }

        input:checked + .slider {
            background-color: var(--primary);
        }

        input:checked + .slider:before {
            transform: translateX(20px);
        }
    </style>
</head>
<body>

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <div class="logo">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 2v7c0 1.1.9 2 2 2h4a2 2 0 0 0 2-2V2"></path><path d="M7 2v20"></path><path d="M21 15V2v0a5 5 0 0 0-5 5v6c0 1.1.9 2 2 2h3Zm0 0v7"></path></svg>
            RestoBook
        </div>

        <div class="user-profile">
            <img src="https://i.pravatar.cc/150?img=11" alt="User Avatar">
            <div class="user-info">
                <h4>Resto Owner</h4>
                <p>Manage your resto</p>
            </div>
        </div>

        <nav class="nav-menu">
            <a href="{{ route('owner.dashboard') }}" class="nav-item">
                <svg viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
                Dashboard
            </a>
            <a href="{{ route('owner.reservasi') }}" class="nav-item">
                <svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                Reservasi
            </a>
            <a href="{{ route('owner.kelola-meja') }}" class="nav-item">
                <svg viewBox="0 0 24 24"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"></path></svg>
                Kelola Menu dan Meja
            </a>
            <a href="{{ route('owner.settings') }}" class="nav-item active">
                <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
                Pengaturan
            </a>
        </nav>

        <form action="{{ route('logout') }}" method="POST" id="logout-form-owner-settings">
            @csrf
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form-owner-settings').submit();" class="logout-btn">
                <svg viewBox="0 0 24 24"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                Logout
            </a>
        </form>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="main-content">
        <header class="header">
            <div class="header-title">
                <h1>Pengaturan</h1>
                <p>Kelola profil, operasional, dan keamanan restoran Anda</p>
            </div>
            <div class="header-actions">
                <button class="btn-icon">
                    <svg viewBox="0 0 24 24"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
                </button>
            </div>
        </header>

        <div class="content-grid">
            <!-- Kolom Kiri -->
            <div class="col-left">
                <!-- Card Profil Restoran -->
                <div class="card">
                    <div class="card-header">
                        <div class="icon-box">
                            <svg viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                        </div>
                        <h2>Profil Restoran</h2>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">NAMA RESTORAN</label>
                        <input type="text" class="form-control" value="Waroeng Djontor Bandar Lampung">
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">NOMOR TELEPON</label>
                        <input type="text" class="form-control" value="+62 21 555 0123">
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">ALAMAT</label>
                        <textarea class="form-control">Jl. ZA. Pagar Alam, Gedong Meneng, Kec. Rajabasa, Kota Bandar Lampung, Lampung 35148</textarea>
                    </div>
                </div>

                <!-- Card Jam Operasional -->
                <div class="card">
                    <div class="card-header">
                        <div class="icon-box">
                            <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                        </div>
                        <h2>Jam Operasional</h2>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">JAM BUKA</label>
                            <input type="text" class="form-control" value="10:00 AM">
                        </div>
                        <div class="form-group">
                            <label class="form-label">JAM TUTUP</label>
                            <input type="text" class="form-control" value="10:00 PM">
                        </div>
                    </div>

                    <div class="info-banner">
                        <svg viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"></path></svg>
                        <p>Pengaturan jam operasional akan mempengaruhi ketersediaan slot reservasi di halaman publik pelanggan.</p>
                    </div>
                </div>
            </div>

            <!-- Kolom Kanan -->
            <div class="col-right">
                <!-- Card Notifikasi -->
                <div class="card">
                    <div class="card-header">
                        <div class="icon-box">
                            <svg viewBox="0 0 24 24"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
                        </div>
                        <h2>Notifikasi</h2>
                    </div>

                    <div class="list-item">
                        <div class="item-text">
                            <h3>Reservasi Baru</h3>
                            <p>Dapatkan notifikasi instan saat reservasi masuk.</p>
                        </div>
                        <label class="toggle">
                            <input type="checkbox" checked>
                            <span class="slider"></span>
                        </label>
                    </div>

                    <div class="list-item">
                        <div class="item-text">
                            <h3>Pengingat Reservasi</h3>
                            <p>Notifikasi 30 menit sebelum jadwal reservasi.</p>
                        </div>
                        <label class="toggle">
                            <input type="checkbox" checked>
                            <span class="slider"></span>
                        </label>
                    </div>

                    <div class="list-item">
                        <div class="item-text">
                            <h3>Laporan Harian</h3>
                            <p>Ringkasan reservasi harian setiap pagi.</p>
                        </div>
                        <label class="toggle">
                            <input type="checkbox">
                            <span class="slider"></span>
                        </label>
                    </div>
                </div>

                <!-- Card Keamanan -->
                <div class="card">
                    <div class="card-header">
                        <div class="icon-box">
                            <svg viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
                        </div>
                        <h2>Keamanan</h2>
                    </div>

                    <div class="list-item" style="border:none; padding-bottom: 0;">
                        <div class="item-text">
                            <h3>Autentikasi Dua Faktor</h3>
                            <p>Lapisan keamanan ekstra untuk akun Anda.</p>
                        </div>
                        <label class="toggle">
                            <input type="checkbox">
                            <span class="slider"></span>
                        </label>
                    </div>

                    <button class="btn-primary" style="width: 100%; justify-content: center; margin-top: 15px; color: white;">
                        <svg viewBox="0 0 24 24" stroke="currentColor"><path d="M21 2v6h-6"></path><path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"></path><path d="M3 2v6h6"></path></svg>
                        Ganti Password
                    </button>
                </div>
            </div>
        </div>

        <div style="display: flex; justify-content: flex-end; margin-top: 20px;">
            <button class="btn-primary" style="padding: 16px 32px; font-size: 16px;">
                <svg viewBox="0 0 24 24" style="width: 20px; height: 20px;"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg>
                Simpan Perubahan
            </button>
        </div>
    </main>

</body>
</html>