<?php

return [
    // Ditambahkan trim() untuk otomatis membuang spasi tak terlihat dari file .env
    'merchant_id'   => trim(env('MIDTRANS_MERCHANT_ID')),
    'client_key'    => trim(env('MIDTRANS_CLIENT_KEY')),
    'server_key'    => trim(env('MIDTRANS_SERVER_KEY')),
    
    // Proteksi boolean murni (True/False) berdasarkan angka 0 atau 1 dari .env
    'is_production' => (bool) env('MIDTRANS_IS_PRODUCTION', false),
    'is_sanitized'  => (bool) env('MIDTRANS_IS_SANITIZED', true),
    'is_3ds'        => (bool) env('MIDTRANS_IS_3DS', true),
];