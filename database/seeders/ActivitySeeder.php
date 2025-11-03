<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Activity;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $activityTypes = ['meeting', 'basic training', 'exploration', 'anniversary', 'others'];
        $colors = ['danger', 'success', 'primary', 'warning'];

        $titles = [
            'Rapat Koordinasi Pendakian Gunung Lawu',
            'Diklat Dasar Angkatan XX',
            'Ekspedisi Gunung Merapi 2025',
            'Perayaan Ulang Tahun Mapala Tarantula ke-15',
            'Rapat Pembahasan Proposal Ekspedisi',
            'Diklat Fisik dan Survival Dasar',
            'Eksplorasi Goa Pindul Gunungkidul',
            'Peringatan Hari Pahlawan di Puncak Merbabu',
            'Pelatihan Navigasi Darat untuk Anggota Baru',
            'Rapat Akhir Tahun dan Evaluasi Kegiatan',
            'Pendakian Bersama Alumni Mapala Kampus',
            'Bakti Sosial ke Desa Lereng Sumbing'
        ];

        $locations = [
            'Gunung Lawu, Jawa Tengah',
            'Kampus Universitas Yogyakarta',
            'Gunung Merapi, Sleman',
            'Basecamp Mapala Tarantula',
            'Sekretariat Mapala Kampus',
            'Lapangan Fakultas Kehutanan',
            'Goa Pindul, Gunungkidul',
            'Gunung Merbabu, Magelang',
            'Hutan Wanagama, Gunung Kidul',
            'Aula Kampus Pusat',
            'Gunung Sumbing, Wonosobo',
            'Desa Pagergunung, Temanggung'
        ];

        $data = [];

        for ($i = 0; $i < 12; $i++) {
            // Pastikan hanya satu activity bertipe "others"
            if ($i == 11) {
                $type = 'others';
            } else {
                $type = $activityTypes[array_rand(array_slice($activityTypes, 0, 4))];
            }

            // Acak tanggal di bulan November–Desember 2025
            $start = Carbon::create(2025, rand(11, 12), rand(1, 25));
            $end = (clone $start)->addDays(rand(1, 5));

            $data[] = [
                'title' => $titles[$i],
                'activity_type' => $type,
                'color' => $colors[array_rand($colors)],
                'start_date' => $start,
                'end_date' => $end,
                'location' => $locations[$i],
                'description' => 'Kegiatan Mapala kampus untuk melatih dan mempererat solidaritas antaranggota.',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        Activity::insert($data);
    }
}
