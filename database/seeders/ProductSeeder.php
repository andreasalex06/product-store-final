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
        if (CategoryProduct::count() === 0) {
            DB::table('category_products')->insert([
                ['name' => 'Elektronik'],
                ['name' => 'Pakaian'],
                ['name' => 'Makanan'],
                ['name' => 'Aksesoris'],
            ]);
        }

        // Buat 100 record produk 
        Product::factory()->count(100)->create();

    }
}
