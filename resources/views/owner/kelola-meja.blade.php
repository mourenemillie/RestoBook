<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Menu & Meja – RestoBook</title>
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
            --green:  #10B981;
            --red:    #EF4444;
            --yellow: #F59E0B;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }

        body {
            background: #fafafa;
            display: flex;
            min-height: 100vh;
            color: var(--text-dark);
        }

        /* ===== SIDEBAR ===== */
        .sidebar {
            width: 260px;
            background: var(--sidebar-bg);
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

        .header {
            display: flex; justify-content: space-between;
            align-items: flex-end; margin-bottom: 40px;
        }

        .header-title h1 {
            font-size: 40px; font-weight: 800;
            letter-spacing: -0.5px; margin-bottom: 8px; color: #1a110e;
        }

        .header-title p { color: var(--text-gray); font-size: 16px; font-weight: 500; }

        .btn-add {
            background: var(--primary-dark); color: white; border: none;
            padding: 14px 28px; border-radius: 30px; font-size: 14px;
            font-weight: 700; cursor: pointer; display: flex;
            align-items: center; gap: 8px; text-decoration: none; white-space: nowrap;
        }

        .btn-add svg { width: 18px; height: 18px; stroke-width: 2.5; }

        /* ===== TAB SWITCHER ===== */
        .tab-bar {
            display: flex;
            background: var(--primary-light);
            padding: 6px; border-radius: 40px;
            gap: 4px; width: fit-content;
            margin-bottom: 40px;
        }

        .tab-btn {
            background: transparent; border: none;
            padding: 10px 32px; border-radius: 30px;
            font-size: 14px; font-weight: 600;
            color: #6b4d42; cursor: pointer;
            transition: all 0.2s ease;
            display: flex; align-items: center; gap: 8px;
        }

        .tab-btn svg { width: 16px; height: 16px; stroke-width: 2.5; }

        .tab-btn.active {
            background: var(--primary-dark);
            color: white;
        }

        /* ===== SECTION VISIBILITY ===== */
        .tab-section { display: none; }
        .tab-section.active { display: block; }

        /* ===== FILTER BAR (Menu) ===== */
        .filter-bar {
            display: flex; align-items: center;
            justify-content: space-between; margin-bottom: 28px;
            gap: 16px;
        }

        .category-pills {
            display: flex; gap: 10px; flex-wrap: wrap;
        }

        .cat-pill {
            padding: 8px 20px; border-radius: 20px; font-size: 13px;
            font-weight: 600; cursor: pointer; border: 1.5px solid var(--border-light);
            background: white; color: var(--text-gray); transition: all 0.2s;
        }

        .cat-pill.active, .cat-pill:hover {
            background: var(--primary-dark); color: white; border-color: var(--primary-dark);
        }

        .search-box {
            display: flex; align-items: center; gap: 10px;
            background: white; border: 1.5px solid var(--border-light);
            border-radius: 14px; padding: 10px 16px; min-width: 240px;
        }

        .search-box svg { width: 16px; height: 16px; color: var(--text-gray); stroke-width: 2.5; flex-shrink: 0; }

        .search-box input {
            border: none; outline: none; font-size: 14px;
            font-weight: 500; color: var(--text-dark);
            background: transparent; width: 100%;
        }

        .search-box input::placeholder { color: var(--text-gray); }

        /* ===== MENU GRID ===== */
        .menu-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }

        .menu-card {
            background: white; border-radius: 20px;
            border: 1.5px solid var(--border-light);
            overflow: hidden;
            transition: box-shadow 0.2s, transform 0.2s;
        }

        .menu-card:hover {
            box-shadow: 0 12px 32px rgba(0,0,0,0.08);
            transform: translateY(-3px);
        }

        /* Placeholder foto — warna berdasar kategori */
        .menu-img {
            width: 100%; height: 140px;
            display: flex; align-items: center; justify-content: center;
            font-size: 40px; position: relative;
        }

        .menu-img .status-dot {
            position: absolute; top: 12px; right: 12px;
            width: 10px; height: 10px; border-radius: 50%;
            border: 2px solid white;
        }

        .menu-body { padding: 16px; }

        .menu-category {
            font-size: 11px; font-weight: 700;
            color: var(--primary-brand); text-transform: uppercase;
            letter-spacing: 0.5px; margin-bottom: 6px;
        }

        .menu-name {
            font-size: 15px; font-weight: 700;
            color: #1a110e; margin-bottom: 4px;
            white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
        }

        .menu-desc {
            font-size: 12px; color: var(--text-gray);
            font-weight: 500; margin-bottom: 12px;
            display: -webkit-box; -webkit-line-clamp: 2;
            -webkit-box-orient: vertical; overflow: hidden;
        }

        .menu-footer {
            display: flex; align-items: center;
            justify-content: space-between;
        }

        .menu-price {
            font-size: 16px; font-weight: 800;
            color: var(--primary-dark);
        }

        .menu-status {
            font-size: 11px; font-weight: 700;
            padding: 4px 12px; border-radius: 20px;
        }

        .status-tersedia { background: #DCFCE7; color: var(--green); }
        .status-habis    { background: #FEE2E2; color: var(--red); }

        .menu-actions {
            display: flex; gap: 8px;
            padding: 12px 16px; border-top: 1px solid var(--border-light);
        }

        .btn-edit, .btn-delete {
            flex: 1; padding: 8px; border-radius: 10px;
            font-size: 12px; font-weight: 700; cursor: pointer;
            border: none; display: flex; align-items: center;
            justify-content: center; gap: 6px; text-decoration: none;
        }

        .btn-edit {
            background: var(--primary-light); color: var(--primary-dark);
        }

        .btn-edit:hover { background: #fde0d0; }

        .btn-delete {
            background: #FEE2E2; color: var(--red);
        }

        .btn-delete:hover { background: #fccbcb; }

        .btn-edit svg, .btn-delete svg { width: 13px; height: 13px; stroke-width: 2.5; }

        /* Empty state */
        .empty-state {
            grid-column: 1 / -1; text-align: center;
            padding: 80px 20px; color: var(--text-gray);
        }

        .empty-state svg {
            width: 56px; height: 56px; stroke: #d4c9c5;
            margin-bottom: 16px;
        }

        .empty-state h3 { font-size: 18px; font-weight: 700; margin-bottom: 8px; color: #b0a8a4; }
        .empty-state p  { font-size: 14px; }

        /* ===== MEJA SECTION ===== */
        .stats-grid {
            display: grid; grid-template-columns: repeat(4, 1fr);
            gap: 20px; margin-bottom: 36px;
        }

        .stat-card {
            background: white; border-radius: 20px; padding: 28px 24px;
            border: 1px solid var(--border-light);
            box-shadow: 0 4px 16px rgba(0,0,0,0.03);
            position: relative; overflow: hidden;
        }

        .stat-label { font-size: 13px; font-weight: 600; color: var(--text-gray); margin-bottom: 10px; }

        .stat-value { font-size: 44px; font-weight: 800; letter-spacing: -1px; line-height: 1; }

        .stat-icon {
            position: absolute; right: 20px; top: 50%; transform: translateY(-50%);
            width: 52px; height: 52px; border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
        }

        .stat-icon svg { width: 24px; height: 24px; stroke-width: 2; }

        .denah-section {
            background: white; border-radius: 24px; padding: 40px;
            border: 1px solid var(--border-light);
            box-shadow: 0 4px 16px rgba(0,0,0,0.03);
        }

        .denah-header {
            display: flex; justify-content: space-between;
            align-items: center; margin-bottom: 36px;
        }

        .denah-header h2 { font-size: 22px; font-weight: 800; color: #1a110e; }

        .legend { display: flex; gap: 20px; }
        .legend-item { display: flex; align-items: center; gap: 8px; font-size: 13px; font-weight: 600; color: var(--text-gray); }
        .dot { width: 10px; height: 10px; border-radius: 50%; }

        .table-grid {
            display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px;
        }

        .meja-card {
            border: 1.5px solid var(--border-light); border-radius: 20px;
            padding: 28px 20px; text-align: center; background: #fafafa;
            transition: box-shadow 0.2s, transform 0.2s;
        }

        .meja-card:hover { box-shadow: 0 8px 24px rgba(0,0,0,0.07); transform: translateY(-2px); }

        .meja-id { font-size: 22px; font-weight: 800; display: block; margin-bottom: 14px; letter-spacing: -0.5px; }

        .status-pill {
            padding: 6px 18px; border-radius: 20px; font-size: 12px;
            font-weight: 700; display: inline-block; margin-bottom: 14px;
        }

        .meja-info {
            font-size: 13px; font-weight: 700; color: var(--text-dark);
            display: flex; align-items: center; justify-content: center; gap: 6px;
        }

        .meja-info svg { width: 16px; height: 16px; stroke-width: 2.5; }

        .tersedia    { border-color: #D1FAE5; background: #F0FDF4; }
        .tersedia    .meja-id { color: var(--green); }
        .pill-tersedia { background: #DCFCE7; color: var(--green); }

        .terisi      { border-color: #FEE2E2; background: #FEF2F2; }
        .terisi      .meja-id { color: var(--red); }
        .pill-terisi   { background: #FEE2E2; color: var(--red); }

        .direservasi { border-color: #FEF3C7; background: #FFFBEB; }
        .direservasi .meja-id { color: var(--yellow); }
        .pill-direservasi { background: #FEF3C7; color: var(--yellow); }
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
        <img src="https://i.pravatar.cc/150?img=11" alt="Resto Owner">
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

        <form action="{{ route('logout') }}" method="POST" id="logout-form-kelola">
            @csrf
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form-kelola').submit();" class="logout">
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

    <!-- Header -->
    <div class="header">
        <div class="header-title">
            <h1>Kelola Menu & Meja</h1>
            <p>Atur menu dan ketersediaan meja restoran Anda.</p>
        </div>
        {{-- Tombol berubah sesuai tab aktif via JS --}}
        <a href="{{ route('owner.menu.create') }}" class="btn-add" id="btn-tambah">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                <line x1="12" y1="5" x2="12" y2="19"></line>
                <line x1="5" y1="12" x2="19" y2="12"></line>
            </svg>
            <span id="btn-tambah-label">Tambah Menu</span>
        </a>
    </div>

    <!-- Tab Bar -->
    <div class="tab-bar">
        <button class="tab-btn active" onclick="switchTab('menu', this)" id="tab-menu">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                <path d="M3 2v7c0 1.1.9 2 2 2h4a2 2 0 0 0 2-2V2"></path>
                <path d="M7 2v20"></path>
                <path d="M21 15V2v0a5 5 0 0 0-5 5v6c0 1.1.9 2 2 2h3zm0 0v7"></path>
            </svg>
            Menu
        </button>
        <button class="tab-btn" onclick="switchTab('meja', this)" id="tab-meja">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="8" width="18" height="4" rx="1"></rect>
                <line x1="8" y1="12" x2="8" y2="20"></line>
                <line x1="16" y1="12" x2="16" y2="20"></line>
                <line x1="5" y1="20" x2="19" y2="20"></line>
            </svg>
            Meja
        </button>
    </div>

    <!-- ===== TAB: MENU ===== -->
    <div class="tab-section active" id="section-menu">

        <!-- Filter Bar -->
        <div class="filter-bar">
            <div class="category-pills">
                <button class="cat-pill active" onclick="filterCategory(this, 'semua')">Semua</button>
                <button class="cat-pill" onclick="filterCategory(this, 'makanan')">🍽 Makanan</button>
                <button class="cat-pill" onclick="filterCategory(this, 'minuman')">🥤 Minuman</button>
                <button class="cat-pill" onclick="filterCategory(this, 'dessert')">🍰 Dessert</button>
            </div>
            <div class="search-box">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
                <input type="text" placeholder="Cari menu..." oninput="searchMenu(this.value)">
            </div>
        </div>

       <!-- Menu Grid -->
<div class="menu-grid" id="menu-grid">

    @forelse($menus as $menu)

    <div class="menu-card"
         data-category="{{ strtolower($menu->category) }}"
         data-name="{{ strtolower($menu->name) }}">

        <div class="menu-img">
            @if($menu->image)
                <img src="{{ asset('storage/' . $menu->image) }}"
                     alt="{{ $menu->name }}"
                     style="width:100%;height:100%;object-fit:cover;">
            @else
                <span>
                    {{ $menu->category == 'Makanan' ? '🍽' : ($menu->category == 'Minuman' ? '🥤' : '🍰') }}
                </span>
            @endif

            <div class="status-dot"
                 style="background: {{ $menu->is_available ? '#10B981' : '#EF4444' }};">
            </div>
        </div>

        <div class="menu-body">
            <div class="menu-category">{{ $menu->category }}</div>
            <div class="menu-name">{{ $menu->name }}</div>
            <div class="menu-desc">{{ $menu->description ?? 'Tidak ada deskripsi.' }}</div>

            <div class="menu-footer">
                <div class="menu-price">
                    Rp {{ number_format($menu->price, 0, ',', '.') }}
                </div>

                <span class="menu-status {{ $menu->is_available ? 'status-tersedia' : 'status-habis' }}">
                    {{ $menu->is_available ? 'Tersedia' : 'Habis' }}
                </span>
            </div>
        </div>

        <div class="menu-actions">
            <a href="{{ route('owner.menu.edit', $menu->id) }}" class="btn-edit">
                Edit
            </a>

            <form action="{{ route('owner.menu.destroy', $menu->id) }}"
                  method="POST"
                  onsubmit="return confirm('Hapus menu ini?')">
                @csrf
                @method('DELETE')

                <button type="submit" class="btn-delete">
                    Hapus
                </button>
            </form>
        </div>

    </div>

    @empty

    <div class="empty-state">
        <h3>Belum ada menu</h3>
        <p>Klik "Tambah Menu" untuk mulai menambahkan menu.</p>
    </div>

    @endforelse

</div>
    </div>

    <!-- ===== TAB: MEJA ===== -->
    <div class="tab-section" id="section-meja">

        <!-- Stats -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-label">Total Meja</div>
                <div class="stat-value" style="color:#1a110e;">{{ $tables->count() }}</div>
                <div class="stat-icon" style="background:#FFF2EB;">
                    <svg viewBox="0 0 24 24" fill="none" stroke="#ed5f1f" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="8" width="18" height="4" rx="1"></rect>
                        <line x1="8" y1="12" x2="8" y2="20"></line>
                        <line x1="16" y1="12" x2="16" y2="20"></line>
                    </svg>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Tersedia</div>
                <div class="stat-value" style="color:var(--green);">{{ $tables->where('status','available')->count() }}</div>
                <div class="stat-icon" style="background:#DCFCE7;">
                    <svg viewBox="0 0 24 24" fill="none" stroke="#10B981" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="20 6 9 17 4 12"></polyline>
                    </svg>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Terisi</div>
                <div class="stat-value" style="color:var(--red);">{{ $tables->where('status','occupied')->count() }}</div>
                <div class="stat-icon" style="background:#FEE2E2;">
                    <svg viewBox="0 0 24 24" fill="none" stroke="#EF4444" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                    </svg>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Direservasi</div>
                <div class="stat-value" style="color:var(--yellow);">{{ $tables->where('status','reserved')->count() }}</div>
                <div class="stat-icon" style="background:#FEF3C7;">
                    <svg viewBox="0 0 24 24" fill="none" stroke="#F59E0B" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <polyline points="12 6 12 12 16 14"></polyline>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Denah -->
        <div class="denah-section">
            <div class="denah-header">
                <h2>Denah Meja</h2>
                <div class="legend">
                    <div class="legend-item"><div class="dot" style="background:var(--green);"></div> Tersedia</div>
                    <div class="legend-item"><div class="dot" style="background:var(--red);"></div> Terisi</div>
                    <div class="legend-item"><div class="dot" style="background:var(--yellow);"></div> Direservasi</div>
                </div>
            </div>

            <div class="table-grid">
                @forelse($tables as $table)
                <div class="meja-card
                    {{ $table->status == 'available' ? 'tersedia'    : '' }}
                    {{ $table->status == 'occupied'  ? 'terisi'      : '' }}
                    {{ $table->status == 'reserved'  ? 'direservasi' : '' }}">
                    <span class="meja-id">{{ str_pad($table->table_number, 2, '0', STR_PAD_LEFT) }}</span>
                    @if($table->status == 'available')
                        <div class="status-pill pill-tersedia">Tersedia</div>
                    @elseif($table->status == 'occupied')
                        <div class="status-pill pill-terisi">Terisi</div>
                    @else
                        <div class="status-pill pill-direservasi">Direservasi</div>
                    @endif
                    <div class="meja-info">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                        </svg>
                        {{ $table->capacity }} Kursi
                    </div>
                </div>
                @empty
                <div style="grid-column:1/-1;text-align:center;padding:60px 20px;color:var(--text-gray);">
                    Belum ada data meja
                </div>
                @endforelse
            </div>
        </div>
    </div>

</main>

<script>
    // Tab switching
    function switchTab(tab, el) {
        document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
        document.querySelectorAll('.tab-section').forEach(s => s.classList.remove('active'));
        el.classList.add('active');
        document.getElementById('section-' + tab).classList.add('active');

        // Update tombol tambah
        const label = document.getElementById('btn-tambah-label');
        const btn   = document.getElementById('btn-tambah');
        if (tab === 'menu') {
            label.textContent = 'Tambah Menu';
            btn.href = "{{ route('owner.menu.create') }}";
        } else {
            label.textContent = 'Tambah Meja';
            btn.href = "{{ route('owner.kelola-meja.create') }}";
        }
    }

    // Filter kategori
    function filterCategory(el, cat) {
        document.querySelectorAll('.cat-pill').forEach(p => p.classList.remove('active'));
        el.classList.add('active');
        document.querySelectorAll('.menu-card').forEach(card => {
            if (cat === 'semua' || card.dataset.category === cat) {
                card.style.display = '';
            } else {
                card.style.display = 'none';
            }
        });
    }

    // Search menu
    function searchMenu(val) {
        const q = val.toLowerCase();
        document.querySelectorAll('.menu-card').forEach(card => {
            card.style.display = card.dataset.name.includes(q) ? '' : 'none';
        });
    }
</script>

</body>
</html>