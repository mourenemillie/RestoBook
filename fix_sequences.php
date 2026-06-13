<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

config(['database.connections.pgsql_remote' => [
    'driver' => 'pgsql',
    'host' => 'acela.proxy.rlwy.net',
    'port' => '10991',
    'database' => 'railway',
    'username' => 'postgres',
    'password' => 'dPNCgnaRnvcEpmsrKfUVKoIQZqHpTIGW',
    'charset' => 'utf8',
    'prefix' => '',
    'schema' => 'public',
    'sslmode' => 'prefer'
]]);

$tables = Illuminate\Support\Facades\DB::connection('pgsql_remote')->select("SELECT table_name FROM information_schema.tables WHERE table_schema = 'public'");
foreach ($tables as $t) {
    $tableName = $t->table_name;
    try {
        $max = Illuminate\Support\Facades\DB::connection('pgsql_remote')->table($tableName)->max('id');
        if ($max) {
            Illuminate\Support\Facades\DB::connection('pgsql_remote')->statement("SELECT setval('{$tableName}_id_seq', {$max})");
            echo "Reset {$tableName} sequence to {$max}\n";
        }
    } catch (\Exception $e) {
        echo "Error occurred while processing {$tableName}: " . $e->getMessage() . "\n";
}
echo "Done fixing sequences.\n";
