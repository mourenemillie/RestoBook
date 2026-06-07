<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// Setup the remote database connection dynamically
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

echo "Mulai memindahkan data dari Lokal ke Railway...\n";

// 1. Jalankan migrasi di database Railway untuk memastikan tabelnya ada
echo "Menyiapkan tabel di Railway...\n";
\Artisan::call('migrate:fresh', ['--database' => 'pgsql_remote', '--force' => true]);

// 2. Daftar tabel yang akan dipindahkan
$tables = [
    'users',
    'restaurants',
    'menus',
    'tables',
    'reservations',
    'settings' // tambahkan jika ada tabel lain
];

foreach ($tables as $table) {
    if (!Schema::connection('pgsql')->hasTable($table)) {
        continue;
    }
    
    echo "Memindahkan data tabel: $table ...\n";
    
    // Ambil semua data dari lokal
    $data = DB::connection('pgsql')->table($table)->get()->map(function ($item) {
        return (array) $item;
    })->toArray();
    
    if (count($data) > 0) {
        // Karena ada batasan parameter di bind, kita chunk datanya per 100 baris
        $chunks = array_chunk($data, 100);
        foreach ($chunks as $chunk) {
            DB::connection('pgsql_remote')->table($table)->insert($chunk);
        }
        echo "  -> Berhasil memindahkan " . count($data) . " baris.\n";
    } else {
        echo "  -> Tabel kosong, dilewati.\n";
    }
}

echo "\nSelesai! Semua data aslimu sudah berhasil disalin ke Railway.\n";

