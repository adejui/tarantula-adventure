<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Item::insert([
            // Peralatan Camping
            [
                'category_id' => 1,
                'name' => 'Tenda Dome 4P',
                'code' => 'CMP-001',
                // 'condition' => 'new',
                'quantity' => 5,
                'description' => 'Tenda kapasitas 4 orang, tahan air dan mudah dipasang.',
            ],
            [
                'category_id' => 1,
                'name' => 'Sleeping Bag Polar',
                'code' => 'CMP-002',
                // 'condition' => 'good',
                'quantity' => 8,
                'description' => 'Sleeping bag hangat untuk kegiatan camping di suhu dingin.',
            ],
            [
                'category_id' => 1,
                'name' => 'Matras Lipat',
                'code' => 'CMP-003',
                // 'condition' => 'bad',
                'quantity' => 6,
                'description' => 'Matras lipat ringan dan mudah dibawa.',
            ],
            [
                'category_id' => 1,
                'name' => 'Lampu Camping',
                'code' => 'CMP-004',
                // 'condition' => 'good',
                'quantity' => 7,
                'description' => 'Lampu LED untuk penerangan tenda.',
            ],

            // Peralatan Mendaki
            [
                'category_id' => 2,
                'name' => 'Carrier 80L',
                'code' => 'MDK-001',
                // 'condition' => 'new',
                'quantity' => 4,
                'description' => 'Tas carrier besar untuk pendakian jarak jauh.',
            ],
            [
                'category_id' => 2,
                'name' => 'Trekking Pole',
                'code' => 'MDK-002',
                // 'condition' => 'broken',
                'quantity' => 3,
                'description' => 'Tongkat bantu untuk menjaga keseimbangan saat mendaki.',
            ],
            [
                'category_id' => 2,
                'name' => 'Sepatu Gunung',
                'code' => 'MDK-003',
                // 'condition' => 'good',
                'quantity' => 6,
                'description' => 'Sepatu anti selip untuk jalur terjal.',
            ],
            [
                'category_id' => 2,
                'name' => 'Gaiter Kaki',
                'code' => 'MDK-004',
                // 'condition' => 'bad',
                'quantity' => 5,
                'description' => 'Pelindung kaki dari lumpur dan air.',
            ],

            // Peralatan Memasak
            [
                'category_id' => 3,
                'name' => 'Kompor Portable',
                'code' => 'MSK-001',
                // 'condition' => 'good',
                'quantity' => 6,
                'description' => 'Kompor kecil untuk kegiatan luar ruangan.',
            ],
            [
                'category_id' => 3,
                'name' => 'Panci Set',
                'code' => 'MSK-002',
                // 'condition' => 'good',
                'quantity' => 8,
                'description' => 'Satu set panci aluminium ringan.',
            ],
            [
                'category_id' => 3,
                'name' => 'Spatula Kayu',
                'code' => 'MSK-003',
                // 'condition' => 'bad',
                'quantity' => 9,
                'description' => 'Peralatan memasak berbahan kayu tahan panas.',
            ],
            [
                'category_id' => 3,
                'name' => 'Kompor Gas Mini',
                'code' => 'MSK-004',
                // 'condition' => 'new',
                'quantity' => 4,
                'description' => 'Kompor gas mini isi ulang.',
            ],

            // Makan dan Minum
            [
                'category_id' => 4,
                'name' => 'Botol Minum',
                'code' => 'MKM-001',
                // 'condition' => 'good',
                'quantity' => 10,
                'description' => 'Botol air 1 liter berbahan BPA free.',
            ],
            [
                'category_id' => 4,
                'name' => 'Mangkuk Lipat',
                'code' => 'MKM-002',
                // 'condition' => 'broken',
                'quantity' => 2,
                'description' => 'Mangkuk silikon mudah dilipat.',
            ],
            [
                'category_id' => 4,
                'name' => 'Sendok Garpu Set',
                'code' => 'MKM-003',
                // 'condition' => 'bad',
                'quantity' => 6,
                'description' => 'Sendok dan garpu lipat dari stainless steel.',
            ],
            [
                'category_id' => 4,
                'name' => 'Termos Air Panas',
                'code' => 'MKM-004',
                // 'condition' => 'good',
                'quantity' => 5,
                'description' => 'Termos 1L untuk menjaga suhu minuman.',
            ],

            // Pakaian Lapangan
            [
                'category_id' => 5,
                'name' => 'Jaket Outdoor',
                'code' => 'PKN-001',
                // 'condition' => 'new',
                'quantity' => 3,
                'description' => 'Jaket tahan air dan angin.',
            ],
            [
                'category_id' => 5,
                'name' => 'Celana Taktis',
                'code' => 'PKN-002',
                // 'condition' => 'good',
                'quantity' => 6,
                'description' => 'Celana dengan banyak kantong untuk keperluan lapangan.',
            ],
            [
                'category_id' => 5,
                'name' => 'Topi Lapangan',
                'code' => 'PKN-003',
                // 'condition' => 'bad',
                'quantity' => 8,
                'description' => 'Topi lebar untuk melindungi dari matahari.',
            ],
            [
                'category_id' => 5,
                'name' => 'Sarung Tangan Outdoor',
                'code' => 'PKN-004',
                // 'condition' => 'good',
                'quantity' => 7,
                'description' => 'Sarung tangan anti slip.',
            ],

            // Peralatan Navigasi
            [
                'category_id' => 6,
                'name' => 'Kompas Silva',
                'code' => 'NVG-001',
                // 'condition' => 'good',
                'quantity' => 4,
                'description' => 'Kompas analog untuk orientasi arah.',
            ],
            [
                'category_id' => 6,
                'name' => 'GPS Garmin',
                'code' => 'NVG-002',
                // 'condition' => 'new',
                'quantity' => 3,
                'description' => 'GPS genggam untuk navigasi gunung.',
            ],
            [
                'category_id' => 6,
                'name' => 'Peta Topografi',
                'code' => 'NVG-003',
                // 'condition' => 'bad',
                'quantity' => 6,
                'description' => 'Peta kertas area gunung dan hutan.',
            ],
            [
                'category_id' => 6,
                'name' => 'Altimeter Analog',
                'code' => 'NVG-004',
                // 'condition' => 'good',
                'quantity' => 5,
                'description' => 'Pengukur ketinggian gunung manual.',
            ],

            // Peralatan Medis
            [
                'category_id' => 7,
                'name' => 'Kotak P3K',
                'code' => 'MDS-001',
                // 'condition' => 'good',
                'quantity' => 4,
                'description' => 'Kotak pertolongan pertama berisi obat dasar.',
            ],
            [
                'category_id' => 7,
                'name' => 'Perban Elastis',
                'code' => 'MDS-002',
                // 'condition' => 'bad',
                'quantity' => 5,
                'description' => 'Perban untuk luka atau keseleo.',
            ],
            [
                'category_id' => 7,
                'name' => 'Hand Sanitizer',
                'code' => 'MDS-003',
                // 'condition' => 'good',
                'quantity' => 8,
                'description' => 'Cairan antiseptik untuk kebersihan tangan.',
            ],
            [
                'category_id' => 7,
                'name' => 'Obat Luka Ringan',
                'code' => 'MDS-004',
                // 'condition' => 'broken',
                'quantity' => 3,
                'description' => 'Obat antiseptik dan plester.',
            ],

            // Dokumentasi
            [
                'category_id' => 8,
                'name' => 'Kamera DSLR',
                'code' => 'DKM-001',
                // 'condition' => 'good',
                'quantity' => 2,
                'description' => 'Kamera profesional untuk dokumentasi kegiatan.',
            ],
            [
                'category_id' => 8,
                'name' => 'Tripod Aluminium',
                'code' => 'DKM-002',
                // 'condition' => 'bad',
                'quantity' => 4,
                'description' => 'Tripod ringan dengan tinggi maksimal 1.5m.',
            ],
            [
                'category_id' => 8,
                'name' => 'Drone DJI Mini',
                'code' => 'DKM-003',
                // 'condition' => 'new',
                'quantity' => 3,
                'description' => 'Drone kecil untuk dokumentasi udara.',
            ],
            [
                'category_id' => 8,
                'name' => 'GoPro Hero 9',
                'code' => 'DKM-004',
                // 'condition' => 'good',
                'quantity' => 4,
                'description' => 'Kamera aksi tahan air.',
            ],

            // Lain-lain
            [
                'category_id' => 9,
                'name' => 'Kantong Sampah Besar',
                'code' => 'LLN-001',
                // 'condition' => 'good',
                'quantity' => 7,
                'description' => 'Kantong sampah besar untuk kegiatan outdoor.',
            ],
            [
                'category_id' => 9,
                'name' => 'Tambang Nilon 20m',
                'code' => 'LLN-002',
                // 'condition' => 'bad',
                'quantity' => 6,
                'description' => 'Tambang serbaguna untuk berbagai keperluan.',
            ],
            [
                'category_id' => 9,
                'name' => 'Gunting Serbaguna',
                'code' => 'LLN-003',
                // 'condition' => 'new',
                'quantity' => 5,
                'description' => 'Gunting kecil untuk keperluan darurat.',
            ],
            [
                'category_id' => 9,
                'name' => 'Payung Lipat',
                'code' => 'LLN-004',
                // 'condition' => 'broken',
                'quantity' => 3,
                'description' => 'Payung ringan untuk perlindungan hujan.',
            ],
        ]);
    }
}
