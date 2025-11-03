<?php

namespace Database\Seeders;

use App\Models\Opa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OpaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Opa::insert([
            [
                'name' => 'Joko Prasetyo',
                'organization_name' => 'Pecinta Alam Arunika',
                'campus_name' => 'Universitas Gadjah Mada',
                'phone_number' => '081245678900',
                'address' => 'Jl. Kaliurang No. 12, Sleman',
            ],
            [
                'name' => 'Siti Rahmawati',
                'organization_name' => 'Pecinta Alam Lestari',
                'campus_name' => 'Universitas Negeri Yogyakarta',
                'phone_number' => '081245678901',
                'address' => 'Jl. Affandi No. 45, Yogyakarta',
            ],
            [
                'name' => 'Dimas Saputra',
                'organization_name' => 'Pecinta Alam Bumi Hijau',
                'campus_name' => 'Universitas Sanata Dharma',
                'phone_number' => '081245678902',
                'address' => 'Jl. Gejayan No. 30, Sleman',
            ],
            [
                'name' => 'Ayu Lestari',
                'organization_name' => 'Pecinta Alam Rimba Raya',
                'campus_name' => 'Universitas Atma Jaya Yogyakarta',
                'phone_number' => '081245678903',
                'address' => 'Jl. Babarsari No. 21, Yogyakarta',
            ],
            [
                'name' => 'Bagas Pratama',
                'organization_name' => 'Pecinta Alam Gunung Jaya',
                'campus_name' => 'Universitas AMIKOM Yogyakarta',
                'phone_number' => '081245678904',
                'address' => 'Jl. Ringroad Utara No. 9, Sleman',
            ],
            [
                'name' => 'Indah Sari',
                'organization_name' => 'Pecinta Alam Puspa Langit',
                'campus_name' => 'Universitas Islam Indonesia',
                'phone_number' => '081245678905',
                'address' => 'Jl. Kaliurang Km 14, Sleman',
            ],
            [
                'name' => 'Rizky Nugroho',
                'organization_name' => 'Pecinta Alam Mandala',
                'campus_name' => 'Universitas Kristen Duta Wacana',
                'phone_number' => '081245678906',
                'address' => 'Jl. Dr. Wahidin Sudirohusodo No. 15, Yogyakarta',
            ],
            [
                'name' => 'Putri Wulandari',
                'organization_name' => 'Pecinta Alam Satria Alam',
                'campus_name' => 'Universitas Muhammadiyah Yogyakarta',
                'phone_number' => '081245678907',
                'address' => 'Jl. Lingkar Selatan No. 18, Bantul',
            ],
            [
                'name' => 'Andi Kurniawan',
                'organization_name' => 'Pecinta Alam Lentera Bumi',
                'campus_name' => 'Universitas PGRI Yogyakarta',
                'phone_number' => '081245678908',
                'address' => 'Jl. IKIP PGRI No. 5, Sonosewu, Bantul',
            ],
            [
                'name' => 'Nur Aisyah',
                'organization_name' => 'Pecinta Alam Cemara Rimba',
                'campus_name' => 'Universitas Ahmad Dahlan',
                'phone_number' => '081245678909',
                'address' => 'Jl. Kapas No. 17, Umbulharjo, Yogyakarta',
            ],
            [
                'name' => 'Fajar Setiawan',
                'organization_name' => 'Pecinta Alam Langit Selatan',
                'campus_name' => 'Universitas Janabadra',
                'phone_number' => '081245678910',
                'address' => 'Jl. Tentara Rakyat Mataram No. 29, Yogyakarta',
            ],
            [
                'name' => 'Lestari Anindita',
                'organization_name' => 'Pecinta Alam Beringin',
                'campus_name' => 'Universitas Sarjanawiyata Tamansiswa',
                'phone_number' => '081245678911',
                'address' => 'Jl. Kusumanegara No. 67, Yogyakarta',
            ],
        ]);
    }
}
