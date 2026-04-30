@extends('layouts.dashboard')
@section('title', 'Dashboard Owner')

@section('extra-css')
<style>
   .topbar {
    position: relative; /* penting */
    margin-bottom: 32px;
}

/* LEFT */
.topbar-left {
    max-width: 520px;
}

.topbar-left h1 {
    font-family: 'DM Serif Display', serif;
    font-size: 32px;
    font-weight: 400;
    color: var(--text);
    line-height: 1.15;
}

.topbar-left p {
    font-size: 13px;
    color: var(--muted);
    margin-top: 6px;
}


.topbar-right {
    position: absolute;   
    top: 0;               
    right: 0;             

    display: flex;
    align-items: center;
    gap: 12px;
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: 12px;
    padding: 10px 16px;
}
/* TEXT */
.topbar-right .resto-name {
    font-size: 13px;
    font-weight: 700;
    color: var(--text);
    text-align: right;
}

.topbar-right .resto-role {
    font-size: 11px;
    color: var(--muted);
    text-align: right;
}

/* AVATAR */
.topbar-avatar {
    width: 38px;
    height: 38px;
    border-radius: 50%;
    background: var(--primary);
    color: #fff;
    font-size: 13px;
    font-weight: 700;
    display: flex;
    align-items: center;
    justify-content: center;
}
    /* STATS ROW */
    .stats-row {
        display: grid;
        grid-template-columns: 1fr 1fr 1.3fr;
        gap: 16px;
        margin-bottom: 28px;
    }
    .stat-card {
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: 14px;
        padding: 20px 22px;
    }
    .stat-card.prime {
        background: var(--primary);
        border-color: var(--primary);
        color: #fff;
        display: flex; align-items: flex-start; justify-content: space-between;
    }
    .stat-label { font-size: 11px; color: var(--muted); font-weight: 600; letter-spacing: .5px; text-transform: uppercase; }
    .stat-value { font-size: 34px; font-weight: 800; color: var(--text); line-height: 1.1; margin: 6px 0 4px; }
    .stat-sub   { font-size: 12px; color: var(--muted); }
    .stat-trend { font-size: 12px; font-weight: 600; margin-top: 6px; }
    .stat-trend.up   { color: var(--success); }
    .stat-trend.down { color: var(--danger); }

    .prime-icon {
        width: 44px; height: 44px; border-radius: 12px;
        background: rgba(255,255,255,.2);
        display: flex; align-items: center; justify-content: center;
        font-size: 22px; color: #fff;
        flex-shrink: 0;
    }
    .prime h3 { font-size: 15px; font-weight: 700; color: #fff; margin-bottom: 6px; }
    .prime p  { font-size: 12px; color: rgba(255,255,255,.8); line-height: 1.5; }

    /* FLOOR STATUS */
    .section-title-row {
        display: flex; justify-content: space-between; align-items: center;
        margin-bottom: 14px;
    }
    .section-h { font-size: 16px; font-weight: 700; color: var(--text); }
    .section-sub { font-size: 12px; color: var(--muted); margin-top: 1px; }
    .legend { display: flex; gap: 14px; align-items: center; }
    .legend-dot { width: 8px; height: 8px; border-radius: 50%; display: inline-block; margin-right: 4px; }
    .legend span { font-size: 12px; color: var(--muted); display: flex; align-items: center; }

    .floor-grid {
        display: grid;
        grid-template-columns: repeat(6, 1fr);
        gap: 12px;
        margin-bottom: 28px;
    }
    .table-card {
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: 12px;
        padding: 16px 10px 12px;
        text-align: center;
        transition: box-shadow .2s;
    }
    .table-card:hover { box-shadow: 0 4px 14px rgba(0,0,0,.06); }
    .table-icon {
        width: 42px; height: 42px; border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        font-size: 20px; margin: 0 auto 8px;
    }
    .icon-available { background: #F0F7FF; color: #4285F4; }
    .icon-reserved  { background: #FFF8E8; color: #D4800A; }
    .icon-occupied  { background: #FFF0EE; color: var(--danger); }
    .table-name  { font-size: 13px; font-weight: 700; color: var(--text); }
    .table-badge { font-size: 10px; font-weight: 700; margin-top: 4px; display: inline-block; }
    .badge-available { color: #4285F4; }
    .badge-reserved  { color: var(--warning); }
    .badge-occupied  { color: var(--danger); }

    /* RESERVATIONS TABLE */
    .res-section { background: var(--white); border: 1px solid var(--border); border-radius: 14px; overflow: hidden; margin-bottom: 28px; }
    .res-header {
        display: flex; justify-content: space-between; align-items: center;
        padding: 16px 22px; border-bottom: 1px solid var(--border);
    }
    .view-all { font-size: 13px; font-weight: 600; color: var(--primary); text-decoration: none; display: flex; align-items: center; gap: 4px; }
    .view-all:hover { text-decoration: underline; }

    table { width: 100%; border-collapse: collapse; }
    thead th {
        font-size: 11.5px; color: var(--muted); font-weight: 600; letter-spacing: .4px;
        padding: 11px 22px; text-align: left; text-transform: uppercase;
        border-bottom: 1px solid var(--border); background: #FAFAF8;
    }
    tbody td { padding: 14px 22px; font-size: 13.5px; border-bottom: 1px solid var(--border); vertical-align: middle; }
    tbody tr:last-child td { border-bottom: none; }
    tbody tr:hover { background: #FAFAF8; }

    .cust-avatar {
        width: 32px; height: 32px; border-radius: 50%;
        font-size: 12px; font-weight: 700; color: #fff;
        display: inline-flex; align-items: center; justify-content: center;
        margin-right: 10px; vertical-align: middle; flex-shrink: 0;
    }
    .cust-name { font-weight: 600; }

    .status-pill { display: inline-block; border-radius: 20px; padding: 4px 12px; font-size: 11px; font-weight: 700; }
    .pill-confirmed { background: #EDFAF3; color: var(--success); }
    .pill-pending   { background: #EAF3FF; color: #2563EB; }
    .pill-cancelled { background: #FFF0EE; color: var(--danger); }

    /* FOOTER */
    .site-footer {
        border-top: 1px solid var(--border);
        padding: 20px 0;
        margin-top: 10px;
        display: flex; justify-content: space-between; align-items: flex-start;
        font-size: 12px; color: var(--muted);
    }
    .footer-brand { font-weight: 700; color: var(--text); font-size: 14px; margin-bottom: 4px; }
    .footer-links { display: flex; gap: 20px; }
    .footer-links a { color: var(--muted); text-decoration: none; }
    .footer-links a:hover { color: var(--primary); }
</style>
@endsection

@section('content')

{{-- TOPBAR --}}
<div class="topbar">
    <div class="topbar-left">
        <h1>Welcome back, Chef.</h1>
        <p>Your culinary empire is humming. Here's a look at today's flow and reservations across your floor.</p>
    </div>
    <div class="topbar-right">
        <div>
            <div class="resto-name">The Culinary Canvas</div>
            <div class="resto-role">Admin Profile</div>
        </div>
        <div class="topbar-avatar">TC</div>
    </div>
</div>

{{-- STAT CARDS --}}
<div class="stats-row">
    <div class="stat-card">
        <div class="stat-label">Daily Volume</div>
        <div class="stat-value">{{ $dailyVolume ?? 42 }}</div>
        <div class="stat-sub">Total Reservasi Hari Ini</div>
        <div class="stat-trend up">↑ +13% vs yesterday</div>
    </div>
    <div class="stat-card">
        <div class="stat-label">Monthly Revenue</div>
        <div class="stat-value" style="font-size:26px;">Rp {{ number_format($monthlyRevenue ?? 142500000, 0, ',', '.') }}</div>
        <div class="stat-sub">Pendapatan Bulan Ini</div>
        <div class="stat-trend down">↓ -4% vs last month</div>
    </div>
    <div class="stat-card prime">
        <div>
            <div style="font-size:11px;font-weight:700;color:rgba(255,255,255,.7);letter-spacing:.5px;text-transform:uppercase;margin-bottom:8px;">Prime Service Hours</div>
            <h3>Your peak performance<br>starts in 45 minutes.</h3>
            <p>Kitchen is prepped.</p>
        </div>
        <div class="prime-icon"><i class="bi bi-star-fill"></i></div>
    </div>
</div>

{{-- LIVE FLOOR STATUS --}}
<div class="section-title-row">
    <div>
        <div class="section-h">Live Floor Status</div>
        <div class="section-sub">Real-time table occupancy overview.</div>
    </div>
    <div class="legend">
        <span><span class="legend-dot" style="background:#4285F4;"></span> Available</span>
        <span><span class="legend-dot" style="background:var(--warning);"></span> Reserved</span>
        <span><span class="legend-dot" style="background:var(--danger);"></span> Occupied</span>
    </div>
</div>

<div class="floor-grid">
    @php
    $tables = $tables ?? [
        ['name' => 'Meja 1', 'status' => 'available', 'icon' => 'bi-person'],
        ['name' => 'Meja 2', 'status' => 'reserved',  'icon' => 'bi-people'],
        ['name' => 'Meja 3', 'status' => 'occupied',  'icon' => 'bi-people-fill'],
        ['name' => 'Meja 4', 'status' => 'available', 'icon' => 'bi-person'],
        ['name' => 'Meja 5', 'status' => 'occupied',  'icon' => 'bi-people-fill'],
        ['name' => 'Meja 6', 'status' => 'available', 'icon' => 'bi-person'],
    ];
    @endphp

    @foreach($tables as $t)
    @php
        $st = is_array($t) ? $t['status'] : $t->status;
        $nm = is_array($t) ? $t['name']   : $t->nama;
        $ic = is_array($t) ? $t['icon']   : 'bi-person';
        $iconClass  = $st === 'available' ? 'icon-available' : ($st === 'reserved' ? 'icon-reserved' : 'icon-occupied');
        $badgeClass = $st === 'available' ? 'badge-available' : ($st === 'reserved' ? 'badge-reserved' : 'badge-occupied');
        $badgeText  = strtoupper($st);
    @endphp
    <div class="table-card">
        <div class="table-icon {{ $iconClass }}"><i class="bi {{ $ic }}"></i></div>
        <div class="table-name">{{ $nm }}</div>
        <div class="table-badge {{ $badgeClass }}">{{ $badgeText }}</div>
    </div>
    @endforeach
</div>

{{-- RECENT RESERVATIONS --}}
<div class="res-section">
    <div class="res-header">
        <div>
            <div class="section-h">Recent Reservations</div>
        </div>
        <a href="#" class="view-all">View Full Schedule →</a>
    </div>
    <table>
        <thead>
            <tr>
                <th>Customer Name</th>
                <th>Time</th>
                <th>Party Size</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @php
        $avatarColors = ['#E8714A','#2A8C55','#4285F4','#9B59B6','#D4800A','#C0392B'];
        $reservations = $reservations ?? [
            ['initials'=>'AP','name'=>'Aditya Pratama', 'time'=>'19:30 PM','party'=>'4 People','status'=>'confirmed','color'=>'#E8714A'],
            ['initials'=>'SR','name'=>'Siti Rahma',     'time'=>'20:00 PM','party'=>'2 People','status'=>'pending',  'color'=>'#2A8C55'],
            ['initials'=>'BK','name'=>'Budi Kusuma',    'time'=>'18:15 PM','party'=>'6 People','status'=>'cancelled','color'=>'#4285F4'],
            ['initials'=>'DW','name'=>'Dewi Wijaya',    'time'=>'21:00 PM','party'=>'4 People','status'=>'confirmed','color'=>'#9B59B6'],
        ];
        @endphp

        @foreach($reservations as $r)
        @php
            $isArr = is_array($r);
            $status   = $isArr ? $r['status']   : $r->status;
            $name     = $isArr ? $r['name']      : $r->customer->name;
            $initials = $isArr ? $r['initials']  : strtoupper(substr($name, 0, 2));
            $time     = $isArr ? $r['time']      : \Carbon\Carbon::parse($r->waktu)->format('H:i') . ' PM';
            $party    = $isArr ? $r['party']     : $r->jumlah_orang . ' People';
            $color    = $isArr ? $r['color']     : $avatarColors[array_rand($avatarColors)];
            $pillClass = match($status) {
                'confirmed' => 'pill-confirmed',
                'pending'   => 'pill-pending',
                'cancelled' => 'pill-cancelled',
                default     => 'pill-pending'
            };
        @endphp
        <tr>
            <td style="display:flex;align-items:center;">
                <span class="cust-avatar" style="background:{{ $color }}">{{ $initials }}</span>
                <span class="cust-name">{{ $name }}</span>
            </td>
            <td>{{ $time }}</td>
            <td>{{ $party }}</td>
            <td><span class="status-pill {{ $pillClass }}">{{ strtoupper($status) }}</span></td>
            <td>
                <a href="#" style="color:var(--primary);font-size:13px;font-weight:600;text-decoration:none;">Detail</a>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>

{{-- FOOTER --}}
<footer class="site-footer">
    <div>
        <div class="footer-brand">RestoBook</div>
        <div>©2024 RestoBook. Cultivating culinary excellence for MSMEs.</div>
    </div>
    <div class="footer-links">
        <a href="#">Privacy Policy</a>
        <a href="#">Terms of Service</a>
        <a href="#">Partner With Us</a>
        <a href="#">Contact Support</a>
    </div>
</footer>

@endsection