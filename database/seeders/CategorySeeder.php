<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Makanan',
                'description' => 'Kategori untuk semua jenis makanan seperti nasi goreng, mie ayam, dll.'
            ],
            [
                'name' => 'Minuman',
                'description' => 'Kategori untuk semua jenis minuman seperti es teh, kopi, jus, dll.'
            ],
            [
                'name' => 'Snack',
                'description' => 'Kategori untuk makanan ringan dan cemilan'
            ],
            [
                'name' => 'Paket',
                'description' => 'Kategori untuk paket bundling makanan dan minuman'
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
