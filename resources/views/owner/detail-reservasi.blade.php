<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Reservasi</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Plus Jakarta Sans',sans-serif;
        }

        body{
            background:#f8f8f8;
            min-height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
            padding:40px;
        }

        .card{
            width:100%;
            max-width:700px;
            background:white;
            border-radius:24px;
            padding:35px;
            box-shadow:0 10px 30px rgba(0,0,0,.06);
        }

        .title{
            font-size:32px;
            font-weight:800;
            color:#1f1f1f;
            margin-bottom:10px;
        }

        .subtitle{
            color:#7b7b7b;
            margin-bottom:30px;
        }

        .info-group{
            display:grid;
            grid-template-columns:180px 1fr;
            gap:15px;
            padding:18px 0;
            border-bottom:1px solid #eee;
        }

        .label{
            color:#777;
            font-weight:600;
        }

        .value{
            color:#222;
            font-weight:700;
        }

        .status{
            display:inline-block;
            padding:8px 16px;
            border-radius:999px;
            background:#f8d7c1;
            color:#BC4B09;
            font-weight:700;
        }

        .actions{
            margin-top:30px;
            display:flex;
            gap:12px;
        }

        .btn{
            text-decoration:none;
            border:none;
            padding:14px 24px;
            border-radius:12px;
            font-weight:700;
            cursor:pointer;
        }

        .btn-back{
            background:#ececec;
            color:#333;
        }

        .btn-primary{
            background:#BC4B09;
            color:white;
        }
    </style>
</head>
<body>

<div class="card">

    <h1 class="title">Detail Reservasi</h1>
    <p class="subtitle">
        Informasi lengkap reservasi pelanggan.
    </p>

    <div class="info-group">
        <div class="label">ID Reservasi</div>
        <div class="value">#{{ $reservation->id }}</div>
    </div>

    <div class="info-group">
        <div class="label">Nama Customer</div>
<div class="value">
    {{ $reservation->user->name ?? 'Tidak ditemukan' }}
</div>
    </div>

    <div class="info-group">
        <div class="label">Nomor Meja</div>
        <div class="value">Meja {{ $reservation->table_id }}</div>
    </div>

    <div class="info-group">
        <div class="label">Tanggal Reservasi</div>
        <div class="value">{{ $reservation->reservation_date }}</div>
    </div>

    <div class="info-group">
        <div class="label">Jam Reservasi</div>
        <div class="value">{{ $reservation->reservation_time }}</div>
    </div>

    <div class="info-group">
        <div class="label">Jumlah Tamu</div>
        <div class="value">{{ $reservation->num_guests }} Orang</div>
    </div>

    <div class="info-group">
        <div class="label">Status</div>
        <div class="value">
            <span class="status">
                @if($reservation->status == 'pending') Menunggu Pembayaran
                @elseif($reservation->status == 'paid' || $reservation->status == 'approved') Terkonfirmasi
                @elseif($reservation->status == 'completed') Hadir
                @elseif($reservation->status == 'cancelled') Tidak Hadir
                @elseif($reservation->status == 'rejected') Dibatalkan/Ditolak
                @else {{ ucfirst($reservation->status) }}
                @endif
            </span>
        </div>
    </div>

    <div class="actions">
        <a href="{{ request('from') == 'dashboard' ? route('owner.dashboard') : route('owner.reservasi') }}" class="btn btn-back" style="text-decoration:none; padding:10px 20px;">
            ← Kembali
        </a>

        @if($reservation->status == 'paid' || $reservation->status == 'approved')
            <form action="{{ route('owner.reservasi.tidak-hadir', $reservation->id) }}" method="POST" style="display:inline;">
                @csrf @method('PATCH')
                <button type="submit" class="btn" style="background:#dc2626; color:white;">Tidak Hadir</button>
            </form>
            <form action="{{ route('owner.reservasi.hadir', $reservation->id) }}" method="POST" style="display:inline;">
                @csrf @method('PATCH')
                <button type="submit" class="btn" style="background:#16a34a; color:white;">Hadir</button>
            </form>
        @endif
    </div>

</div>

</body>
</html>