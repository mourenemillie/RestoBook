<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Semua User - RestoBook Admin</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap');

        :root {
            --primary-orange: #e25c23;
            --primary-orange-light: #fff6f3;
            --dark-orange: #a63b0a;
            --bg-color: #fffaf8;
            --text-dark: #271f1d;
            --text-gray: #807773;
            --border-color: #f5ece9;
            --table-header-bg: #fff8f5;
            --table-header-text: #a63b0a;
            --badge-bg: #fff1eb;
            --badge-text: #b75429;
            --status-active: #29a073;
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
            transition: all 0.2s;
        }

        .filter-btn.active {
            background-color: var(--primary-orange);
            color: white;
            border-color: var(--primary-orange);
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
            transition: color 0.2s;
        }
        .actions svg:hover {
            color: var(--primary-orange);
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(4px);
        }
        .modal.active {
            display: flex;
        }
        .modal-content {
            background-color: #ffffff;
            padding: 32px;
            border-radius: 24px;
            width: 100%;
            max-width: 500px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            border: 1px solid var(--border-color);
        }
        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
            padding-bottom: 12px;
            border-bottom: 1px solid var(--border-color);
        }
        .modal-header h3 {
            font-size: 20px;
            font-weight: 700;
            color: var(--text-dark);
        }
        .close-btn {
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
            color: var(--text-gray);
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 8px;
            color: var(--text-dark);
        }
        .form-group input {
            width: 100%;
            padding: 14px 16px;
            border: 1px solid var(--border-color);
            border-radius: 12px;
            font-size: 14px;
            outline: none;
            background: #fafafa;
            color: var(--text-dark);
            transition: all 0.2s;
        }
        .form-group input:focus {
            border-color: var(--primary-orange);
            background: #ffffff;
        }
        .modal-actions {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 24px;
        }
        .btn-cancel {
            background: none;
            border: 1px solid var(--border-color);
            padding: 12px 20px;
            border-radius: 12px;
            font-weight: 600;
            cursor: pointer;
            color: var(--text-gray);
        }
        .btn-save {
            background-color: var(--primary-orange);
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 12px;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(226, 92, 35, 0.2);
            transition: all 0.2s;
        }
        .btn-save:hover {
            background-color: var(--dark-orange);
            transform: translateY(-1px);
        }
        /* Responsive Adjustments */
        @media (max-width: 992px) {
            body { flex-direction: column; }
            .sidebar { width: 100%; border-right: none; border-bottom: 1px solid var(--border-color); padding: 16px; align-items: flex-start; }
            .logo { margin-bottom: 16px; padding: 0; }
            .user-profile { margin-bottom: 16px; padding: 0; display: none; }
            .nav-menu { display: flex; width: 100%; overflow-x: auto; gap: 8px; padding-bottom: 8px; flex-direction: row; }
            .nav-item { margin-bottom: 0; padding: 10px 16px; white-space: nowrap; }
            .main-content { max-width: 100%; padding: 20px; }
            .stats-grid { grid-template-columns: repeat(2, 1fr); }
            .header { flex-direction: column; align-items: flex-start; gap: 16px; }
            .header-actions { width: 100%; justify-content: space-between; }
        }
        @media (max-width: 576px) {
            .stats-grid { grid-template-columns: 1fr; }
            .table-responsive { overflow-x: auto; display: block; width: 100%; }
            th, td { white-space: nowrap; }
            .content-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

    <aside class="sidebar">
        <a href="{{ route('admin.dashboard') }}" class="logo" style="text-decoration: none;">
            <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1; font-size: 28px; color: var(--primary-orange);">restaurant</span>
            <span style="font-weight: 800; font-size: 20px; color: #a63b0a; letter-spacing: -0.5px;">Resto<span style="color: var(--primary-orange);">Book</span> <span style="font-weight: 600; color: #271f1d; font-size: 16px; margin-left: 4px;">Admin</span></span>
        </a>

        <div class="user-profile">
            <div style="width: 40px; height: 40px; border-radius: 50%; background: var(--border-color); display: flex; align-items: center; justify-content: center; color: var(--text-gray);">
                <svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
            </div>
            <div class="user-info">
                <h4>Admin Sistem</h4>
            </div>
        </div>

        <nav class="nav-menu">
            <a href="{{ route('admin.dashboard') }}" class="nav-item">
                <svg viewBox="0 0 24 24"><path d="M4 13h6c.55 0 1-.45 1-1V4c0-.55-.45-1-1-1H4c-.55 0-1 .45-1 1v8c0 .55.45 1 1 1zm0 8h6c.55 0 1-.45 1-1v-4c0-.55-.45-1-1-1H4c-.55 0-1 .45-1 1v4c0 .55.45 1 1 1zm10 0h6c.55 0 1-.45 1-1v-8c0-.55-.45-1-1-1h-6c-.55 0-1 .45-1 1v8c0 .55.45 1 1 1zM13 4v4c0 .55.45 1 1 1h6c.55 0 1-.45 1-1V4c0-.55-.45-1-1-1h-6c-.55 0-1 .45-1 1z"/></svg>
                Dashboard
            </a>
            <a href="{{ route('admin.restaurants') }}" class="nav-item">
                <svg viewBox="0 0 24 24"><path d="M11 9H9V2H7v7H5V2H3v7c0 2.12 1.66 3.84 3.75 3.97V22h2.5v-9.03C11.34 12.84 13 11.12 13 9V2h-2v7zm5-3v8h2.5v8H21V2c-2.76 0-5 2.24-5 4z"/></svg>
                Kelola Restoran
            </a>
            <a href="{{ route('admin.users') }}" class="nav-item active">
                <svg viewBox="0 0 24 24"><path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/></svg>
                Kelola User
            </a>
            <a href="{{ route('admin.settings') }}" class="nav-item">
                <svg viewBox="0 0 24 24"><path d="M19.14,12.94c0.04-0.3,0.06-0.61,0.06-0.94c0-0.32-0.02-0.64-0.06-0.94l2.03-1.58c0.18-0.14,0.23-0.41,0.12-0.61 l-1.92-3.32c-0.12-0.22-0.37-0.29-0.59-0.22l-2.39,0.96c-0.5-0.38-1.03-0.7-1.62-0.94L14.4,2.81c-0.04-0.24-0.24-0.41-0.48-0.41 h-3.84c-0.24,0-0.43,0.17-0.47,0.41L9.25,5.35C8.66,5.59,8.12,5.92,7.63,6.29L5.24,5.33c-0.22-0.08-0.47,0-0.59,0.22L2.73,8.87 C2.62,9.08,2.66,9.34,2.86,9.48l2.03,1.58C4.84,11.36,4.8,11.69,4.8,12s0.02,0.64,0.06,0.94l-2.03,1.58 c-0.18,0.14-0.23,0.41-0.12,0.61l1.92,3.32c0.12,0.22,0.37,0.29,0.59,0.22l2.39-0.96c0.5,0.38,1.03,0.7,1.62,0.94l0.36,2.54 c0.05,0.24,0.24,0.41,0.48,0.41h3.84c0.24,0,0.43-0.17,0.47-0.41l0.36-2.54c0.59-0.24,1.13-0.56,1.62-0.94l2.39,0.96 c0.22,0.08,0.47,0,0.59-0.22l1.92-3.32c0.12-0.22,0.07-0.49-0.12-0.61L19.14,12.94z M12,15.6c-1.98,0-3.6-1.62-3.6-3.6 s1.62-3.6,3.6-3.6s3.6,1.62,3.6,3.6S13.98,15.6,12,15.6z"/></svg>
                Pengaturan
            </a>
            
            <form action="{{ route('logout') }}" method="POST" id="logout-form-admin">
                @csrf
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form-admin').submit();" class="nav-item logout">
                    <svg viewBox="0 0 24 24"><path d="M17 7l-1.41 1.41L18.17 11H8v2h10.17l-2.58 2.58L17 17l5-5zM4 5h8V3H4c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h8v-2H4V5z"/></svg>
                    Logout
                </a>
            </form>
        </nav>
    </aside>

    <main class="main-content">
        <header class="header">
            <div class="header-title">
                <h1>Kelola Pelanggan</h1>
                <p>Pantau dan kelola akses pengguna pelanggan platform RestoBook secara aman.</p>
            </div>
        </header>

        @if(session('success'))
            <div style="background: #ecfdf5; color: #29a073; padding: 16px; border-radius: 12px; margin-bottom: 24px; font-weight: 500;">
                {{ session('success') }}
            </div>
        @endif

        <section class="filter-section">
            <div class="search-box">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                <input type="text" id="user-search" placeholder="Cari nama pelanggan..." onkeyup="searchUsers()">
            </div>
        </section>

        <!-- DATA PELANGGAN -->
        <section class="table-card">
            <div class="table-top">
                <span class="table-info">Menampilkan {{ count($users) }} pelanggan</span>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>NAMA PELANGGAN</th>
                        <th>EMAIL</th>
                        <th>NO. TELEPON</th>
                        <th>STATUS</th>
                        <th>AKSI</th>
                    </tr>
                </thead>
                <tbody id="user-table-body">
                    @forelse($users as $c)
                    <tr class="user-row">
                        <td>
                            <div class="user-cell">
                                <div style="width: 28px; height: 28px; border-radius: 50%; background: var(--border-color); display: flex; align-items: center; justify-content: center; color: var(--text-gray); font-weight: 700; font-size: 11px;">
                                    {{ strtoupper(substr($c->name, 0, 1)) }}
                                </div>
                                <span class="search-name">{{ $c->name }}</span>
                            </div>
                        </td>
                        <td>
                            @php
                                $parts = explode('@', $c->email);
                                $maskedEmail = count($parts) === 2 ? substr($parts[0], 0, 3) . '***@' . $parts[1] : $c->email;
                            @endphp
                            {{ $maskedEmail }}
                        </td>
                        <td class="phone-cell">
                            @if($c->phone)
                                {{ substr($c->phone, 0, 4) }}-****-****
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            <div class="status active">
                                <div class="dot"></div> Aktif
                            </div>
                        </td>
                        <td>
                            <div class="actions">
                                <!-- Edit Button -->
                                <svg onclick="openEditModal({{ $c->id }}, '{{ addslashes($c->name) }}', '{{ addslashes($c->email) }}', '{{ addslashes($c->phone) }}')" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="cursor: pointer; width: 18px; height: 18px;"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                
                                <!-- Delete Button -->
                                <svg onclick="confirmDelete({{ $c->id }}, '{{ addslashes($c->name) }}')" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="cursor: pointer; width: 18px; height: 18px; color: #ef4444;"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" style="text-align: center; color: var(--text-gray); padding: 32px;">Belum ada data pelanggan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </section>
    </main>

    <!-- EDIT USER MODAL -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Ubah Data Pelanggan</h3>
                <button class="close-btn" onclick="closeEditModal()">&times;</button>
            </div>
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" name="name" id="edit-name" required>
                </div>
                
                <div class="form-group">
                    <label>Alamat Email</label>
                    <input type="email" name="email" id="edit-email" required>
                </div>

                <div class="form-group">
                    <label>Nomor Telepon</label>
                    <input type="text" name="phone" id="edit-phone">
                </div>

                <div class="modal-actions">
                    <button type="button" class="btn-cancel" onclick="closeEditModal()">Batal</button>
                    <button type="submit" class="btn-save">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Hidden Delete Form -->
    <form id="deleteForm" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>

    <!-- CUSTOM DELETE CONFIRMATION MODAL -->
    <div id="deleteModal" class="modal">
        <div class="modal-content" style="max-width: 420px; text-align: center; padding: 36px 32px;">
            <div style="color: #ef4444; margin-bottom: 20px; display: flex; justify-content: center;">
                <svg width="64" height="64" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="background: #fee2e2; padding: 14px; border-radius: 50%;">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </div>
            <h3 style="font-size: 20px; font-weight: 700; color: var(--text-dark); margin-bottom: 12px;">Peringatan Penting</h3>
            <p id="delete-warning-text" style="font-size: 14px; color: var(--text-gray); line-height: 1.6; margin-bottom: 28px;">Apakah Anda yakin ingin menghapus data ini? Tindakan ini tidak dapat dibatalkan.</p>
            
            <div style="display: flex; gap: 12px; justify-content: center; width: 100%;">
                <button type="button" class="btn-cancel" onclick="closeDeleteModal()" style="flex: 1; padding: 12px 20px; border-radius: 12px;">Batal</button>
                <button type="button" class="btn-save" id="btn-confirm-delete" style="flex: 1; background-color: #ef4444; box-shadow: 0 4px 12px rgba(239, 68, 68, 0.2); padding: 12px 20px; border-radius: 12px;">Hapus Pelanggan</button>
            </div>
        </div>
    </div>

    <script>
        let deleteTargetUrl = '';

        function openEditModal(id, name, email, phone) {
            document.getElementById('edit-name').value = name;
            document.getElementById('edit-email').value = email;
            document.getElementById('edit-phone').value = phone || '';
            
            // Set form action dynamically
            var actionUrl = "{{ route('admin.users.update', ':id') }}";
            actionUrl = actionUrl.replace(':id', id);
            document.getElementById('editForm').action = actionUrl;
            
            document.getElementById('editModal').classList.add('active');
        }

        function closeEditModal() {
            document.getElementById('editModal').classList.remove('active');
        }

        function confirmDelete(id, name) {
            var actionUrl = "{{ route('admin.users.destroy', ':id') }}";
            actionUrl = actionUrl.replace(':id', id);
            deleteTargetUrl = actionUrl;
            
            document.getElementById('delete-warning-text').innerHTML = 'Apakah Anda yakin ingin menghapus pelanggan <strong>' + name + '</strong>?<br>Tindakan ini tidak dapat dibatalkan.';
            document.getElementById('deleteModal').classList.add('active');
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.remove('active');
        }

        document.getElementById('btn-confirm-delete').addEventListener('click', function() {
            var form = document.getElementById('deleteForm');
            form.action = deleteTargetUrl;
            form.submit();
        });

        function searchUsers() {
            var input = document.getElementById('user-search');
            var filter = input.value.toLowerCase();
            var rows = document.querySelectorAll('.user-row');
            
            rows.forEach(function(row) {
                var nameText = row.querySelector('.search-name').textContent.toLowerCase();
                if (nameText.indexOf(filter) > -1) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            });
        }

        // Close modals when clicking outside of the content box
        window.onclick = function(event) {
            var editModal = document.getElementById('editModal');
            var deleteModal = document.getElementById('deleteModal');
            if (event.target == editModal) {
                closeEditModal();
            }
            if (event.target == deleteModal) {
                closeDeleteModal();
            }
        }
    </script>
</body>
</html>