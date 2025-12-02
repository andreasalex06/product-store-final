<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Panggil seeder kategori terlebih dahulu (jika Anda membuatnya terpisah)
        // Jika Anda menggunakan logika di ProductSeeder, Anda bisa lewati ini.
        // $this->call([CategoryProductSeeder::class]);

        $this->call([
            ProductSeeder::class, // Panggil seeder produk
        ]);
    }

}
