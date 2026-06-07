<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan – RestoBook</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

        :root {
            --primary-brand: #ed5f1f;
            --primary-dark:  #a03605;
            --bg-color:      #ffffff;
            --sidebar-bg:    #ffffff;
            --text-dark:     #1e1512;
            --text-gray:     #786f6c;
            --border-light:  #f3f0ef;

            --nav-active-bg:     #fff6f3;
            --nav-active-border: #ed5f1f;

            --danger-color: #d1302b;

            /* Settings-specific */
            --bg-body:       #fafafa;
            --border-input:  #e8e3e0;
            --primary-light: #fff2eb;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }

        body {
            background-color: var(--bg-body);
            display: flex;
            min-height: 100vh;
            color: var(--text-dark);
        }

        /* ===== SIDEBAR — identik dengan reservasi.blade.php ===== */
        .sidebar {
            width: 260px;
            background-color: var(--sidebar-bg);
            display: flex;
            flex-direction: column;
            border-right: 1px solid var(--border-light);
            padding: 32px 0;
            flex-shrink: 0;
            position: sticky;
            top: 0;
            height: 100vh;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 0 28px;
            margin-bottom: 40px;
            color: var(--primary-brand);
            font-size: 20px;
            font-weight: 800;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0 28px;
            margin-bottom: 40px;
        }

        .user-profile img {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            object-fit: cover;
        }

        .user-info h4 { font-size: 14px; font-weight: 700; margin-bottom: 2px; }
        .user-info p  { font-size: 11px; color: var(--text-gray); }

        .nav-menu {
            list-style: none;
            display: flex;
            flex-direction: column;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 16px 28px;
            color: var(--text-gray);
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            border-left: 4px solid transparent;
        }

        .nav-item svg { width: 20px; height: 20px; stroke-width: 2.5; flex-shrink: 0; }

        .nav-item.active {
            color: var(--primary-brand);
            background-color: var(--nav-active-bg);
            border-left-color: var(--nav-active-border);
        }

        .logout {
            margin-top: auto;
            color: var(--danger-color);
            padding: 16px 28px;
            display: flex;
            align-items: center;
            gap: 16px;
            font-weight: 600;
            font-size: 14px;
            text-decoration: none;
        }

        /* ===== MAIN CONTENT ===== */
        .main-content {
            flex: 1;
            padding: 48px 64px;
            overflow-y: auto;
            background-color: var(--bg-body);
        }

        /* Header */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-bottom: 48px;
        }

        .header-title h1 {
            font-size: 40px;
            font-weight: 800;
            letter-spacing: -0.5px;
            margin-bottom: 8px;
            color: #1a110e;
        }

        .header-title p {
            color: var(--text-gray);
            font-size: 16px;
            font-weight: 500;
        }

        .btn-icon {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: #fff;
            border: 1px solid var(--border-light);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: var(--text-dark);
        }

        .btn-icon svg { width: 20px; height: 20px; stroke: currentColor; fill: none; stroke-width: 2; }

        /* ===== CONTENT GRID ===== */
        .content-grid {
            display: grid;
            grid-template-columns: 1.2fr 0.8fr;
            gap: 28px;
        }

        /* ===== CARDS ===== */
        .card {
            background: #ffffff;
            border-radius: 24px;
            padding: 32px;
            margin-bottom: 28px;
            border: 1px solid var(--border-light);
            box-shadow: 0 4px 16px rgba(0,0,0,0.03);
        }

        .card:last-child { margin-bottom: 0; }

        .card-header {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 28px;
        }

        .icon-box {
            width: 40px;
            height: 40px;
            background: var(--primary-light);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-brand);
            flex-shrink: 0;
        }

        .icon-box svg { width: 20px; height: 20px; stroke: currentColor; fill: none; stroke-width: 2; }

        .card-header h2 { font-size: 20px; font-weight: 800; color: #1a110e; }

        /* ===== FORMS ===== */
        .form-group { margin-bottom: 20px; }
        .form-group:last-child { margin-bottom: 0; }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .form-label {
            display: block;
            font-size: 11px;
            font-weight: 700;
            color: var(--text-gray);
            margin-bottom: 8px;
            letter-spacing: 0.6px;
            text-transform: uppercase;
        }

        .form-control {
            width: 100%;
            padding: 14px 16px;
            border: 1.5px solid var(--border-input);
            border-radius: 14px;
            font-size: 14px;
            font-weight: 500;
            color: var(--text-dark);
            outline: none;
            transition: border-color 0.2s;
            background: #fff;
        }

        .form-control:focus { border-color: var(--primary-brand); }

        textarea.form-control { resize: none; height: 90px; }

        /* Info banner */
        .info-banner {
            background: var(--primary-light);
            border-radius: 14px;
            padding: 16px 20px;
            display: flex;
            align-items: flex-start;
            gap: 12px;
            margin-top: 16px;
        }

        .info-banner svg { width: 20px; height: 20px; fill: var(--primary-brand); flex-shrink: 0; }
        .info-banner p   { font-size: 13px; color: var(--text-dark); line-height: 1.6; font-weight: 500; }

        /* ===== LIST ITEMS & TOGGLES ===== */
        .list-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-bottom: 20px;
            margin-bottom: 20px;
            border-bottom: 1px solid var(--border-light);
        }

        .list-item:last-child { padding-bottom: 0; margin-bottom: 0; border-bottom: none; }

        .item-text h3 { font-size: 14px; font-weight: 700; margin-bottom: 4px; }
        .item-text p  { font-size: 12px; color: var(--text-gray); }

        .toggle { position: relative; width: 46px; height: 26px; flex-shrink: 0; }
        .toggle input { display: none; }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0; left: 0; right: 0; bottom: 0;
            background-color: #d9d3d0;
            transition: .3s;
            border-radius: 26px;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 20px;
            width: 20px;
            left: 3px;
            bottom: 3px;
            background-color: white;
            transition: .3s;
            border-radius: 50%;
            box-shadow: 0 2px 4px rgba(0,0,0,0.15);
        }

        input:checked + .slider { background-color: var(--primary-brand); }
        input:checked + .slider:before { transform: translateX(20px); }

        /* ===== BUTTONS ===== */
        .btn-save {
            width: 100%;
            padding: 16px;
            border: none;
            border-radius: 30px;
            background: var(--primary-dark);
            color: white;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            transition: background 0.2s;
            margin-top: 8px;
        }

        .btn-save:hover { background: #8a2e04; }

        .btn-secondary {
            width: 100%;
            padding: 14px;
            border: 2px solid var(--primary-dark);
            border-radius: 30px;
            background: transparent;
            color: var(--primary-dark);
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all 0.2s;
            margin-top: 16px;
        }

        .btn-secondary:hover { background: var(--primary-light); }
        .btn-secondary svg { width: 16px; height: 16px; stroke: currentColor; fill: none; stroke-width: 2.5; }

        /* Flash alert */
        .flash-alert {
            position: fixed;
            top: 24px;
            right: 24px;
            background: var(--primary-dark);
            color: white;
            padding: 14px 22px;
            border-radius: 14px;
            font-weight: 600;
            font-size: 14px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            z-index: 9999;
        }
    </style>
</head>
<body>

@if(session('success'))
    <div class="flash-alert">{{ session('success') }}</div>
@endif

<!-- ===== SIDEBAR ===== -->
<aside class="sidebar">
    <div class="logo">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M3 2v7c0 1.1.9 2 2 2h4a2 2 0 0 0 2-2V2"></path>
            <path d="M7 2v20"></path>
            <path d="M21 15V2v0a5 5 0 0 0-5 5v6c0 1.1.9 2 2 2h3zm0 0v7"></path>
        </svg>
        RestoBook
    </div>

    <div class="user-profile">
        <img src="https://i.pravatar.cc/150?img=11" alt="Resto Owner">
        <div class="user-info">
            <h4>Resto Owner</h4>
            <p>Manage your resto</p>
        </div>
    </div>

    <nav class="nav-menu">
        <a href="{{ route('owner.dashboard') }}" class="nav-item">
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
        <a href="{{ route('owner.settings') }}" class="nav-item active">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="3"></circle>
                <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path>
            </svg>
            Pengaturan
        </a>

        <form action="{{ route('logout') }}" method="POST" id="logout-form-settings">
            @csrf
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form-settings').submit();" class="logout">
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

<!-- ===== MAIN CONTENT ===== -->
<main class="main-content">

    <div class="header">
        <div class="header-title">
            <h1>Pengaturan</h1>
            <p>Kelola profil, operasional, dan keamanan restoran Anda</p>
        </div>
        <button class="btn-icon">
            <svg viewBox="0 0 24 24">
                <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
            </svg>
        </button>
    </div>

    <div class="content-grid">

        <!-- ===== KOLOM KIRI ===== -->
        <div>
            <form action="{{ route('owner.settings.update') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Profil Restoran -->
                <div class="card">
                    <div class="card-header">
                        <div class="icon-box">
                            <svg viewBox="0 0 24 24">
                                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                <polyline points="9 22 9 12 15 12 15 22"></polyline>
                            </svg>
                        </div>
                        <h2>Profil Restoran</h2>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Foto Restoran</label>
                        @if($restaurant && $restaurant->image)
                            <div style="margin-bottom: 10px;">
                                <img src="{{ filter_var($restaurant->image, FILTER_VALIDATE_URL) ? $restaurant->image : Storage::url($restaurant->image) }}" alt="Foto Restoran" style="width: 100%; height: 200px; object-fit: cover; border-radius: 14px;">
                            </div>
                        @endif
                        <input type="file" class="form-control" name="image" accept="image/*">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Nama Restoran</label>
                        <input type="text" class="form-control" name="name"
                               value="{{ $restaurant->name ?? '' }}">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Nomor Telepon</label>
                        <input type="text" class="form-control" name="phone"
                               value="{{ $restaurant->phone ?? '' }}">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Alamat</label>
                        <textarea class="form-control" name="address">{{ $restaurant->address ?? '' }}</textarea>
                    </div>
                </div>

                <!-- Jam Operasional -->
                <div class="card">
                    <div class="card-header">
                        <div class="icon-box">
                            <svg viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="10"></circle>
                                <polyline points="12 6 12 12 16 14"></polyline>
                            </svg>
                        </div>
                        <h2>Jam Operasional</h2>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Jam Buka</label>
                            <input type="time" class="form-control" name="open_time"
                                   value="{{ $restaurant->open_time ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Jam Tutup</label>
                            <input type="time" class="form-control" name="close_time"
                                   value="{{ $restaurant->close_time ?? '' }}">
                        </div>
                    </div>

                    <div class="info-banner">
                        <svg viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"></path>
                        </svg>
                        <p>Pengaturan jam operasional akan mempengaruhi ketersediaan slot reservasi di halaman publik pelanggan.</p>
                    </div>
                </div>

                <button type="submit" class="btn-save">Simpan Perubahan</button>

            </form>
        </div>

        <!-- ===== KOLOM KANAN ===== -->
        <div>

            <!-- Notifikasi -->
            <div class="card">
                <div class="card-header">
                    <div class="icon-box">
                        <svg viewBox="0 0 24 24">
                            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                            <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                        </svg>
                    </div>
                    <h2>Notifikasi</h2>
                </div>

                <div class="list-item">
                    <div class="item-text">
                        <h3>Reservasi Baru</h3>
                        <p>Dapatkan notifikasi instan saat reservasi masuk.</p>
                    </div>
                    <label class="toggle"><input type="checkbox" checked><span class="slider"></span></label>
                </div>

                <div class="list-item">
                    <div class="item-text">
                        <h3>Pengingat Reservasi</h3>
                        <p>Notifikasi 30 menit sebelum jadwal reservasi.</p>
                    </div>
                    <label class="toggle"><input type="checkbox" checked><span class="slider"></span></label>
                </div>

                <div class="list-item">
                    <div class="item-text">
                        <h3>Laporan Harian</h3>
                        <p>Ringkasan reservasi harian setiap pagi.</p>
                    </div>
                    <label class="toggle"><input type="checkbox"><span class="slider"></span></label>
                </div>
            </div>

            <!-- Keamanan -->
            <div class="card">
                <div class="card-header">
                    <div class="icon-box">
                        <svg viewBox="0 0 24 24">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                        </svg>
                    </div>
                    <h2>Keamanan</h2>
                </div>

                <div class="list-item">
                    <div class="item-text">
                        <h3>Autentikasi Dua Faktor</h3>
                        <p>Lapisan keamanan ekstra untuk akun Anda.</p>
                    </div>
                    <label class="toggle"><input type="checkbox"><span class="slider"></span></label>
                </div>

                <button class="btn-secondary">
                    <svg viewBox="0 0 24 24">
                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                    </svg>
                    Ganti Password
                </button>
            </div>

        </div>
    </div>

</main>

</body>
</html>