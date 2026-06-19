<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Menu – RestoBook</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

        :root {
            --primary-brand: #ed5f1f;
            --primary-dark:  #a03605;
            --primary-light: #fff2eb;
            --bg-color:      #ffffff;
            --sidebar-bg:    #ffffff;
            --text-dark:     #1e1512;
            --text-gray:     #786f6c;
            --border-light:  #f3f0ef;
            --nav-active-bg:     #fff6f3;
            --nav-active-border: #ed5f1f;
            --danger-color:  #d1302b;
            --border-input:  #e8e3e0;
            --green: #10B981;
            --red:   #EF4444;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }

        body { background: #fafafa; display: flex; min-height: 100vh; color: var(--text-dark); }

        /* ===== SIDEBAR ===== */
        .sidebar {
            width: 260px; background: var(--sidebar-bg);
            display: flex; flex-direction: column;
            border-right: 1px solid var(--border-light);
            padding: 32px 0; flex-shrink: 0;
            position: sticky; top: 0; height: 100vh;
        }

        .logo {
            display: flex; align-items: center; gap: 8px;
            padding: 0 28px; margin-bottom: 40px;
            color: var(--primary-brand); font-size: 20px; font-weight: 800;
        }

        .user-profile {
            display: flex; align-items: center; gap: 12px;
            padding: 0 28px; margin-bottom: 40px;
        }

        .user-profile img { width: 44px; height: 44px; border-radius: 50%; object-fit: cover; }
        .user-info h4 { font-size: 14px; font-weight: 700; margin-bottom: 2px; }
        .user-info p  { font-size: 11px; color: var(--text-gray); }

        .nav-menu { list-style: none; display: flex; flex-direction: column; }

        .nav-item {
            display: flex; align-items: center; gap: 16px;
            padding: 16px 28px; color: var(--text-gray);
            text-decoration: none; font-weight: 600; font-size: 14px;
            border-left: 4px solid transparent;
        }

        .nav-item svg { width: 20px; height: 20px; stroke-width: 2.5; flex-shrink: 0; }

        .nav-item.active {
            color: var(--primary-brand);
            background-color: var(--nav-active-bg);
            border-left-color: var(--nav-active-border);
        }

        .logout {
            margin-top: auto; color: var(--danger-color);
            padding: 16px 28px; display: flex; align-items: center;
            gap: 16px; font-weight: 600; font-size: 14px; text-decoration: none;
        }

        /* ===== MAIN ===== */
        .main-content {
            flex: 1; padding: 48px 64px;
            overflow-y: auto; background: #fafafa;
        }

        /* Breadcrumb */
        .breadcrumb {
            display: flex; align-items: center; gap: 8px;
            margin-bottom: 32px;
        }

        .breadcrumb a {
            color: var(--text-gray); text-decoration: none;
            font-size: 14px; font-weight: 500;
            display: flex; align-items: center; gap: 6px;
        }

        .breadcrumb a:hover { color: var(--primary-brand); }
        .breadcrumb a svg { width: 16px; height: 16px; stroke-width: 2.5; }

        .breadcrumb span {
            color: var(--text-gray); font-size: 14px;
        }

        .breadcrumb .current {
            color: var(--text-dark); font-weight: 600; font-size: 14px;
        }

        /* Header */
        .header { margin-bottom: 40px; }

        .header h1 {
            font-size: 40px; font-weight: 800;
            letter-spacing: -0.5px; margin-bottom: 8px; color: #1a110e;
        }

        .header p { color: var(--text-gray); font-size: 16px; font-weight: 500; }

        /* ===== FORM LAYOUT ===== */
        .form-layout {
            display: grid;
            grid-template-columns: 1fr 380px;
            gap: 28px;
            align-items: start;
        }

        /* ===== CARDS ===== */
        .card {
            background: white; border-radius: 24px; padding: 32px;
            border: 1px solid var(--border-light);
            box-shadow: 0 4px 16px rgba(0,0,0,0.03);
            margin-bottom: 24px;
        }

        .card:last-child { margin-bottom: 0; }

        .card-header {
            display: flex; align-items: center; gap: 14px; margin-bottom: 28px;
        }

        .icon-box {
            width: 40px; height: 40px; background: var(--primary-light);
            border-radius: 12px; display: flex; align-items: center;
            justify-content: center; color: var(--primary-brand); flex-shrink: 0;
        }

        .icon-box svg { width: 20px; height: 20px; stroke: currentColor; fill: none; stroke-width: 2; }

        .card-header h2 { font-size: 20px; font-weight: 800; color: #1a110e; }

        /* ===== FORM ELEMENTS ===== */
        .form-group { margin-bottom: 20px; }
        .form-group:last-child { margin-bottom: 0; }

        .form-label {
            display: block; font-size: 11px; font-weight: 700;
            color: var(--text-gray); margin-bottom: 8px;
            letter-spacing: 0.6px; text-transform: uppercase;
        }

        .form-label .required { color: var(--red); margin-left: 2px; }

        .form-control {
            width: 100%; padding: 14px 16px;
            border: 1.5px solid var(--border-input); border-radius: 14px;
            font-size: 14px; font-weight: 500; color: var(--text-dark);
            outline: none; transition: border-color 0.2s; background: #fff;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .form-control:focus { border-color: var(--primary-brand); }

        textarea.form-control { resize: none; height: 110px; }

        select.form-control { cursor: pointer; appearance: none; background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%23786f6c' stroke-width='2.5'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E"); background-repeat: no-repeat; background-position: right 14px center; padding-right: 44px; }

        .form-control.error { border-color: var(--red); }

        .error-msg { font-size: 12px; color: var(--red); font-weight: 600; margin-top: 6px; }

        /* Price input wrapper */
        .input-prefix {
            position: relative;
        }

        .input-prefix .prefix {
            position: absolute; left: 16px; top: 50%; transform: translateY(-50%);
            font-size: 14px; font-weight: 700; color: var(--text-gray);
        }

        .input-prefix .form-control { padding-left: 48px; }

        /* ===== IMAGE UPLOAD ===== */
        .upload-area {
            border: 2px dashed var(--border-input); border-radius: 16px;
            padding: 40px 20px; text-align: center; cursor: pointer;
            transition: all 0.2s; background: #fafafa; position: relative;
        }

        .upload-area:hover { border-color: var(--primary-brand); background: var(--primary-light); }

        .upload-area.has-preview { padding: 0; border: none; }

        .upload-area svg { width: 40px; height: 40px; stroke: #c5beba; margin-bottom: 12px; }

        .upload-area h3 { font-size: 14px; font-weight: 700; color: var(--text-dark); margin-bottom: 6px; }

        .upload-area p { font-size: 12px; color: var(--text-gray); font-weight: 500; }

        .upload-area input[type="file"] {
            position: absolute; inset: 0; opacity: 0; cursor: pointer; width: 100%; height: 100%;
        }

        #image-preview {
            width: 100%; border-radius: 16px; object-fit: cover;
            max-height: 220px; display: none;
        }

        /* ===== STATUS TOGGLE ===== */
        .status-toggle {
            display: flex; gap: 12px;
        }

        .status-opt {
            flex: 1; padding: 14px; border-radius: 14px;
            border: 2px solid var(--border-input); cursor: pointer;
            text-align: center; transition: all 0.2s;
        }

        .status-opt input { display: none; }

        .status-opt .opt-emoji { font-size: 22px; display: block; margin-bottom: 6px; }
        .status-opt .opt-label { font-size: 13px; font-weight: 700; }

        .status-opt.selected-available {
            border-color: var(--green); background: #F0FDF4;
        }
        .status-opt.selected-available .opt-label { color: var(--green); }

        .status-opt.selected-habis {
            border-color: var(--red); background: #FEF2F2;
        }
        .status-opt.selected-habis .opt-label { color: var(--red); }

        /* ===== ACTION BUTTONS ===== */
        .action-card {
            background: white; border-radius: 24px; padding: 28px;
            border: 1px solid var(--border-light);
            box-shadow: 0 4px 16px rgba(0,0,0,0.03);
        }

        .btn-submit {
            width: 100%; padding: 16px; border: none;
            border-radius: 30px; background: var(--primary-dark);
            color: white; font-size: 15px; font-weight: 700;
            cursor: pointer; transition: background 0.2s;
            display: flex; align-items: center; justify-content: center; gap: 8px;
            margin-bottom: 12px;
        }

        .btn-submit:hover { background: #8a2e04; }
        .btn-submit svg { width: 18px; height: 18px; stroke-width: 2.5; }

        .btn-cancel {
            width: 100%; padding: 14px; border: 2px solid var(--border-input);
            border-radius: 30px; background: transparent;
            color: var(--text-gray); font-size: 14px; font-weight: 700;
            cursor: pointer; transition: all 0.2s; text-decoration: none;
            display: flex; align-items: center; justify-content: center; gap: 8px;
        }

        .btn-cancel:hover { border-color: var(--text-gray); color: var(--text-dark); }
        .btn-cancel svg { width: 16px; height: 16px; stroke-width: 2.5; }

        /* Tips card */
        .tips-card {
            background: var(--primary-light); border-radius: 20px; padding: 24px;
            margin-top: 16px;
        }

        .tips-card h4 {
            font-size: 13px; font-weight: 800; color: var(--primary-dark);
            margin-bottom: 12px; display: flex; align-items: center; gap: 8px;
        }

        .tips-card h4 svg { width: 16px; height: 16px; }

        .tips-card ul { list-style: none; display: flex; flex-direction: column; gap: 8px; }

        .tips-card ul li {
            font-size: 12px; color: #7a3b1e; font-weight: 500;
            display: flex; align-items: flex-start; gap: 8px; line-height: 1.5;
        }

        .tips-card ul li::before { content: '•'; font-weight: 900; flex-shrink: 0; }

        /* Flash */
        @keyframes slideIn { from { opacity:0; transform: translateY(-10px); } to { opacity:1; transform: translateY(0); } }

        .flash { position: fixed; top: 24px; right: 24px; padding: 14px 22px;
            border-radius: 14px; font-weight: 600; font-size: 14px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.12); z-index: 9999;
            animation: slideIn 0.3s ease;
        }

        .flash.success { background: var(--primary-dark); color: white; }
        .flash.error   { background: var(--red); color: white; }
    </style>
</head>
<body>

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
        <img src="{{ auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) . '&background=E8500A&color=fff' }}" alt="Resto Owner">
        <div class="user-info">
            <h4>Resto Owner</h4>
            <p>Manage your resto</p>
        </div>
    </div>

    <nav class="nav-menu">
        <a href="{{ route('owner.dashboard') }}" class="nav-item">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect>
                <rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect>
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
        <a href="{{ route('owner.kelola-meja') }}" class="nav-item active">
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

        <form action="{{ route('logout') }}" method="POST" id="logout-form-tambah-menu">
            @csrf
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form-tambah-menu').submit();" class="logout">
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

<!-- ===== MAIN ===== -->
<main class="main-content">

    @if(session('success'))
        <div class="flash success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="flash error">Periksa kembali isian form.</div>
    @endif

    <!-- Breadcrumb -->
    <div class="breadcrumb">
        <a href="{{ route('owner.kelola-meja') }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="15 18 9 12 15 6"></polyline>
            </svg>
            Kelola Menu & Meja
        </a>
        <span>/</span>
        <span class="current">Tambah Menu</span>
    </div>

    <!-- Header -->
    <div class="header">
        <h1>Tambah Menu</h1>
        <p>Isi detail menu baru untuk restoran Anda.</p>
    </div>

    <!-- Form -->
    <form action="{{ route('owner.menu.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-layout">

            <!-- ===== KOLOM KIRI ===== -->
            <div>

                <!-- Info Menu -->
                <div class="card">
                    <div class="card-header">
                        <div class="icon-box">
                            <svg viewBox="0 0 24 24">
                                <path d="M3 2v7c0 1.1.9 2 2 2h4a2 2 0 0 0 2-2V2"></path>
                                <path d="M7 2v20"></path>
                                <path d="M21 15V2v0a5 5 0 0 0-5 5v6c0 1.1.9 2 2 2h3zm0 0v7"></path>
                            </svg>
                        </div>
                        <h2>Informasi Menu</h2>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Nama Menu <span class="required">*</span></label>
                        <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'error' : '' }}"
                               placeholder="cth. Nasi Goreng Spesial"
                               value="{{ old('name') }}">
                        @error('name') <div class="error-msg">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Kategori <span class="required">*</span></label>
                        <select name="category" class="form-control {{ $errors->has('category') ? 'error' : '' }}">
                            <option value="" disabled {{ old('category') ? '' : 'selected' }}>Pilih kategori...</option>
                            <option value="Makanan"  {{ old('category') == 'Makanan'  ? 'selected' : '' }}>🍽 Makanan</option>
                            <option value="Minuman"  {{ old('category') == 'Minuman'  ? 'selected' : '' }}>🥤 Minuman</option>
                            <option value="Dessert"  {{ old('category') == 'Dessert'  ? 'selected' : '' }}>🍰 Dessert</option>
                        </select>
                        @error('category') <div class="error-msg">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="description" class="form-control"
                                  placeholder="Jelaskan bahan, rasa, atau keunikan menu ini...">{{ old('description') }}</textarea>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Harga <span class="required">*</span></label>
                        <div class="input-prefix">
                            <span class="prefix">Rp</span>
                            <input type="number" name="price" class="form-control {{ $errors->has('price') ? 'error' : '' }}"
                                   placeholder="0" min="0"
                                   value="{{ old('price') }}">
                        </div>
                        @error('price') <div class="error-msg">{{ $message }}</div> @enderror
                    </div>
                </div>

                <!-- Status -->
                <div class="card">
                    <div class="card-header">
                        <div class="icon-box">
                            <svg viewBox="0 0 24 24">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                        </div>
                        <h2>Status Ketersediaan</h2>
                    </div>

                    <div class="status-toggle">
                        <label class="status-opt {{ old('is_available', '1') == '1' ? 'selected-available' : '' }}"
                               id="opt-available" onclick="selectStatus('1')">
                            <input type="radio" name="is_available" value="1"
                                   {{ old('is_available', '1') == '1' ? 'checked' : '' }}>
                            <span class="opt-emoji">✅</span>
                            <span class="opt-label">Tersedia</span>
                        </label>
                        <label class="status-opt {{ old('is_available') == '0' ? 'selected-habis' : '' }}"
                               id="opt-habis" onclick="selectStatus('0')">
                            <input type="radio" name="is_available" value="0"
                                   {{ old('is_available') == '0' ? 'checked' : '' }}>
                            <span class="opt-emoji">❌</span>
                            <span class="opt-label">Habis</span>
                        </label>
                    </div>
                </div>

            </div>

            <!-- ===== KOLOM KANAN ===== -->
            <div>

                <!-- Upload Foto -->
                <div class="card">
                    <div class="card-header">
                        <div class="icon-box">
                            <svg viewBox="0 0 24 24">
                                <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                <polyline points="21 15 16 10 5 21"></polyline>
                            </svg>
                        </div>
                        <h2>Foto Menu</h2>
                    </div>

                    <div class="upload-area" id="upload-area">
                        <input type="file" name="image" accept="image/*"
                               onchange="previewImage(this)">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="16 16 12 12 8 16"></polyline>
                            <line x1="12" y1="12" x2="12" y2="21"></line>
                            <path d="M20.39 18.39A5 5 0 0 0 18 9h-1.26A8 8 0 1 0 3 16.3"></path>
                        </svg>
                        <h3>Upload foto menu</h3>
                        <p>PNG, JPG, WEBP • Maks. 2MB</p>
                        <img id="image-preview" src="" alt="Preview">
                    </div>
                </div>

                <!-- Tombol Aksi -->
                <div class="action-card">
                    <button type="submit" class="btn-submit">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                            <polyline points="17 21 17 13 7 13 7 21"></polyline>
                            <polyline points="7 3 7 8 15 8"></polyline>
                        </svg>
                        Simpan Menu
                    </button>
                    <a href="{{ route('owner.kelola-meja') }}" class="btn-cancel">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                        Batal
                    </a>
                </div>

                <!-- Tips -->
                <div class="tips-card">
                    <h4>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="12" y1="8" x2="12" y2="12"></line>
                            <line x1="12" y1="16" x2="12.01" y2="16"></line>
                        </svg>
                        Tips pengisian menu
                    </h4>
                    <ul>
                        <li>Gunakan nama yang mudah diingat pelanggan</li>
                        <li>Deskripsi singkat membantu pelanggan memilih</li>
                        <li>Foto yang menarik meningkatkan minat pesan</li>
                        <li>Update status ke "Habis" jika stok kosong</li>
                    </ul>
                </div>

            </div>
        </div>
    </form>

</main>

<script>
    function previewImage(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById('image-preview');
                const area    = document.getElementById('upload-area');
                preview.src = e.target.result;
                preview.style.display = 'block';
                area.classList.add('has-preview');
                // Sembunyikan teks upload
                area.querySelectorAll('svg, h3, p').forEach(el => el.style.display = 'none');
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    function selectStatus(val) {
        const optAvailable = document.getElementById('opt-available');
        const optHabis     = document.getElementById('opt-habis');
        optAvailable.classList.remove('selected-available');
        optHabis.classList.remove('selected-habis');
        if (val === '1') {
            optAvailable.classList.add('selected-available');
        } else {
            optHabis.classList.add('selected-habis');
        }
    }

    // Auto-hide flash
    setTimeout(() => {
        document.querySelectorAll('.flash').forEach(el => el.remove());
    }, 3000);
</script>

</body>
</html>
