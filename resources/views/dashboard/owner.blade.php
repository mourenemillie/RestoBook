@extends('layouts.dashboard')

@section('title', 'Dashboard Owner')

@section('content')



    <!-- Main Content -->
    <main class="main-content">
        <header>
            <div class="header-text">
                <h1>Selamat Datang, Owner!</h1>
                <p>Berikut adalah ringkasan aktivitas restoran Anda hari ini.</p>
            </div>
            <div class="header-actions">
                <button class="btn-notif"><i data-lucide="bell"></i></button>
                <button class="btn-reservasi"><i data-lucide="plus"></i> Reservasi Baru</button>
            </div>
        </header>

        @if($restaurant_status === 'pending')
        <div class="card" style="background-color: #fff3cd; color: #856404; border: 1px solid #ffeeba; margin-bottom: 20px; padding: 20px;">
            <h3 style="margin-bottom: 10px;">⚠️ Menunggu Persetujuan Admin</h3>
            <p>Pendaftaran restoran Anda sedang ditinjau oleh Super Admin. Anda belum bisa menerima reservasi atau tampil di halaman utama sampai akun Anda disetujui.</p>
        </div>
        @endif

        @if($restaurant_status === 'rejected')
        <div class="card" style="background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; margin-bottom: 20px; padding: 20px;">
            <h3 style="margin-bottom: 10px;">❌ Pendaftaran Ditolak</h3>
            <p>Maaf, pendaftaran restoran Anda ditolak oleh Admin. Silakan periksa kembali data restoran Anda atau hubungi dukungan kami.</p>
        </div>
        @endif

        <!-- Stats Cards -->
        <section class="stats-grid">
            <div class="card stat-card">
                <div class="stat-header">
                    <div class="stat-icon icon-orange"><i data-lucide="users"></i></div>
                    <span class="badge badge-green">↗ 12%</span>
                </div>
                <p>Total Tamu Hari Ini</p>
                <h2>142</h2>
            </div>

            <div class="card stat-card">
                <div class="stat-header">
                    <div class="stat-icon icon-yellow"><i data-lucide="calendar-days"></i></div>
                    <span class="badge badge-green">↗ 5%</span>
                </div>
                <p>Reservasi Aktif</p>
                <h2>28</h2>
            </div>

            <div class="card stat-card">
                <div class="stat-header">
                    <div class="stat-icon icon-brown"><i data-lucide="table-properties"></i></div>
                    <span class="badge badge-gray">Stabil</span>
                </div>
                <p>Meja Tersedia</p>
                <h2>15<span>/40</span></h2>
            </div>

            <div class="card stat-card">
                <div class="stat-header">
                    <div class="stat-icon icon-red"><i data-lucide="x-circle"></i></div>
                    <span class="badge badge-red">↘ 2%</span>
                </div>
                <p>Batal Hari Ini</p>
                <h2>3</h2>
            </div>
        </section>

        <!-- Middle -->
        <div class="middle-grid">

            <!-- Reservasi -->
            <section class="card table-card">
                <div class="card-header">
                    <h3>Reservasi Terbaru</h3>
                    <a href="#" class="link-all">Lihat Semua</a>
                </div>

                <table>
                    <thead>
                        <tr>
                            <th>Nama Pelanggan</th>
                            <th>Waktu</th>
                            <th>Tamu</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>
                                <div class="customer">
                                    <div class="avatar av-a">A</div>
                                    <span>Ahmad Fauzi</span>
                                </div>
                            </td>
                            <td>19:00 WIB</td>
                            <td>4 Orang</td>
                            <td><span class="status st-waiting">Menunggu</span></td>
                            <td><i data-lucide="more-vertical"></i></td>
                        </tr>

                        <tr>
                            <td>
                                <div class="customer">
                                    <div class="avatar av-b">B</div>
                                    <span>Budi Santoso</span>
                                </div>
                            </td>
                            <td>20:30 WIB</td>
                            <td>2 Orang</td>
                            <td><span class="status st-confirmed">Dikonfirmasi</span></td>
                            <td><i data-lucide="more-vertical"></i></td>
                        </tr>

                        <tr>
                            <td>
                                <div class="customer">
                                    <div class="avatar av-c">C</div>
                                    <span>Citra Kirana</span>
                                </div>
                            </td>
                            <td>18:15 WIB</td>
                            <td>6 Orang</td>
                            <td><span class="status st-done">Selesai</span></td>
                            <td><i data-lucide="more-vertical"></i></td>
                        </tr>
                    </tbody>
                </table>
            </section>

            <!-- Status Meja -->
            <section class="card table-status-card">
                <div class="card-header">
                    <h3>Status Meja</h3>
                    <i data-lucide="refresh-cw"></i>
                </div>

                <div class="table-grid">
                    <div class="table-item t-empty">M1 <span>Kosong</span></div>
                    <div class="table-item t-filled">M2 <span>Terisi</span></div>
                    <div class="table-item t-booked">M3 <span>Dipesan</span></div>
                    <div class="table-item t-empty">M4 <span>Kosong</span></div>
                    <div class="table-item t-empty">M5 <span>Kosong</span></div>
                    <div class="table-item t-filled">M6 <span>Terisi</span></div>
                </div>

                <div class="legend">
                    <div><span class="dot d-empty"></span> Kosong</div>
                    <div><span class="dot d-filled"></span> Terisi</div>
                    <div><span class="dot d-booked"></span> Dipesan</div>
                </div>
            </section>

        </div>

        <!-- Chart -->
        <section class="card chart-card">
            <h3>Tren Reservasi Mingguan</h3>

            <div class="chart-container">
                <div class="bar-group"><div class="bar" style="height:30%"></div><span>Sen</span></div>
                <div class="bar-group"><div class="bar" style="height:55%"></div><span>Sel</span></div>
                <div class="bar-group"><div class="bar" style="height:45%"></div><span>Rab</span></div>
                <div class="bar-group"><div class="bar" style="height:75%"></div><span>Kam</span></div>
                <div class="bar-group highlight"><div class="bar" style="height:95%"></div><span>Jum</span></div>
                <div class="bar-group"><div class="bar" style="height:85%"></div><span>Sab</span></div>
                <div class="bar-group"><div class="bar" style="height:65%"></div><span>Min</span></div>
            </div>
        </section>

    </main>
</div>

@endsection