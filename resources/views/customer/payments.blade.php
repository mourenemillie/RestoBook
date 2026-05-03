<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RestoBook - Secure Checkout</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-orange: #E67E00;
            --text-dark: #2D2D2D;
            --text-muted: #717171;
            --bg-light: #F8F9F8;
            --card-bg: #EDF1F0;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        body {
            background-color: var(--bg-light);
            color: var(--text-dark);
            line-height: 1.5;
        }

        /* --- NAVIGATION --- */
        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 8%;
            background: white;
        }

        .logo {
            font-weight: 800;
            font-size: 20px;
            color: var(--primary-orange);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .nav-links {
            display: flex;
            gap: 30px;
        }

        .nav-links a {
            text-decoration: none;
            color: var(--text-muted);
            font-weight: 600;
            font-size: 14px;
        }

        .nav-links a.active {
            color: var(--primary-orange);
            border-bottom: 2px solid var(--primary-orange);
            padding-bottom: 4px;
        }

        .btn-signin {
            background: #E8EAE6;
            padding: 10px 24px;
            border-radius: 20px;
            text-decoration: none;
            color: var(--text-dark);
            font-weight: 700;
            font-size: 14px;
        }

        /* --- MAIN LAYOUT --- */
        main {
            max-width: 1200px;
            margin: 40px auto;
            display: grid;
            grid-template-columns: 1fr 380px;
            gap: 40px;
            padding: 0 20px;
        }

        .checkout-header span {
            color: var(--primary-orange);
            font-size: 12px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .checkout-header h1 {
            font-size: 48px;
            font-weight: 800;
            line-height: 1.1;
            margin-top: 10px;
            margin-bottom: 40px;
        }

        .checkout-header h1 em {
            font-style: normal;
            color: #8B4513;
        }

        /* --- SECTIONS --- */
        .section-title {
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 700;
            font-size: 18px;
            margin-bottom: 20px;
        }

        .payment-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 40px;
        }

        .payment-card {
            background: var(--card-bg);
            border-radius: 24px;
            padding: 24px;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            font-weight: 700;
            color: #555;
        }

        .option {
            background: white;
            padding: 12px 16px;
            border-radius: 16px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
            cursor: pointer;
        }

        .option img { height: 20px; }

        .radio-circle {
            width: 20px;
            height: 20px;
            border: 2px solid #DDD;
            border-radius: 50%;
        }

        .option.selected .radio-circle {
            border: 6px solid #8B4513;
        }

        /* --- UPLOAD AREA --- */
        .upload-box {
            border: 2px dashed #DDD;
            border-radius: 24px;
            background: white;
            padding: 40px;
            text-align: center;
            margin-bottom: 60px;
        }

        .btn-upload {
            background: #E0E3DF;
            border: none;
            padding: 10px 24px;
            border-radius: 20px;
            font-weight: 700;
            margin-top: 15px;
            cursor: pointer;
        }

        /* --- SIDEBAR SUMMARY --- */
        .summary-card {
            background: #E9ECE9;
            border-radius: 32px;
            overflow: hidden;
            padding: 20px;
        }

        .res-image {
            width: 100%;
            height: 180px;
            background: url('https://via.placeholder.com/400x200') center/cover;
            border-radius: 20px;
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            padding: 15px;
            color: white;
        }

        .res-image::after {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(transparent, rgba(0,0,0,0.8));
            border-radius: 20px;
        }

        .res-image-text { z-index: 1; }

        .summary-details {
            padding: 20px 10px;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 12px;
            font-size: 14px;
        }

        .detail-row.total {
            margin-top: 20px;
            font-size: 20px;
            font-weight: 800;
        }

        .detail-row.total span:last-child {
            color: var(--primary-orange);
        }

        .btn-confirm {
            background: linear-gradient(to right, #914F0D, var(--primary-orange));
            color: white;
            width: 100%;
            border: none;
            padding: 18px;
            border-radius: 30px;
            font-weight: 700;
            font-size: 16px;
            margin-top: 10px;
            box-shadow: 0 10px 20px rgba(230, 126, 0, 0.3);
            cursor: pointer;
        }

        .timer-alert {
            background: #FDF2E6;
            border-radius: 20px;
            padding: 15px;
            font-size: 12px;
            margin-top: 20px;
            display: flex;
            gap: 10px;
        }

        /* --- FOOTER --- */
        footer {
            padding: 40px 8%;
            border-top: 1px solid #EEE;
            display: flex;
            justify-content: space-between;
            font-size: 12px;
            color: var(--text-muted);
        }

        .footer-links a {
            margin-left: 20px;
            text-decoration: none;
            color: var(--text-muted);
        }
    </style>
</head>
<body>

    <nav>
        <div class="logo">🍴 RestoBook</div>
        <div class="nav-links">
            <a href="#">Explore</a>
            <a href="#" class="active">Reservations</a>
            <a href="#">About Us</a>
            <a href="#">Support</a>
        </div>
        <a href="#" class="btn-signin">Sign In</a>
    </nav>

    <main>
        <div class="content-left">
            <div class="checkout-header">
                <span>Secure Checkout</span>
                <h1>Complete your<br><em>reservation.</em></h1>
            </div>

            <div class="section-title">💳 Payment Methods</div>
            
            <div class="payment-grid">
                <div class="payment-card">
                    <div class="card-header">
                        Transfer Bank <span>🏦</span>
                    </div>
                    <div class="option selected">
                        <span><strong>BCA</strong> BCA Transfer</span>
                        <div class="radio-circle"></div>
                    </div>
                    <div class="option">
                        <span><strong>Mandiri</strong> Mandiri Transfer</span>
                        <div class="radio-circle"></div>
                    </div>
                </div>

                <div class="payment-card">
                    <div class="card-header">
                        E-wallet <span>📱</span>
                    </div>
                    <div class="option">
                        <span><strong>GoPay</strong> GoPay</span>
                        <div class="radio-circle"></div>
                    </div>
                    <div class="option">
                        <span><strong>OVO</strong> OVO</span>
                        <div class="radio-circle"></div>
                    </div>
                </div>
            </div>

            <div class="section-title">☁️ Upload Bukti Pembayaran</div>
            <div class="upload-box">
                <div style="font-size: 40px; margin-bottom: 10px;">📄</div>
                <p><strong>Drop your receipt here</strong></p>
                <p style="font-size: 12px; color: #777;">Accepted formats: JPG, PNG, PDF (Max 5MB)</p>
                <button class="btn-upload">Choose File</button>
            </div>
        </div>

        <aside>
            <div class="summary-card">
                <div class="res-image">
                    <div class="res-image-text">
                        <h3 style="font-size: 16px;">The Culinary Canvas</h3>
                        <p style="font-size: 12px; opacity: 0.8;">Fine Dining & Artisan Grill</p>
                    </div>
                </div>
                
                <div class="summary-details">
                    <div class="detail-row">
                        <span style="color: #888;">Date & Time</span>
                        <span style="font-weight: 700;">Oct 24, 2024 • 19:00</span>
                    </div>
                    <div class="detail-row">
                        <span style="color: #888;">Guests</span>
                        <span style="font-weight: 700;">4 People</span>
                    </div>
                    <div class="detail-row">
                        <span style="color: #888;">Table</span>
                        <span style="font-weight: 700;">T-12 (Window View)</span>
                    </div>

                    <div style="border-top: 1px solid #DDD; margin: 15px 0;"></div>

                    <div class="detail-row">
                        <span style="color: #888;">Booking Fee</span>
                        <span>Rp 50.000</span>
                    </div>
                    <div class="detail-row">
                        <span style="color: #888;">Service Charge (5%)</span>
                        <span>Rp 2.500</span>
                    </div>

                    <div class="detail-row total">
                        <span>Total Amount</span>
                        <span>Rp 52.500</span>
                    </div>

                    <button class="btn-confirm">Konfirmasi Pembayaran</button>
                    <p style="text-align: center; font-size: 10px; color: #999; margin-top: 15px; text-transform: uppercase; letter-spacing: 1px;">
                        🔒 Secure Encrypted Payment
                    </p>
                </div>
            </div>

            <div class="timer-alert">
                <span>ℹ️</span>
                <p>Payment must be completed within <strong>15:00</strong> to secure your selected table.</p>
            </div>
        </aside>
    </main>

    <footer>
        <div>
            <strong>RestoBook</strong><br>
            © 2024 RestoBook. Cultivating culinary excellence for MSMEs.
        </div>
        <div class="footer-links">
            <a href="#">Privacy Policy</a>
            <a href="#">Terms of Service</a>
            <a href="#">Partner With Us</a>
            <a href="#">Contact Support</a>
        </div>
    </footer>

</body>
</html>