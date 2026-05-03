<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Semua User - RestoBook Admin</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');

        :root {
            --primary-orange: #eb5e28;
            --primary-orange-light: #fff5f0;
            --dark-orange: #a93c14;
            --bg-color: #f4f7f6;
            --text-dark: #1e293b;
            --text-gray: #64748b;
            --border-color: #e2e8f0;
            --table-header-bg: #f8ded4;
            --table-header-text: #7c4c3e;
            --badge-bg: #fdeee9;
            --badge-text: #b25838;
            --status-active: #10b981;
            --status-suspended: #ef4444;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        body {
            background-color: var(--bg-color);
            display: flex;
            min-height: 100vh;
            color: var(--text-dark);
        }

        /* Sidebar */
        .sidebar {
            width: 260px;
            background-color: #ffffff;
            display: flex;
            flex-direction: column;
            border-right: 1px solid var(--border-color);
            padding: 24px 0;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0 24px;
            margin-bottom: 40px;
        }

        .logo-icon {
            width: 28px;
            height: 28px;
            background-color: var(--primary-orange);
            border-radius: 6px;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            font-weight: 700;
        }

        .logo span {
            color: var(--primary-orange);
            font-weight: 700;
            font-size: 18px;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0 24px;
            margin-bottom: 32px;
        }

        .user-profile img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }

        .user-info h4 {
            font-size: 14px;
            font-weight: 700;
            margin-bottom: 2px;
        }

        .user-info p {
            font-size: 12px;
            color: var(--text-gray);
        }

        .nav-menu {
            list-style: none;
            display: flex;
            flex-direction: column;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 14px 24px;
            color: var(--text-gray);
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            border-left: 4px solid transparent;
        }

        .nav-item svg {
            width: 20px;
            height: 20px;
            fill: currentColor;
        }

        .nav-item.active {
            color: var(--primary-orange);
            background-color: var(--primary-orange-light);
            border-left-color: var(--primary-orange);
        }

        .logout {
            margin-top: auto;
            color: #d84824;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            padding: 40px;
            overflow-y: auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 32px;
        }

        .header-title h1 {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .header-title p {
            color: var(--text-gray);
            font-size: 15px;
        }

        .btn-add {
            background-color: var(--dark-orange);
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 24px;
            font-weight: 600;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
        }

        /* Filter Section */
        .filter-section {
            background: #ffffff;
            padding: 20px 24px;
            border-radius: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.02);
        }

        .search-box {
            display: flex;
            align-items: center;
            gap: 12px;
            background-color: #fff6f3;
            border: 1px solid #f9ded4;
            padding: 10px 16px;
            border-radius: 12px;
            width: 380px;
        }

        .search-box input {
            border: none;
            background: transparent;
            outline: none;
            width: 100%;
            font-size: 14px;
            color: var(--text-dark);
        }

        .search-box input::placeholder {
            color: #9ca3af;
        }

        .search-box svg {
            color: #9ca3af;
        }

        .filter-buttons {
            display: flex;
            gap: 12px;
        }

        .filter-btn {
            background: white;
            border: 1px solid var(--border-color);
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 500;
            color: var(--text-gray);
            cursor: pointer;
        }

        /* Table Section */
        .table-card {
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.02);
            overflow: hidden;
        }

        .table-top {
            padding: 20px 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .table-info {
            font-size: 14px;
            color: var(--text-gray);
        }

        .pagination {
            display: flex;
            gap: 16px;
            color: var(--text-gray);
        }

        .pagination svg {
            cursor: pointer;
            width: 16px;
            height: 16px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background-color: var(--table-header-bg);
        }

        th {
            text-align: left;
            padding: 16px 24px;
            font-size: 11px;
            font-weight: 700;
            color: var(--table-header-text);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        td {
            padding: 16px 24px;
            border-bottom: 1px solid #f1f5f9;
            font-size: 13px;
            vertical-align: middle;
        }

        .user-cell {
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 600;
        }

        .user-cell img {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            object-fit: cover;
        }

        .phone-cell {
            color: var(--text-gray);
            font-size: 11px;
            line-height: 1.4;
        }

        .badge {
            background-color: var(--badge-bg);
            color: var(--badge-text);
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
        }

        .status {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 12px;
            font-weight: 600;
        }

        .status.active {
            color: var(--status-active);
        }

        .status.suspended {
            color: var(--status-suspended);
        }

        .dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
        }

        .status.active .dot { background-color: var(--status-active); }
        .status.suspended .dot { background-color: var(--status-suspended); }

        .actions {
            display: flex;
            gap: 12px;
            color: #94a3b8;
        }

        .actions svg {
            width: 18px;
            height: 18px;
            cursor: pointer;
        }

    </style>
</head>
<body>

    <aside class="sidebar">
        <div class="logo">
            <div class="logo-icon">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/000000/svg">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 14c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4z" fill="white"/>
                </svg>
            </div>
            <span>RestoBook Admin</span>
        </div>

        <div class="user-profile">
            <img src="https://i.pravatar.cc/150?img=11" alt="Admin Sistem">
            <div class="user-info">
                <h4>Admin Sistem</h4>
                <p>Manage your table</p>
            </div>
        </div>

        <nav class="nav-menu">
            <a href="{{ route('admin.dashboard') }}" class="nav-item">
                <svg viewBox="0 0 24 24"><path d="M4 13h6c.55 0 1-.45 1-1V4c0-.55-.45-1-1-1H4c-.55 0-1 .45-1 1v8c0 .55.45 1 1 1zm0 8h6c.55 0 1-.45 1-1v-4c0-.55-.45-1-1-1H4c-.55 0-1 .45-1 1v4c0 .55.45 1 1 1zm10 0h6c.55 0 1-.45 1-1v-8c0-.55-.45-1-1-1h-6c-.55 0-1 .45-1 1v8c0 .55.45 1 1 1zM13 4v4c0 .55.45 1 1 1h6c.55 0 1-.45 1-1V4c0-.55-.45-1-1-1h-6c-.55 0-1 .45-1 1z"/></svg>
                Dashboard
            </a>
            <a href="#" class="nav-item">
                <svg viewBox="0 0 24 24"><path d="M11 9H9V2H7v7H5V2H3v7c0 2.12 1.66 3.84 3.75 3.97V22h2.5v-9.03C11.34 12.84 13 11.12 13 9V2h-2v7zm5-3v8h2.5v8H21V2c-2.76 0-5 2.24-5 4z"/></svg>
                Kelola Restoran
            </a>
            <a href="{{ route('admin.users') }}" class="nav-item active">
                <svg viewBox="0 0 24 24"><path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/></svg>
                Kelola User
            </a>
            <a href="#" class="nav-item">
                <svg viewBox="0 0 24 24"><path d="M19.14,12.94c0.04-0.3,0.06-0.61,0.06-0.94c0-0.32-0.02-0.64-0.06-0.94l2.03-1.58c0.18-0.14,0.23-0.41,0.12-0.61 l-1.92-3.32c-0.12-0.22-0.37-0.29-0.59-0.22l-2.39,0.96c-0.5-0.38-1.03-0.7-1.62-0.94L14.4,2.81c-0.04-0.24-0.24-0.41-0.48-0.41 h-3.84c-0.24,0-0.43,0.17-0.47,0.41L9.25,5.35C8.66,5.59,8.12,5.92,7.63,6.29L5.24,5.33c-0.22-0.08-0.47,0-0.59,0.22L2.73,8.87 C2.62,9.08,2.66,9.34,2.86,9.48l2.03,1.58C4.84,11.36,4.8,11.69,4.8,12s0.02,0.64,0.06,0.94l-2.03,1.58 c-0.18,0.14-0.23,0.41-0.12,0.61l1.92,3.32c0.12,0.22,0.37,0.29,0.59,0.22l2.39-0.96c0.5,0.38,1.03,0.7,1.62,0.94l0.36,2.54 c0.05,0.24,0.24,0.41,0.48,0.41h3.84c0.24,0,0.43-0.17,0.47-0.41l0.36-2.54c0.59-0.24,1.13-0.56,1.62-0.94l2.39,0.96 c0.22,0.08,0.47,0,0.59-0.22l1.92-3.32c0.12-0.22,0.07-0.49-0.12-0.61L19.14,12.94z M12,15.6c-1.98,0-3.6-1.62-3.6-3.6 s1.62-3.6,3.6-3.6s3.6,1.62,3.6,3.6S13.98,15.6,12,15.6z"/></svg>
                Pengaturan
            </a>
            
            <form action="{{ route('logout') }}" method="POST" id="logout-form-admin-users">
                @csrf
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form-admin-users').submit();" class="nav-item logout">
                    <svg viewBox="0 0 24 24"><path d="M17 7l-1.41 1.41L18.17 11H8v2h10.17l-2.58 2.58L17 17l5-5zM4 5h8V3H4c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h8v-2H4V5z"/></svg>
                    Logout
                </a>
            </form>
        </nav>
    </aside>

    <main class="main-content">
        <header class="header">
            <div class="header-title">
                <h1>Kelola Semua User</h1>
                <p>Pantau dan kelola akses pengguna platform RestoBook.</p>
            </div>
            <button class="btn-add">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                Tambah User Baru
            </button>
        </header>

        <section class="filter-section">
            <div class="search-box">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                <input type="text" placeholder="Cari nama, email, atau no telepon...">
            </div>
            <div class="filter-buttons">
                <button class="filter-btn">Semua Peran</button>
                <button class="filter-btn">Customer</button>
                <button class="filter-btn">Pemilik</button>
            </div>
        </section>

        <section class="table-card">
            <div class="table-top">
                <span class="table-info">Menampilkan 1-3 dari 124 user</span>
                <div class="pagination">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
                </div>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>NAMA USER</th>
                        <th>EMAIL</th>
                        <th>NO. TELEPON</th>
                        <th>PERAN</th>
                        <th>STATUS</th>
                        <th>AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="user-cell">
                                <img src="https://i.pravatar.cc/150?img=12" alt="Ahmad Pratama">
                                Ahmad Pratama
                            </div>
                        </td>
                        <td>ahmad.pratama@email.com</td>
                        <td class="phone-cell">0812-3456-7<br>890</td>
                        <td><span class="badge">PEMILIK</span></td>
                        <td>
                            <div class="status active">
                                <div class="dot"></div> Aktif
                            </div>
                        </td>
                        <td>
                            <div class="actions">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="user-cell">
                                <img src="https://i.pravatar.cc/150?img=5" alt="Siti Rahma">
                                Siti Rahma
                            </div>
                        </td>
                        <td>siti.rahma@email.com</td>
                        <td class="phone-cell">0821-9876-5432</td>
                        <td><span class="badge">CUSTOMER</span></td>
                        <td>
                            <div class="status active">
                                <div class="dot"></div> Aktif
                            </div>
                        </td>
                        <td>
                            <div class="actions">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="user-cell">
                                <img src="https://i.pravatar.cc/150?img=13" alt="Budi Santoso">
                                Budi Santoso
                            </div>
                        </td>
                        <td>budi.san@email.com</td>
                        <td class="phone-cell">0852-1122-3<br>344</td>
                        <td><span class="badge">PEMILIK</span></td>
                        <td>
                            <div class="status suspended">
                                <div class="dot"></div> Suspended
                            </div>
                        </td>
                        <td>
                            <div class="actions">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="user-cell">
                                <img src="https://i.pravatar.cc/150?img=9" alt="Diana Lestari">
                                Diana Lestari
                            </div>
                        </td>
                        <td>diana.l@email.com</td>
                        <td class="phone-cell">0813-5566-7<br>788</td>
                        <td><span class="badge">CUSTOMER</span></td>
                        <td>
                            <div class="status active">
                                <div class="dot"></div> Aktif
                            </div>
                        </td>
                        <td>
                            <div class="actions">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </section>
    </main>

</body>
</html>