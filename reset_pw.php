<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// Reset local admin password
$adminLocal = App\Models\User::where('email', 'admin.sistem@gmail.com')->first();
if ($adminLocal) {
    $adminLocal->password = bcrypt('admin123');
    $adminLocal->save();
    echo "Password admin lokal berhasil di-reset ke: admin123\n";
}

// Reset remote admin password
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
    'sslmode' => 'prefer',
]]);

$adminRemote = Illuminate\Support\Facades\DB::connection('pgsql_remote')
    ->table('users')
    ->where('email', 'admin.sistem@gmail.com')
    ->update(['password' => bcrypt('admin123')]);

if ($adminRemote) {
    echo "Password admin Railway berhasil di-reset ke: admin123\n";
}
