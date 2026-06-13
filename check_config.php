<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
echo 'SERVER_KEY_IN_CONFIG: ' . config('services.midtrans.server_key') . "\n";
echo 'CLIENT_KEY_IN_CONFIG: ' . config('services.midtrans.client_key') . "\n";
