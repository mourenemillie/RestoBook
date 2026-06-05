<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Meja</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root{
            --primary:#BC4B09;
            --bg-light:#FBF7F4;
            --white:#FFFFFF;
            --text-dark:#1A1A1A;
            --text-muted:#717171;
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
            border-radius:24px;
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

        input,
        select{
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
            color:var(--primary);
            text-decoration:none;
            font-weight:600;
        }
    </style>
</head>
<body>

<div class="container">

    <a href="{{ route('owner.kelola-meja') }}" class="back">
        ← Kembali
    </a>

    <div class="card">

        <h1 class="title">Tambah Meja</h1>

        <p class="subtitle">
            Tambahkan meja baru ke restoran Anda.
        </p>

        <form action="{{ route('owner.kelola-meja.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>Nomor Meja</label>
                <input type="text" name="table_number" required>
            </div>

            <div class="form-group">
                <label>Kapasitas</label>
                <input type="number" name="capacity" required>
            </div>

            <div class="form-group">
                <label>Status</label>
                <select name="status">
                    <option value="available">Tersedia</option>
                    <option value="occupied">Terisi</option>
                    <option value="reserved">Direservasi</option>
                </select>
            </div>

            <button type="submit" class="btn">
                Simpan Meja
            </button>

        </form>

    </div>

</div>

</body>
</html>