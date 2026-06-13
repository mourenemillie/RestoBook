<?php
require 'vendor/autoload.php';

\Midtrans\Config::$serverKey = 'SB-Mid-server-MWBzcurIHFCD_hJM0sk-k89L';
\Midtrans\Config::$isProduction = false;
\Midtrans\Config::$isSanitized = true;
\Midtrans\Config::$is3ds = true;

try {
    $snapToken = \Midtrans\Snap::getSnapToken([
        'transaction_details' => [
            'order_id' => 'BKS-TEST98',
            'gross_amount' => 10000
        ],
        'customer_details' => [
            'first_name' => 'Guest',
            'email' => 'guest@example.com',
            'phone' => '0800000000'
        ]
    ]);
    echo "Token: " . $snapToken . "\n";
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
