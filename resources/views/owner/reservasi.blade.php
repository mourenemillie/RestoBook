<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kedatangan - RestoBook</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

        :root {
            --primary-brand: #ed5f1f;
            --primary-dark: #a03605;
            --bg-color: #ffffff;
            --sidebar-bg: #ffffff;
            --text-dark: #1e1512;
            --text-gray: #786f6c;
            --border-light: #f3f0ef;
            
            --nav-active-bg: #fff6f3;
            --nav-active-border: #ed5f1f;
            
            --pill-container-bg: #fbede6;
            --pill-text: #6b4d42;
            
            --time-bg: #f8dbcf;
            --tag-table-bg: #f6c085;
            --tag-table-text: #522d05;
            --tag-guest-bg: #ead1c6;
            --tag-guest-text: #4a2818;
            
            --danger-color: #d1302b;
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
            background-color: var(--sidebar-bg);
            display: flex;
            flex-direction: column;
            border-right: 1px solid var(--border-light);
            padding: 32px 0;
            flex-shrink: 0;
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

        .user-info h4 {
            font-size: 14px;
            font-weight: 700;
            margin-bottom: 2px;
        }

        .user-info p {
            font-size: 11px;
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
            padding: 16px 28px;
            color: var(--text-gray);
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

        /* Main Content */
        .main-content {
            flex: 1;
            padding: 48px 64px;
            overflow-y: auto;
            background-color: #fafafa; /* Slight off-white to make cards pop */
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

        .filter-pills {
            display: flex;
            background-color: var(--pill-container-bg);
            padding: 6px;
            border-radius: 40px;
            gap: 4px;
        }

        .filter-btn {
            background: transparent;
            border: none;
            padding: 10px 32px;
            border-radius: 30px;
            font-size: 14px;
            font-weight: 600;
            color: var(--pill-text);
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
    display: inline-block;
        }

        .filter-btn.active {
            background-color: var(--primary-dark);
            color: white;
        }

        /* Reservation List */
        .reservation-list {
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        .reservation-card {
            background: #ffffff;
            border-radius: 24px;
            padding: 16px 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 1px solid #f2eeec;
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.03);
        }

        .card-left {
            display: flex;
            align-items: center;
            gap: 28px;
        }

        .time-badge {
            background-color: var(--time-bg);
            color: #2b160d;
            font-size: 22px;
            font-weight: 700;
            padding: 12px 16px;
            border-radius: 24px;
            min-width: 110px;
            text-align: center;
            letter-spacing: -0.5px;
        }

        .guest-info h2 {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 10px;
            color: #1a110e;
        }

        .tags {
            display: flex;
            gap: 12px;
        }

        .tag {
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 6px 14px;
            border-radius: 16px;
            font-size: 13px;
            font-weight: 700;
        }

        .tag.table {
            background-color: var(--tag-table-bg);
            color: var(--tag-table-text);
        }

        .tag.guest {
            background-color: var(--tag-guest-bg);
            color: var(--tag-guest-text);
        }

        .tag svg {
            width: 14px;
            height: 14px;
        }

        .card-actions {
            display: flex;
            gap: 16px;
        }

        .btn-outline {
            background: transparent;
            border: 2px solid var(--primary-dark);
            color: var(--primary-dark);
            padding: 14px 28px;
            border-radius: 30px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
        }

        .btn-filled {
            background: var(--primary-dark);
            border: 2px solid var(--primary-dark);
            color: white;
            padding: 14px 32px;
            border-radius: 30px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
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
            <a href="{{ route('owner.reservasi') }}" class="nav-item active">
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
            
            <!-- Pada Laravel, link logout bisa diubah menjadi form submit sesuai standar keamanan bawaan laravel breeze/breeze-like -->
            <form action="{{ route('logout') }}" method="POST" id="logout-form-owner-reservasi">
                @csrf
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form-owner-reservasi').submit();" class="logout">
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
            <div class="header-title">
                <h1>Kedatangan</h1>
                <p>Kelola reservasi dan kedatangan tamu hari ini.</p>
            </div>
            <div class="filter-pills">

    <a href="{{ route('owner.reservasi') }}"
       class="filter-btn {{ request('status') == null ? 'active' : '' }}">
        Semua
    </a>

    <a href="{{ route('owner.reservasi', ['status' => 'pending']) }}"
       class="filter-btn {{ request('status') == 'pending' ? 'active' : '' }}">
        Menunggu
    </a>

    <a href="{{ route('owner.reservasi', ['status' => 'approved']) }}"
       class="filter-btn {{ request('status') == 'approved' ? 'active' : '' }}">
        Diterima
    </a>

    <a href="{{ route('owner.reservasi', ['status' => 'completed']) }}"
       class="filter-btn {{ request('status') == 'completed' ? 'active' : '' }}">
        Hadir
    </a>

    <a href="{{ route('owner.reservasi', ['status' => 'cancelled']) }}"
       class="filter-btn {{ request('status') == 'cancelled' ? 'active' : '' }}">
        Tidak Hadir
    </a>

    <a href="{{ route('owner.reservasi', ['status' => 'rejected']) }}"
       class="filter-btn {{ request('status') == 'rejected' ? 'active' : '' }}">
        Ditolak
    </a>

</div>
        </header>

        <div class="reservation-list">

    @forelse($reservations as $reservation)

    <div class="reservation-card">
        <div class="card-left">

            <div class="time-badge">
                {{ \Carbon\Carbon::parse($reservation->reservation_time)->format('H:i') }}
            </div>

            <div class="guest-info">

                <h2>
                    {{ \App\Models\User::find($reservation->user_id)?->name }}
                </h2>

                <div class="tags">

                    <span class="tag table">
                        Meja {{ $reservation->table_id }}
                    </span>

                    <span class="tag guest">
                        {{ $reservation->num_guests }} Tamu
                    </span>

                </div>

            </div>
        </div>

        <div class="card-actions">

    @if($reservation->status == 'pending')

        <form action="{{ route('owner.reservasi.reject', $reservation->id) }}"
              method="POST">
            @csrf
            @method('PATCH')

            <button type="submit" class="btn-outline">
                Tolak
            </button>
        </form>

        <form action="{{ route('owner.reservasi.approve', $reservation->id) }}"
              method="POST">
            @csrf
            @method('PATCH')

            <button type="submit" class="btn-filled">
                Terima
            </button>
        </form>

    @elseif($reservation->status == 'approved')

        <form action="{{ route('owner.reservasi.tidak-hadir', $reservation->id) }}"
              method="POST">
            @csrf
            @method('PATCH')

            <button type="submit" class="btn-outline">
                Tidak Hadir
            </button>
        </form>

        <form action="{{ route('owner.reservasi.hadir', $reservation->id) }}"
              method="POST">
            @csrf
            @method('PATCH')

            <button type="submit" class="btn-filled">
                Hadir
            </button>
        </form>

    @elseif($reservation->status == 'completed')

        <button class="btn-filled" disabled style="opacity: 0.6; cursor: default;">
            Hadir
        </button>

    @elseif($reservation->status == 'cancelled')

        <button class="btn-outline" disabled style="opacity: 0.6; cursor: default;">
            Tidak Hadir
        </button>

    @elseif($reservation->status == 'rejected')

        <button class="btn-outline" disabled style="border-color: var(--danger-color); color: var(--danger-color); opacity: 0.6; cursor: default;">
            Ditolak
        </button>

    @endif

    <a href="{{ route('owner.reservasi.show', $reservation->id) }}"
       class="btn-filled">
        Detail
    </a>

</div>
    </div>

    @empty

    <div class="reservation-card">
        <div class="guest-info">
            <h2>Belum ada reservasi</h2>
        </div>
    </div>

    @endforelse

</div>
            </div>
        </div>
    </main>

</body>
</html>