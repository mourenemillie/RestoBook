@extends('layouts.dashboard')

@section('title', 'Reservasi')

@section('content')

<!-- HEADER -->
<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
    <h2 style="margin:0;">Reservasi</h2>

    <button style="
        background:#E8714A;
        color:#fff;
        border:none;
        padding:10px 16px;
        border-radius:10px;
        font-size:13px;
        cursor:pointer;
    ">
        + Reservasi Baru
    </button>
</div>

<div style="display:flex; gap:16px; margin-bottom:24px;">

    <!-- TAMU -->
    <div style="flex:1; background:#fff; border-radius:16px; padding:16px; box-shadow:0 10px 30px rgba(0,0,0,0.05);">
        
        <div style="display:flex; justify-content:space-between; align-items:center;">
            
            <!-- ICON -->
            <div style="
                width:40px; height:40px;
                border-radius:12px;
                background:#EEF3FF;
                display:flex; align-items:center; justify-content:center;
            ">
                <i class="bi bi-people-fill" style="color:#4A6CF7;"></i>
            </div>

            <!-- BADGE -->
            <span style="
                background:#E6F7EC;
                color:#2A8C55;
                padding:4px 8px;
                border-radius:10px;
                font-size:11px;
                font-weight:600;
            ">
                ↑ 12%
            </span>

        </div>

        <h2 style="margin:12px 0 4px;">142</h2>
        <div style="font-size:12px; color:#999;">Total Tamu Hari Ini</div>
    </div>


    <!-- RESERVASI -->
    <div style="flex:1; background:#fff; border-radius:16px; padding:16px; box-shadow:0 10px 30px rgba(0,0,0,0.05);">
        
        <div style="display:flex; justify-content:space-between;">
            
            <div style="
                width:40px; height:40px;
                border-radius:12px;
                background:#FFF1EA;
                display:flex; align-items:center; justify-content:center;
            ">
               <i class="bi bi-calendar2-check-fill" style="color:#E8714A;"></i>
            </div>

            <span style="
                background:#E6F7EC;
                color:#2A8C55;
                padding:4px 8px;
                border-radius:10px;
                font-size:11px;
                font-weight:600;
            ">
                ↑ 5%
            </span>

        </div>

        <h2 style="margin:12px 0 4px;">28</h2>
        <div style="font-size:12px; color:#999;">Reservasi Aktif</div>
    </div>


    <!-- MEJA -->
    <div style="flex:1; background:#fff; border-radius:16px; padding:16px; box-shadow:0 10px 30px rgba(0,0,0,0.05);">
        
        <div style="display:flex; justify-content:space-between;">
            
            <div style="
                width:40px; height:40px;
                border-radius:12px;
                background:#E8F7F0;
                display:flex; align-items:center; justify-content:center;
            ">
                <i class="bi bi-diagram-3-fill" style="color:#2A8C55;"></i>
            </div>

            <span style="
                background:#F5F5F5;
                color:#666;
                padding:4px 8px;
                border-radius:10px;
                font-size:11px;
                font-weight:600;
            ">
                Stabil
            </span>

        </div>

        <h2 style="margin:12px 0 4px;">15/40</h2>
        <div style="font-size:12px; color:#999;">Meja Tersedia</div>
    </div>


    <!-- BATAL -->
    <div style="flex:1; background:#fff; border-radius:16px; padding:16px; box-shadow:0 10px 30px rgba(0,0,0,0.05);">
        
        <div style="display:flex; justify-content:space-between;">
            
            <div style="
                width:40px; height:40px;
                border-radius:12px;
                background:#FFECEC;
                display:flex; align-items:center; justify-content:center;
            ">
                <i class="bi bi-x-circle-fill" style="color:#E74C3C;"></i>
            </div>

            <span style="
                background:#FFECEC;
                color:#E74C3C;
                padding:4px 8px;
                border-radius:10px;
                font-size:11px;
                font-weight:600;
            ">
                ↓ 2%
            </span>

        </div>

        <h2 style="margin:12px 0 4px;">3</h2>
        <div style="font-size:12px; color:#999;">Batal Hari Ini</div>
    </div>

</div>

    <!-- HEADER TABEL -->
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:16px;">
        <h3 style="margin:0;">Reservasi Terbaru</h3>

        <div style="display:flex; gap:10px;">
            <input type="text" placeholder="Cari reservasi..."
                style="padding:8px 12px; border-radius:10px; border:1px solid #ddd; font-size:13px;">

            <button style="
                padding:8px 14px;
                border:none;
                border-radius:10px;
                background:#F5F5F5;
                cursor:pointer;
            ">
                Filter
            </button>

            <a href="#" style="color:#E8714A; font-weight:600; font-size:13px;">
                Lihat Semua
            </a>
        </div>
    </div>

    <!-- TABLE -->
    <table width="100%" style="border-collapse:collapse; font-size:13px;">
        <thead style="color:#999;">
            <tr>
                <th align="left">Nama Pelanggan</th>
                <th align="left">Waktu</th>
                <th align="left">Tamu</th>
                <th align="left">Status</th>
                <th align="right">Aksi</th>
            </tr>
        </thead>

        <tbody>

        @foreach ($reservations as $r)
        <tr style="border-top:1px solid #eee;">
            <td style="padding:12px 0;">
                <div style="display:flex; align-items:center; gap:10px;">
                    <div style="
                        width:32px; height:32px;
                        border-radius:50%;
                        background:#F5F5F5;
                        display:flex; align-items:center; justify-content:center;
                        font-weight:600;
                    ">
                        {{ substr($r['name'],0,1) }}
                    </div>

                    <div>
                        <div style="font-weight:600;">{{ $r['name'] }}</div>
                        <div style="font-size:11px; color:#999;">#RES-00{{ $loop->index+1 }}</div>
                    </div>
                </div>
            </td>

            <td>{{ $r['time'] }}</td>
            <td>{{ $r['guest'] }}</td>

            <td>
                <span style="
                    padding:4px 10px;
                    border-radius:12px;
                    font-size:11px;
                    font-weight:600;

                    @if($r['status'] == 'Menunggu')
                        background:#FFE8D6; color:#C8541A;
                    @elseif($r['status'] == 'Dikonfirmasi')
                        background:#E6F7EC; color:#2A8C55;
                    @else
                        background:#EEE; color:#666;
                    @endif
                ">
                    {{ $r['status'] }}
                </span>
            </td>

            <td align="right">⋮</td>
        </tr>
        @endforeach

        </tbody>
    </table>

    <!-- FOOTER -->
    <div style="margin-top:16px; font-size:12px; color:#999;">
        
    </div><div style="display:flex; justify-content:space-between; align-items:center; margin-top:16px;">

    <!-- INFO -->
    <div style="font-size:12px; color:#999;">
       Menampilkan {{ count($reservations) }} data
    </div>

    <!-- PAGINATION -->
    <div style="display:flex; gap:8px; align-items:center;">

        <!-- PREV -->
        <button style="
            width:32px; height:32px;
            border-radius:8px;
            border:1px solid #eee;
            background:#fff;
            cursor:pointer;
        ">
            ‹
        </button>

        <!-- ACTIVE -->
        <button style="
            width:32px; height:32px;
            border-radius:8px;
            border:none;
            background:#C8541A;
            color:#fff;
            font-weight:600;
        ">
            1
        </button>

        <!-- PAGE -->
        <button style="
            width:32px; height:32px;
            border-radius:8px;
            border:1px solid #eee;
            background:#fff;
            cursor:pointer;
        ">
            2
        </button>

        <button style="
            width:32px; height:32px;
            border-radius:8px;
            border:1px solid #eee;
            background:#fff;
            cursor:pointer;
        ">
            3
        </button>

        <!-- NEXT -->
        <button style="
            width:32px; height:32px;
            border-radius:8px;
            border:1px solid #eee;
            background:#fff;
            cursor:pointer;
        ">
            ›
        </button>

    </div>

</div>

</div>

@endsection