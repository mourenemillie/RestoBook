@extends('layouts.app')

@section('title', 'Reservasi Saya - RestoBook Lampung')

@section('content')
<section style="padding: 96px 48px; max-width: 1120px; margin: 0 auto;">
    <div style="display:flex; align-items:center; justify-content:space-between; gap:16px; margin-bottom:40px;">
        <div>
            <h1 style="font-size:38px; font-weight:800; margin-bottom:12px;">Reservasi Saya</h1>
            <p style="color:#595c5a;">Kelola reservasi kamu di RestoBook Lampung.</p>
        </div>
        <a href="{{ url('/') }}" style="background: #e95a1e; color: white; padding: 12px 24px; border-radius: 999px; font-weight: 700; text-decoration: none; transition: background 0.2s; white-space: nowrap;">+ Reservasi Baru</a>
    </div>

    <div style="background:#fff; border-radius:24px; padding:24px; box-shadow:0 4px 20px rgba(0,0,0,0.03);">
        @if(count($reservations) === 0)
            <p style="color:#52525b; font-size:16px;">Belum ada reservasi. Jelajahi restoran dan buat reservasi sekarang.</p>
        @else
            <table style="width:100%; border-collapse:collapse;">
                <thead>
                    <tr style="background:#f7f5f1; text-align:left; color:#2c2f2e;">
                        <th style="padding:16px 24px; border-bottom:1px solid #e5e7eb;">Restoran</th>
                        <th style="padding:16px 24px; border-bottom:1px solid #e5e7eb;">Tanggal</th>
                        <th style="padding:16px 24px; border-bottom:1px solid #e5e7eb;">Waktu</th>
                        <th style="padding:16px 24px; border-bottom:1px solid #e5e7eb;">Jumlah Orang</th>
                        <th style="padding:16px 24px; border-bottom:1px solid #e5e7eb;">Status</th>
                        <th style="padding:16px 24px; border-bottom:1px solid #e5e7eb;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reservations as $reservation)
                        <tr>
                            <td style="padding:16px 24px; border-bottom:1px solid #eef2f7;">{{ $reservation->restaurant->name ?? 'Restoran Dihapus' }}</td>
                            <td style="padding:16px 24px; border-bottom:1px solid #eef2f7;">{{ \Carbon\Carbon::parse($reservation->reservation_date)->format('d M Y') }}</td>
                            <td style="padding:16px 24px; border-bottom:1px solid #eef2f7;">{{ \Carbon\Carbon::parse($reservation->reservation_time)->format('H:i') }}</td>
                            <td style="padding:16px 24px; border-bottom:1px solid #eef2f7;">{{ $reservation->num_guests }} orang</td>
                            <td style="padding:16px 24px; border-bottom:1px solid #eef2f7;">
                                @php
                                    $rawStatus = strtolower($reservation->status);
                                    $statusMap = [
                                        'pending' => ['label' => 'Menunggu', 'bg' => '#fef3c7', 'text' => '#92400e'],
                                        'paid' => ['label' => 'Dibayar', 'bg' => '#dbeafe', 'text' => '#1e40af'],
                                        'approved' => ['label' => 'Dikonfirmasi', 'bg' => '#d1fae5', 'text' => '#166534'],
                                        'completed' => ['label' => 'Selesai', 'bg' => '#d1fae5', 'text' => '#166534'],
                                        'cancelled' => ['label' => 'Dibatalkan', 'bg' => '#fee2e2', 'text' => '#991b1b'],
                                        'rejected' => ['label' => 'Ditolak', 'bg' => '#fee2e2', 'text' => '#991b1b'],
                                    ];
                                    $statusData = $statusMap[$rawStatus] ?? ['label' => ucfirst($rawStatus), 'bg' => '#f3f4f6', 'text' => '#374151'];
                                @endphp
                                <span style="display:inline-flex; padding:6px 14px; border-radius:9999px; font-size: 13px; font-weight:700; background:{{ $statusData['bg'] }}; color:{{ $statusData['text'] }};">
                                    {{ $statusData['label'] }}
                                </span>
                            </td>
                            <td style="padding:16px 24px; border-bottom:1px solid #eef2f7;">
                                @if(in_array($rawStatus, ['completed', 'approved']))
                                    <button onclick="openReviewModal('{{ $reservation->restaurant->name ?? 'Restoran' }}')" style="background: transparent; border: 1px solid #e95a1e; color: #e95a1e; padding: 6px 12px; border-radius: 6px; cursor: pointer; font-weight: 600; font-size: 12px; transition: 0.2s;">Beri Ulasan</button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    <!-- Review Modal -->
    <div id="reviewModal" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.5); z-index: 50; align-items: center; justify-content: center; padding: 20px;">
        <div style="background: white; border-radius: 24px; width: 100%; max-width: 500px; position: relative; padding: 32px; box-shadow: 0 10px 40px rgba(0,0,0,0.1);">
            <button onclick="closeReviewModal()" style="position: absolute; top: 20px; right: 20px; background: none; border: none; font-size: 24px; cursor: pointer; color: #64748b; line-height: 1;">&times;</button>
            <h2 style="font-size: 20px; font-weight: 800; margin-bottom: 8px;">Berikan Ulasan</h2>
            <p style="color: #64748b; font-size: 14px; margin-bottom: 24px;">Bagaimana pengalaman Anda di <strong id="modalRestoName">Restoran</strong>?</p>
            
            <div style="display: flex; gap: 8px; margin-bottom: 24px; font-size: 28px; color: #d1d5db; cursor: pointer;">
                <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
            </div>
            
            <textarea placeholder="Tuliskan pengalaman Anda..." style="width: 100%; border: 1px solid #e2e8f0; border-radius: 12px; padding: 16px; min-height: 120px; font-size: 14px; outline: none; margin-bottom: 24px; resize: none; font-family: inherit;"></textarea>
            
            <button style="width: 100%; background: #e95a1e; color: white; border: none; padding: 14px; border-radius: 999px; font-weight: 700; font-size: 14px; cursor: pointer;">Kirim Ulasan</button>
        </div>
    </div>
</section>

<script>
    function openReviewModal(restoName) {
        document.getElementById('modalRestoName').innerText = restoName;
        document.getElementById('reviewModal').style.display = 'flex';
    }
    
    function closeReviewModal() {
        document.getElementById('reviewModal').style.display = 'none';
    }
</script>
@endsection
