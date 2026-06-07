<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    $req = Illuminate\Http\Request::create('/restaurant/1/detail', 'GET');
    $res = $app->make(Illuminate\Contracts\Http\Kernel::class)->handle($req);
    echo "Status /restaurant/1/detail: " . $res->getStatusCode() . "\n";
    if ($res->getStatusCode() == 500) echo $res->getContent() . "\n";
    
    $req2 = Illuminate\Http\Request::create('/reservasi/create/1', 'GET');
    $res2 = $app->make(Illuminate\Contracts\Http\Kernel::class)->handle($req2);
    echo "Status /reservasi/create/1: " . $res2->getStatusCode() . "\n";
    if ($res2->getStatusCode() == 500) echo $res2->getContent() . "\n";

} catch (\Exception $e) {
    echo $e->getMessage() . "\n" . $e->getTraceAsString();
}
