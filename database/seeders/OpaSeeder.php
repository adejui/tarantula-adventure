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
                'email' => 'joko.prasetyo@example.com',
            ],
            [
                'name' => 'Siti Rahmawati',
                'organization_name' => 'Pecinta Alam Lestari',
                'campus_name' => 'Universitas Negeri Yogyakarta',
                'phone_number' => '081245678901',
                'email' => 'siti.rahmawati@example.com',
            ],
            [
                'name' => 'Dimas Saputra',
                'organization_name' => 'Pecinta Alam Bumi Hijau',
                'campus_name' => 'Universitas Sanata Dharma',
                'phone_number' => '081245678902',
                'email' => 'dimas.saputra@example.com',
            ],
            [
                'name' => 'Ayu Lestari',
                'organization_name' => 'Pecinta Alam Rimba Raya',
                'campus_name' => 'Universitas Atma Jaya Yogyakarta',
                'phone_number' => '081245678903',
                'email' => 'ayu.lestari@example.com',
            ],
            [
                'name' => 'Bagas Pratama',
                'organization_name' => 'Pecinta Alam Gunung Jaya',
                'campus_name' => 'Universitas AMIKOM Yogyakarta',
                'phone_number' => '081245678904',
                'email' => 'bagas.pratama@example.com',
            ],
            [
                'name' => 'Indah Sari',
                'organization_name' => 'Pecinta Alam Puspa Langit',
                'campus_name' => 'Universitas Islam Indonesia',
                'phone_number' => '081245678905',
                'email' => 'indah.sari@example.com',
            ],
            [
                'name' => 'Rizky Nugroho',
                'organization_name' => 'Pecinta Alam Mandala',
                'campus_name' => 'Universitas Kristen Duta Wacana',
                'phone_number' => '081245678906',
                'email' => 'rizky.nugroho@example.com',
            ],
            [
                'name' => 'Putri Wulandari',
                'organization_name' => 'Pecinta Alam Satria Alam',
                'campus_name' => 'Universitas Muhammadiyah Yogyakarta',
                'phone_number' => '081245678907',
                'email' => 'putri.wulandari@example.com',
            ],
            [
                'name' => 'Andi Kurniawan',
                'organization_name' => 'Pecinta Alam Lentera Bumi',
                'campus_name' => 'Universitas PGRI Yogyakarta',
                'phone_number' => '081245678908',
                'email' => 'andi.kurniawan@example.com',
            ],
            [
                'name' => 'Nur Aisyah',
                'organization_name' => 'Pecinta Alam Cemara Rimba',
                'campus_name' => 'Universitas Ahmad Dahlan',
                'phone_number' => '081245678909',
                'email' => 'nur.aisyah@example.com',
            ],
            [
                'name' => 'Fajar Setiawan',
                'organization_name' => 'Pecinta Alam Langit Selatan',
                'campus_name' => 'Universitas Janabadra',
                'phone_number' => '081245678910',
                'email' => 'fajar.setiawan@example.com',
            ],
            [
                'name' => 'Lestari Anindita',
                'organization_name' => 'Pecinta Alam Beringin',
                'campus_name' => 'Universitas Sarjanawiyata Tamansiswa',
                'phone_number' => '081245678911',
                'email' => 'lestari.anindita@example.com',
            ],
        ]);
    }
}
