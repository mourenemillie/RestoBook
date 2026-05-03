@extends('layouts.app')

@section('title', 'Reservasi Saya - RestoBook Lampung')

@section('content')
<section style="padding: 96px 48px; max-width: 1120px; margin: 0 auto;">
    <div style="display:flex; align-items:center; justify-content:space-between; gap:16px; margin-bottom:40px;">
        <div>
            <h1 style="font-size:38px; font-weight:800; margin-bottom:12px;">Reservasi Saya</h1>
            <p style="color:#595c5a;">Kelola reservasi kamu di RestoBook Lampung.</p>
        </div>
    </div>

    <div style="background:#fff; border-radius:32px; padding:32px; box-shadow:0 20px 50px rgba(0,0,0,0.05);">
        @if(count($reservations) === 0)
            <p style="color:#52525b; font-size:16px;">Belum ada reservasi. Jelajahi restoran dan buat reservasi sekarang.</p>
        @else
            <table style="width:100%; border-collapse:collapse;">
                <thead>
                    <tr style="background:#f7f5f1; text-align:left; color:#2c2f2e;">
                        <th style="padding:18px 16px; border-bottom:1px solid #e5e7eb;">Restoran</th>
                        <th style="padding:18px 16px; border-bottom:1px solid #e5e7eb;">Tanggal</th>
                        <th style="padding:18px 16px; border-bottom:1px solid #e5e7eb;">Waktu</th>
                        <th style="padding:18px 16px; border-bottom:1px solid #e5e7eb;">Jumlah Orang</th>
                        <th style="padding:18px 16px; border-bottom:1px solid #e5e7eb;">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reservations as $reservation)
                        <tr>
                            <td style="padding:18px 16px; border-bottom:1px solid #eef2f7;">{{ $reservation['restaurant'] }}</td>
                            <td style="padding:18px 16px; border-bottom:1px solid #eef2f7;">{{ $reservation['date'] }}</td>
                            <td style="padding:18px 16px; border-bottom:1px solid #eef2f7;">{{ $reservation['time'] }}</td>
                            <td style="padding:18px 16px; border-bottom:1px solid #eef2f7;">{{ $reservation['guests'] }} orang</td>
                            <td style="padding:18px 16px; border-bottom:1px solid #eef2f7;">
                                <span style="display:inline-flex; padding:8px 14px; border-radius:9999px; font-weight:700; background:{{ $reservation['status'] === 'Confirmed' ? '#d1fae5' : ($reservation['status'] === 'Pending' ? '#fef3c7' : '#fee2e2') }}; color:{{ $reservation['status'] === 'Confirmed' ? '#166534' : ($reservation['status'] === 'Pending' ? '#92400e' : '#991b1b') }};">
                                    {{ $reservation['status'] }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</section>
@endsection
