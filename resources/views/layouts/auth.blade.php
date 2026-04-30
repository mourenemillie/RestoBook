<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'RestoBook')</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: linear-gradient(180deg, #fff5ed 0%, #fde7dd 100%); display: flex; align-items: center; justify-content: center; min-height: 100vh; padding: 24px; }
        .card { background: #fff; border-radius: 32px; padding: 44px 44px 36px; width: 100%; max-width: 520px; box-shadow: 0 24px 70px rgba(239, 108, 0, 0.12); }
        .brand { display: inline-flex; align-items: center; gap: 10px; font-size: 22px; font-weight: 800; color: #c9460b; margin-bottom: 8px; }
        .brand-logo { width: 34px; height: 34px; display: inline-flex; align-items: center; justify-content: center; border-radius: 12px; background: #fee5d5; color: #c9460b; font-size: 18px; }
        h1 { font-size: 32px; font-weight: 800; color: #2c2f2e; margin-top: 14px; margin-bottom: 10px; }
        .sub { color: #5d5f5d; font-size: 15px; margin-bottom: 28px; }
        .field-label, .section-title { font-size: 14px; font-weight: 600; color: #2c2f2e; }
        .password-row { display: flex; align-items: center; justify-content: space-between; gap: 12px; margin-bottom: 8px; }
        .forgot-link { color: #c9460b; font-size: 13px; font-weight: 700; text-decoration: none; }
        .forgot-link:hover { text-decoration: underline; }
        .role-toggle { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; margin-bottom: 28px; }
        .role-card { border: 1px solid #e6e1dc; border-radius: 22px; padding: 18px; display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 10px; cursor: pointer; transition: border-color 0.2s, background 0.2s; background: #fffaf7; }
        .role-card:hover { border-color: #f7b28c; }
        .role-card.active { border-color: #c9460b; background: #fff1ea; }
        .role-card-icon { width: 42px; height: 42px; border-radius: 50%; display: grid; place-items: center; background: #ffe5d6; color: #c9460b; font-size: 18px; }
        .role-card-title { font-size: 15px; font-weight: 700; color: #2c2f2e; }
        .role-card input { display: none; }
        .fields-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
        .field-group { display: flex; flex-direction: column; gap: 10px; }
        .field-group.full-width { grid-column: 1 / -1; }
        input { width: 100%; padding: 14px 16px; border: 1.5px solid #e7e1db; border-radius: 14px; font-size: 15px; color: #2c2f2e; background: #fffaf7; outline: none; transition: border-color 0.2s, box-shadow 0.2s; }
        input:focus { border-color: #ea580c; box-shadow: 0 0 0 4px rgba(234, 88, 12, 0.12); }
        .terms { display: flex; align-items: flex-start; gap: 12px; margin: 16px 0 22px; font-size: 14px; color: #5d5f5d; }
        .terms input { margin-top: 4px; width: 18px; height: 18px; accent-color: #c9460b; }
        .terms a { color: #c9460b; font-weight: 700; text-decoration: none; }
        .terms a:hover { text-decoration: underline; }
        .btn { width: 100%; background: linear-gradient(135deg, #b34d06 0%, #ff8a18 100%); color: #fff; font-size: 16px; font-weight: 700; padding: 16px; border-radius: 9999px; border: none; cursor: pointer; transition: transform 0.2s, opacity 0.2s; }
        .btn:hover { opacity: 0.95; transform: translateY(-1px); }
        .register-link, .bottom-text { text-align: center; margin-top: 24px; font-size: 14px; color: #5d5f5d; }
        .register-link a, .bottom-text a { color: #c9460b; font-weight: 700; text-decoration: none; }
        .register-link a:hover, .bottom-text a:hover { text-decoration: underline; }
        .error { background: #fff1f0; color: #dc2626; font-size: 13px; padding: 12px 14px; border-radius: 12px; margin-bottom: 18px; }
        @media (max-width: 640px) {
            body { padding: 16px; }
            .card { padding: 28px 20px 24px; max-width: 100%; }
            h1 { font-size: 28px; }
            .sub { font-size: 14px; margin-bottom: 24px; }
            .role-toggle, .fields-grid { grid-template-columns: 1fr; }
            .terms { font-size: 13px; margin: 14px 0 20px; }
            .btn { padding: 14px; }
            .register-link, .bottom-text { margin-top: 18px; font-size: 13px; }
            .role-card { min-height: 120px; }
        }
    </style>
</head>
<body>
    <div class="card">
        @yield('content')
    </div>
    @stack('scripts')
</body>
</html>
