<?php

namespace Database\Seeders;

use App\Models\CategoryProduct;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void

        //
    {
        // Pastikan tabel kategori memiliki data sebelum membuat produk
        if (CategoryProduct::count() === 0) {
            // Opsional: Buat kategori jika belum ada
            DB::table('category_products')->insert([
                ['name' => 'Elektronik'],
                ['name' => 'Pakaian'],
                ['name' => 'Makanan'],
                ['name' => 'Aksesoris'],
            ]);
        }

        // Buat 100 record produk menggunakan ProductFactory
        Product::factory()->count(100)->create();

    }
}
