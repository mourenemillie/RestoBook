<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

\Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
\Midtrans\Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false) === true;
\Midtrans\Config::$isSanitized = true;
\Midtrans\Config::$is3ds = true;

try {
    $snapToken = \Midtrans\Snap::getSnapToken([
        'transaction_details' => [
            'order_id' => 'BKS-TEST14',
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
