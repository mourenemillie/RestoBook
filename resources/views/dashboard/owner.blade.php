@extends('layouts.dashboard')
@section('title', 'Dashboard Owner')

@section('extra-css')
<style>
    /* TOPBAR */
    .topbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 24px;
    }
    .topbar-left h1 {
        font-size: 24px; font-weight: 800; color: var(--text);
    }
    .topbar-left p { font-size: 13px; color: var(--muted); margin-top: 3px; }
    .topbar-actions { display: flex; align-items: center; gap: 12px; }
    .btn-bell {
        width: 36px; height: 36px; border-radius: 50%;
        background: var(--white); border: 1px solid var(--border);
        display: flex; align-items: center; justify-content: center;
        color: var(--muted); font-size: 16px; cursor: pointer;
    }
    .btn-new {
        background: var(--primary); color: #fff;
        border: none; border-radius: 8px;
        padding: 9px 16px; font-size: 13px; font-weight: 700;
        cursor: pointer; display: flex; align-items: center; gap: 6px;
        font-family: inherit;
    }
    .btn-new:hover { background: #cf6040; }

    /* STAT CARDS */
    .stat-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 14px;
        margin-bottom: 22px;
    }
    .stat-card {
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: 14px;
        padding: 18px 20px;
    }
    .stat-top {
        display: flex; justify-content: space-between; align-items: flex-start;
        margin-bottom: 10px;
    }
    .stat-icon-wrap {
        width: 38px; height: 38px; border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        font-size: 18px;
    }
    .ic-blue   { background: #EAF1FF; color: #4285F4; }
    .ic-orange { background: #FFF0E8; color: var(--primary); }
    .ic-green  { background: #EAFFF3; color: #2ECC71; }
    .ic-red    { background: #FFF0EE; color: #E74C3C; }

    .stat-badge {
        font-size: 11px; font-weight: 700;
        padding: 3px 8px; border-radius: 20px;
        display: flex; align-items: center; gap: 3px;
    }
    .badge-up   { background: #EAFFF3; color: #2ECC71; }
    .badge-down { background: #FFF0EE; color: #E74C3C; }
    .badge-neu  { background: #F0F0F0; color: var(--muted); }

    .stat-value { font-size: 28px; font-weight: 800; color: var(--text); line-height: 1.1; }
    .stat-value span { font-size: 14px; font-weight: 500; color: var(--muted); }
    .stat-label { font-size: 12px; color: var(--muted); font-weight: 500; margin-top: 4px; }

    /* MIDDLE ROW */
    .mid-row {
        display: grid;
        grid-template-columns: 1fr 280px;
        gap: 16px;
        margin-bottom: 20px;
    }

    /* SECTION CARD */
    .sec-card {
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: 14px;
        overflow: hidden;
    }
    .sec-header {
        display: flex; justify-content: space-between; align-items: center;
        padding: 16px 20px;
        border-bottom: 1px solid var(--border);
    }
    .sec-title { font-size: 15px; font-weight: 700; color: var(--text); }
    .sec-link  { font-size: 13px; color: var(--primary); font-weight: 600; text-decoration: none; }
    .sec-link:hover { text-decoration: underline; }

    /* RESERVASI TABLE */
    table { width: 100%; border-collapse: collapse; }
    thead th {
        font-size: 11.5px; color: var(--muted); font-weight: 600;
        padding: 10px 20px; text-align: left;
        background: #FAFAF8; border-bottom: 1px solid var(--border);
    }
    tbody td { padding: 13px 20px; font-size: 13px; border-bottom: 1px solid var(--border); vertical-align: middle; }
    tbody tr:last-child td { border-bottom: none; }
    tbody tr:hover { background: #FAFAF8; }

    .cust-av {
        width: 30px; height: 30px; border-radius: 50%;
        color: #fff; font-size: 12px; font-weight: 700;
        display: inline-flex; align-items: center; justify-content: center;
        margin-right: 8px; vertical-align: middle;
    }
    .cust-name { font-weight: 600; }

    .pill { display: inline-block; border-radius: 20px; padding: 4px 11px; font-size: 11px; font-weight: 700; }
    .pill-menunggu    { background: #FFF8E8; color: #D4800A; }
    .pill-dikonfirmasi{ background: #EAFFF3; color: #2ECC71; }
    .pill-selesai     { background: #EAF1FF; color: #4285F4; }
    .pill-dibatalkan  { background: #FFF0EE; color: #E74C3C; }

    .btn-dots { background: none; border: none; font-size: 18px; color: var(--muted); cursor: pointer; padding: 2px 6px; }

    /* STATUS MEJA */
    .meja-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 10px;
        padding: 16px 20px;
    }
    .meja-item {
        border-radius: 10px;
        padding: 10px;
        text-align: center;
        border: 1px solid var(--border);
    }
    .meja-item.kosong  { background: #F7FAF7; border-color: #D0EBD0; }
    .meja-item.terisi  { background: #FFF8F0; border-color: #FFD6B0; }
    .meja-item.dipesan { background: #FFF0EE; border-color: #FFBFB8; }

    .meja-id   { font-size: 13px; font-weight: 800; color: var(--text); }
    .meja-stat { font-size: 10px; font-weight: 600; margin-top: 2px; }
    .meja-item.kosong  .meja-stat { color: #2ECC71; }
    .meja-item.terisi  .meja-stat { color: #D4800A; }
    .meja-item.dipesan .meja-stat { color: #E74C3C; }

    .meja-legend {
        display: flex; gap: 14px; padding: 0 20px 14px;
        font-size: 12px; color: var(--muted);
    }
    .meja-legend span { display: flex; align-items: center; gap: 5px; }
    .leg-dot { width: 8px; height: 8px; border-radius: 50%; }

    .sec-refresh {
        background: none; border: none; color: var(--muted);
        font-size: 16px; cursor: pointer;
        display: flex; align-items: center;
    }

    /* BAR CHART */
    .chart-section {
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: 14px;
        padding: 20px 24px 16px;
        margin-bottom: 24px;
    }
    .chart-title { font-size: 15px; font-weight: 700; color: var(--text); margin-bottom: 20px; }
    .chart-wrap  { display: flex; align-items: flex-end; gap: 14px; height: 140px; }
    .bar-col     { display: flex; flex-direction: column; align-items: center; gap: 6px; flex: 1; }
    .bar {
        width: 100%; border-radius: 6px 6px 0 0;
        transition: opacity .2s;
        min-height: 8px;
    }
    .bar:hover { opacity: .8; }
    .bar-label { font-size: 11.5px; color: var(--muted); font-weight: 500; }

    /* warna bar sesuai screenshot (coklat muda-tua) */
    .bar-0 { background: #E8C4A8; }
    .bar-1 { background: #D4A882; }
    .bar-2 { background: #C8916A; }
    .bar-3 { background: #B87A50; }
    .bar-4 { background: #A05C30; } /* tertinggi = paling gelap */
    .bar-5 { background: #C8916A; }
    .bar-6 { background: #D4A882; }
</style>
@endsection

@section('content')

{{-- TOPBAR --}}
<div class="topbar">
    <div class="topbar-left">
        <h1>Selamat Datang, Owner!</h1>
        <p>Berikut adalah ringkasan aktivitas restoran Anda hari ini.</p>
    </div>
    <div class="topbar-actions">
        <button class="btn-bell"><i class="bi bi-bell"></i></button>
        <button class="btn-new"><i class="bi bi-plus"></i> Reservasi Baru</button>
    </div>
</div>

{{-- STAT CARDS --}}
<div class="stat-grid">
    <div class="stat-card">
        <div class="stat-top">
            <div class="stat-icon-wrap ic-blue"><i class="bi bi-people-fill"></i></div>
            <span class="stat-badge badge-up">↑ 12%</span>
        </div>
        <div class="stat-value">{{ $totalTamu ?? 142 }}</div>
        <div class="stat-label">Total Tamu Hari Ini</div>
    </div>
    <div class="stat-card">
        <div class="stat-top">
            <div class="stat-icon-wrap ic-orange"><i class="bi bi-calendar-check-fill"></i></div>
            <span class="stat-badge badge-up">↑ 5%</span>
        </div>
        <div class="stat-value">{{ $reservasiAktif ?? 28 }}</div>
        <div class="stat-label">Reservasi Aktif</div>
    </div>
    <div class="stat-card">
        <div class="stat-top">
            <div class="stat-icon-wrap ic-green"><i class="bi bi-diagram-3-fill"></i></div>
            <span class="stat-badge badge-neu">Stabil</span>
        </div>
        <div class="stat-value">
            {{ $mejaTersedia ?? 15 }}<span>/{{ $totalMeja ?? 40 }}</span>
        </div>
        <div class="stat-label">Meja Tersedia</div>
    </div>
    <div class="stat-card">
        <div class="stat-top">
            <div class="stat-icon-wrap ic-red"><i class="bi bi-x-circle-fill"></i></div>
            <span class="stat-badge badge-down">↓ 2%</span>
        </div>
        <div class="stat-value">{{ $batalHariIni ?? 3 }}</div>
        <div class="stat-label">Batal Hari Ini</div>
    </div>
</div>

{{-- MIDDLE ROW: RESERVASI + STATUS MEJA --}}
<div class="mid-row">

    {{-- RESERVASI TERBARU --}}
    <div class="card">
    <div class="card-header" style="display:flex; justify-content:space-between; align-items:center;">
        <h3>Reservasi Terbaru</h3>

        <div style="display:flex; gap:10px;">
            

            <a href="#" style="color:#C8541A; font-weight:600;">Lihat Semua</a>
        </div>
    </div>

    <table style="width:100%; border-collapse:collapse; margin-top:16px;">
        <thead>
            <tr style="text-align:left; font-size:12px; color:#999;">
                <th>Nama Pelanggan</th>
                <th>Waktu</th>
                <th>Tamu</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($reservations as $r)
<tr>
    <td>{{ $r['name'] }}</td>
    <td>{{ $r['time'] }}</td>
    <td>{{ $r['guest'] }}</td>
    <td>{{ $r['status'] }}</td>
    <td>⋮</td>
</tr>
@endforeach
        </tbody>
    </table>

    <div style="margin-top:12px; font-size:12px; color:#999;">
        Menampilkan 1–3 dari 48 reservasi
    </div>
</div>

    {{-- STATUS MEJA --}}
    <div style="
    background:#fff;
    border-radius:16px;
    padding:20px;
    box-shadow:0 8px 24px rgba(0,0,0,0.05);
">

    <div style="display:flex; justify-content:space-between; align-items:center;">
        <h3 style="margin:0;">Status Meja</h3>
        <span style="color:#999;">⟳</span>
    </div>

    <div style="display:flex; flex-wrap:wrap; gap:12px; margin-top:16px;">

        <div style="width:50px; height:50px; border-radius:50%; background:#F5F5F5; display:flex; align-items:center; justify-content:center;">M1</div>

        <div style="width:50px; height:50px; border-radius:50%; background:#E6F7EC; color:#2A8C55; display:flex; align-items:center; justify-content:center;">M2</div>

        <div style="width:50px; height:50px; border-radius:50%; background:#FFE8D6; color:#C8541A; display:flex; align-items:center; justify-content:center;">M3</div>

        <div style="width:50px; height:50px; border-radius:50%; background:#F5F5F5; display:flex; align-items:center; justify-content:center;">M4</div>

        <div style="width:50px; height:50px; border-radius:50%; background:#F5F5F5; display:flex; align-items:center; justify-content:center;">M5</div>

        <div style="width:50px; height:50px; border-radius:50%; background:#E6F7EC; color:#2A8C55; display:flex; align-items:center; justify-content:center;">M6</div>

    </div>

    <div style="margin-top:16px; font-size:12px; color:#999;">
        <span style="color:#aaa;">●</span> Kosong &nbsp;&nbsp;
        <span style="color:#2A8C55;">●</span> Terisi &nbsp;&nbsp;
        <span style="color:#C8541A;">●</span> Dipesan
    </div>

</div>
{{-- BAR CHART MINGGUAN --}}
<div class="chart-section">
    <div class="chart-title">Tren Reservasi Mingguan</div>
    @php
    $chartData = $chartData ?? [
        ['label'=>'Sen','val'=>35],
        ['label'=>'Sel','val'=>55],
        ['label'=>'Rab','val'=>70],
        ['label'=>'Kam','val'=>90],
        ['label'=>'Jum','val'=>120],
        ['label'=>'Sab','val'=>100],
        ['label'=>'Min','val'=>65],
    ];
    $maxVal = max(array_column($chartData, 'val'));
    $colors = ['bar-0','bar-1','bar-2','bar-3','bar-4','bar-5','bar-6'];
    @endphp
    <div class="chart-wrap">
        @foreach($chartData as $i => $d)
        <div class="bar-col">
            <div class="bar {{ $colors[$i] }}"
                 style="height: {{ ($d['val'] / $maxVal) * 130 }}px;"
                 title="{{ $d['val'] }} reservasi"></div>
            <div class="bar-label">{{ $d['label'] }}</div>
        </div>
        @endforeach
    </div>
</div>

@endsection