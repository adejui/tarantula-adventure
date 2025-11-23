<?php

namespace Database\Seeders;

use App\Models\ActivityDocument;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ActivityDocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // // $photos = [
        // //     'documentations/image-01.png',
        // //     'documentations/image-02.png',
        // //     'documentations/image-03.png',
        // //     'documentations/image-04.png',
        // //     'documentations/image-05.png',
        // //     'documentations/image-06.png',
        // // ];

        // $data = [];
        // $activityCount = 12; // sesuaikan dengan jumlah data di tabel activities

        // foreach (range(1, $activityCount) as $activityId) {
        //     // Setiap activity punya 1–2 dokumentasi
        //     $photoCount = rand(1, 2);

        //     // Ambil acak 1 atau 2 foto dari array
        //     // $keys = array_rand($photos, $photoCount);
        //     // if (!is_array($keys)) {
        //     //     $keys = [$keys]; // ubah ke array agar foreach tetap bisa jalan
        //     // }

        //     foreach ($keys as $key) {
        //         $data[] = [
        //             'activity_id' => $activityId,
        //             // 'photo_path' => 'storage/' . $photos[$key],
        //             'google_drive_link' => 'https://drive.google.com/example-' . $activityId,
        //             'created_at' => now(),
        //             'updated_at' => now(),
        //         ];
        //     }
        // }

        // ActivityDocument::insert($data);


        $data = [];
        $activityCount = 12; // jumlah activity di tabel

        foreach (range(1, $activityCount) as $activityId) {

            // Setiap activity memiliki 1–2 dokumentasi
            $photoCount = rand(1, 2);

            for ($i = 0; $i < $photoCount; $i++) {
                $data[] = [
                    'activity_id' => $activityId,
                    'google_drive_link' => 'https://drive.google.com/example-' . $activityId . '-' . ($i + 1),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        ActivityDocument::insert($data);
    }
}
