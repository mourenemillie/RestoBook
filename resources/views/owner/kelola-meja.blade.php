<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Meja – RestoBook</title>
    <!-- Font Plus Jakarta Sans sesuai instruksi -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --primary: #BC4B09;
            --primary-light: #FFF2EB;
            --bg-light: #FBF7F4;
            --white: #FFFFFF;
            --text-dark: #1A1A1A;
            --text-muted: #717171;
            --border: #F0F0F0;
            --green: #10B981;
            --red: #EF4444;
            --yellow: #F59E0B;
            --radius-lg: 24px;
            --radius-md: 16px;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-light);
            color: var(--text-dark);
        }

        .app-wrapper { display: flex; min-height: 100vh; }

        /* SIDEBAR */
        .sidebar {
            width: 240px; background: var(--white);
            border-right: 1px solid var(--border);
            display: flex; flex-direction: column;
            padding: 28px 0; position: sticky; top: 0; height: 100vh;
        }
        .sidebar-logo {
            display: flex; align-items: center; gap: 10px;
            padding: 0 24px; color: var(--primary);
            font-size: 20px; font-weight: 700; margin-bottom: 32px;
        }
        .sidebar-profile {
            display: flex; align-items: center; gap: 12px;
            padding: 0 24px; margin-bottom: 28px;
        }
        .sidebar-profile img { width: 42px; height: 42px; border-radius: 50%; }
        .sidebar-nav a {
            display: flex; align-items: center; gap: 14px;
            padding: 13px 24px; text-decoration: none;
            color: var(--text-muted); font-size: 13.5px; font-weight: 500;
        }
        .sidebar-nav a.active {
            background: var(--primary-light); color: var(--primary);
            border-right: 4px solid var(--primary); font-weight: 600;
        }
        .sidebar-logout { margin-top: auto; padding: 0 24px; }
        .sidebar-logout a { color: var(--primary); text-decoration: none; font-size: 14px; font-weight: 600; }

        /* MAIN CONTENT */
        .main-content { flex: 1; padding: 40px 60px; }

        .page-header { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 32px; }
        .page-header h1 { font-size: 28px; font-weight: 700; margin-bottom: 8px; }
        .page-header p { color: var(--text-muted); font-size: 14px; }
        
        .btn-add {
            background: var(--primary); color: white; border: none;
            padding: 12px 24px; border-radius: 12px; font-weight: 600;
            cursor: pointer; display: flex; align-items: center; gap: 8px;
        }

        /* STATS */
        .stats-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-bottom: 40px; }
        .stat-card {
            background: white; padding: 24px; border-radius: 12px;
            position: relative; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.02);
        }
        .stat-card span { font-size: 13px; color: var(--text-muted); font-weight: 500; }
        .stat-card h2 { font-size: 42px; font-weight: 700; margin-top: 8px; }
        .stat-icon-bg {
            position: absolute; right: -10px; top: 10px; width: 80px; height: 80px;
            border-radius: 50%; opacity: 0.1; display: flex; align-items: center; justify-content: center; font-size: 24px;
        }

        /* DENAH MEJA */
        .denah-section { background: white; border-radius: var(--radius-lg); padding: 40px; min-height: 500px; }
        .denah-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 32px; }
        .legend { display: flex; gap: 20px; }
        .legend-item { display: flex; align-items: center; gap: 8px; font-size: 13px; font-weight: 600; }
        .dot { width: 10px; height: 10px; border-radius: 50%; }

        .table-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 24px; }
        .meja-card {
            border: 1.5px solid var(--border); border-radius: 20px;
            padding: 24px; text-align: center; position: relative;
        }
        .meja-card.wide { grid-column: span 2; display: flex; align-items: center; justify-content: space-around; }
        
        .meja-id { font-size: 18px; font-weight: 700; margin-bottom: 16px; display: block; }
        .status-pill {
            padding: 6px 16px; border-radius: 20px; font-size: 12px; font-weight: 700;
            display: inline-block; margin-bottom: 12px;
        }
        .meja-info { font-size: 12px; color: #000; font-weight: 800; display: flex; align-items: center; justify-content: center; gap: 4px; }

        /* Warna Status */
        .tersedia { border-color: #D1FAE5; background: #F0FDF4; color: var(--green); }
        .pill-tersedia { background: #DCFCE7; color: var(--green); }
        
        .terisi { border-color: #FEE2E2; background: #FEF2F2; color: var(--red); }
        .pill-terisi { background: #FEE2E2; color: var(--red); }
        
        .direservasi { border-color: #FEF3C7; background: #FFFBEB; color: var(--yellow); }
        .pill-direservasi { background: #FEF3C7; color: var(--yellow); }

        .status-dot { width: 8px; height: 8px; background: var(--red); border-radius: 50%; position: absolute; top: 15px; right: 15px; }
    </style>
</head>
<body>

<div class="app-wrapper">
    <!-- SIDEBAR -->
    <aside class="sidebar">
        <div class="sidebar-logo"><i class="bi bi-cup-hot-fill"></i> RestoBook</div>
        <div class="sidebar-profile">
            <img src="https://i.pravatar.cc/150?img=11" alt="Owner">
            <div><strong style="font-size: 13px;">Resto Owner</strong><p style="font-size: 11px; color:gray;">Manage your resto</p></div>
        </div>
        <nav class="sidebar-nav">
            <a href="{{ route('owner.dashboard') }}"><i class="bi bi-grid"></i> Dashboard</a>
            <a href="{{ route('owner.reservasi') }}"><i class="bi bi-calendar"></i> Reservasi</a>
            <a href="{{ route('owner.kelola-meja') }}" class="active"><i class="bi bi-funnel"></i> Kelola Menu dan Meja</a>
            <a href="{{ route('owner.settings') }}"><i class="bi bi-gear"></i> Pengaturan</a>
        </nav>
        <div class="sidebar-logout">
            <form action="{{ route('logout') }}" method="POST" id="logout-form">
                @csrf
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="bi bi-box-arrow-left"></i> Logout</a>
            </form>
        </div>
    </aside>

    <!-- MAIN -->
    <main class="main-content">
        <div class="page-header">
            <div>
                <h1>Kelola Meja</h1>
                <p>Atur ketersediaan dan status meja restoran Anda saat ini.</p>
            </div>
            <a href="{{ route('owner.kelola-meja.create') }}" class="btn-add" style="text-decoration:none;">
    <i class="bi bi-plus-lg"></i> Tambah Meja
</a>
        </div>

        <!-- STATS -->
<div class="stats-grid">
    <div class="stat-card">
        <span>Total Meja</span>
        <h2>{{ $tables->count() }}</h2>
        <div class="stat-icon-bg" style="background: #FBEAE9;">
            <i class="bi bi-door-open"></i>
        </div>
    </div>

    <div class="stat-card">
        <span>Tersedia</span>
        <h2 style="color: var(--green);">
            {{ $tables->where('status','available')->count() }}
        </h2>
        <div class="stat-icon-bg" style="background: #D1FAE5;">
            <i class="bi bi-check-circle"></i>
        </div>
    </div>

    <div class="stat-card">
        <span>Terisi</span>
        <h2 style="color: var(--red);">
            {{ $tables->where('status','occupied')->count() }}
        </h2>
        <div class="stat-icon-bg" style="background: #FEE2E2;">
            <i class="bi bi-people"></i>
        </div>
    </div>

    <div class="stat-card">
        <span>Direservasi</span>
        <h2 style="color: var(--yellow);">
            {{ $tables->where('status','reserved')->count() }}
        </h2>
        <div class="stat-icon-bg" style="background: #FEF3C7;">
            <i class="bi bi-clock"></i>
        </div>
    </div>
</div>
        <!-- DENAH -->
        <div class="denah-section">
            <div class="denah-header">
                <h2 style="font-size: 20px;">Denah Meja</h2>
                <div class="legend">
                    <div class="legend-item"><div class="dot" style="background: var(--green);"></div> Tersedia</div>
                    <div class="legend-item"><div class="dot" style="background: var(--red);"></div> Terisi</div>
                    <div class="legend-item"><div class="dot" style="background: var(--yellow);"></div> Direservasi</div>
                </div>
            </div>

            <div class="table-grid">

@forelse($tables as $table)

<div class="meja-card
    {{ $table->status == 'available' ? 'tersedia' : '' }}
    {{ $table->status == 'occupied' ? 'terisi' : '' }}
    {{ $table->status == 'reserved' ? 'direservasi' : '' }}">

    <span class="meja-id">
        {{ $table->table_number }}
    </span>

    @if($table->status == 'available')
        <div class="status-pill pill-tersedia">
            Tersedia
        </div>
    @elseif($table->status == 'occupied')
        <div class="status-pill pill-terisi">
            Terisi
        </div>
    @else
        <div class="status-pill pill-direservasi">
            Direservasi
        </div>
    @endif

    <div class="meja-info">
        <i class="bi bi-people"></i>
        {{ $table->capacity }} Kursi
    </div>

</div>

@empty

<div style="grid-column:1/-1;text-align:center;padding:40px;">
    Belum ada data meja
</div>

@endforelse

</div>