<?php

namespace Database\Factories;

use App\Models\CategoryProduct;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Product::class;

    public function definition(): array
    {
        $title = fake()->words('2', true); // Buat judul palsu

        return [
            'name' => $title,
            'description' => fake()->paragraphs(3, true), // Paragraf lebih panjang
            'price' => fake()->numberBetween(50000, 5000000), // Harga acak antara 50rb sampai 5jt

            // Foreign Key: Ambil ID Kategori secara acak
            'category_product_id' => CategoryProduct::inRandomOrder()->first()->id,
        ];
    }
}
