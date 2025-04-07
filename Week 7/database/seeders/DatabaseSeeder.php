<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
{
    $this->call([
        KategoriSeeder::class,
        LevelSeeder::class,
        UserSeeder::class,
        BarangSeeder::class, // Tambahkan ini
        PenjualanSeeder::class,
        PenjualanDetailSeeder::class,
        StokSeeder::class, // Jalankan setelah BarangSeeder
    ]);
}
}