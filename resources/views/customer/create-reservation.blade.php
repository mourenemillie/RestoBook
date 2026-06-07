<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservasi - {{ $restaurant->name }}</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root{
            --primary:#BC4B09;
            --primary-light:#FFF2EB;
            --bg-light:#FBF7F4;
            --white:#FFFFFF;
            --text-dark:#1A1A1A;
            --text-muted:#717171;
            --radius-lg:24px;
            --radius-md:16px;
        }

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        body{
            font-family:'Plus Jakarta Sans',sans-serif;
            background:var(--bg-light);
            padding:40px;
        }

        .container{
            max-width:700px;
            margin:auto;
        }

        .card{
            background:var(--white);
            border-radius:var(--radius-lg);
            padding:32px;
            box-shadow:0 8px 30px rgba(0,0,0,.05);
        }

        .title{
            font-size:28px;
            font-weight:700;
            margin-bottom:8px;
        }

        .subtitle{
            color:var(--text-muted);
            margin-bottom:30px;
        }

        .form-group{
            margin-bottom:20px;
        }

        label{
            display:block;
            margin-bottom:8px;
            font-weight:600;
        }

        input{
            width:100%;
            padding:14px;
            border:1px solid #e5e5e5;
            border-radius:12px;
            font-family:inherit;
        }

        .btn{
            width:100%;
            border:none;
            background:var(--primary);
            color:white;
            padding:14px;
            border-radius:12px;
            font-weight:600;
            cursor:pointer;
        }

        .back{
            display:inline-block;
            margin-bottom:20px;
            text-decoration:none;
            color:var(--primary);
            font-weight:600;
        }
    </style>
</head>
<body>

<div class="container">

    <a href="{{ route('home') }}" class="back">
        ← Kembali
    </a>

    <div class="card">

        <h1 class="title">
            Reservasi Meja
        </h1>

        <p class="subtitle">
            {{ $restaurant->name }} • {{ $restaurant->address }}
        </p>

        <form action="{{ route('customer.reservations.store') }}" method="POST">
    @csrf

    <div class="form-group">
        <label>Tanggal Reservasi</label>
        <input type="date" name="reservation_date" required>
    </div>

    <div class="form-group">
        <label>Jam Reservasi</label>
        <input type="time" name="reservation_time" required>
    </div>

    <div class="form-group">
        <label>Jumlah Tamu</label>
        <input type="number" name="num_guests" min="1" required>
    </div>

    <button type="submit" class="btn">
        Reservasi Sekarang
    </button>

</form>

    </div>

</div>

</body>
</html>