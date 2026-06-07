<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Email - RestoBook</title>
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f3f4f6; display: flex; align-items: center; justify-content: center; height: 100vh; margin: 0; }
        .card { background: white; padding: 30px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); max-width: 400px; text-align: center; }
        .card h2 { margin-top: 0; color: #111827; }
        .card p { color: #4b5563; font-size: 15px; line-height: 1.5; }
        .btn { background: #1f2937; color: white; border: none; padding: 12px 20px; border-radius: 8px; cursor: pointer; width: 100%; font-size: 15px; margin-top: 15px; }
        .btn:hover { background: #374151; }
        .alert-success { background-color: #d1fae5; color: #065f46; padding: 12px; border-radius: 8px; margin-bottom: 15px; font-size: 14px; }
    </style>
</head>
<body>

<div class="card">
    <h2>Verifikasi Email Anda</h2>
    
    @if (session('message'))
        <div class="alert-success">
            {{ session('message') }}
        </div>
    @endif

    <p>Terima kasih telah mendaftar! Sebelum memulai, silakan verifikasi alamat email Anda dengan mengeklik tautan yang baru saja kami kirimkan ke email Anda.</p>
    <p>Jika Anda tidak menerima email tersebut, kami akan dengan senang hati mengirimkan yang lain.</p>

    <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button type="submit" class="btn">Kirim Ulang Email Verifikasi</button>
    </form>
    
    <form method="POST" action="{{ route('logout') }}" style="margin-top: 15px;">
        @csrf
        <button type="submit" style="background: none; border: none; color: #6b7280; text-decoration: underline; cursor: pointer;">Logout</button>
    </form>
</div>

</body>
</html>
