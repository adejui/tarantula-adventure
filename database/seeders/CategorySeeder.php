<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::insert([
            ['name' => 'Peralatan Camping'],
            ['name' => 'Peralatan Mendaki'],
            ['name' => 'Peralatan Memasak'],
            ['name' => 'Makan dan Minum'],
            ['name' => 'Pakaian Lapangan'],
            ['name' => 'Peralatan Navigasi'],
            ['name' => 'Peralatan Medis'],
            ['name' => 'Dokumentasi'],
            ['name' => 'Lain-lain'],
        ]);
    }
}
