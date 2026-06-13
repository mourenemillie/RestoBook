<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    $request = Illuminate\Http\Request::create('/booking/checkout/BKS-MMZ0T', 'GET');
    $response = app(Illuminate\Contracts\Http\Kernel::class)->handle($request);
    echo "Status: " . $response->getStatusCode() . "\n";
    if ($response->isRedirection()) {
        echo "Redirect: " . $response->getTargetUrl() . "\n";
    }
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
