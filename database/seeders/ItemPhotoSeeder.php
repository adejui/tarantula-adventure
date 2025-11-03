<?php

namespace Database\Seeders;

use App\Models\ItemPhoto;
use Illuminate\Support\Arr;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ItemPhotoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil semua file foto di storage/app/public/items
        $photoFiles = [
            'items/product-01.jpg',
            'items/product-02.jpg',
            'items/product-03.jpg',
            'items/product-04.jpg',
            'items/product-05.jpg',
        ];

        $data = [];

        // Misal setiap item (1–10) punya 1–3 foto acak
        for ($itemId = 1; $itemId <= 10; $itemId++) {
            $photoCount = rand(1, 3);

            for ($i = 0; $i < $photoCount; $i++) {
                $data[] = [
                    'item_id' => $itemId,
                    'photo_path' => 'storage/' . Arr::random($photoFiles),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        ItemPhoto::insert($data);
    }
}
