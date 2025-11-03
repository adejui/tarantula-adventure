<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Article;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $articles = [
            [
                'activity_id' => 1,
                'title' => 'Perjalanan Ekspedisi Gunung Merapi 2025',
                'slug' => Str::slug('Perjalanan Ekspedisi Gunung Merapi 2025'),
                'content' => '
                    <h2>Persiapan Ekspedisi</h2>
                    <p>Tim Mapala Tarantula melakukan persiapan selama dua minggu sebelum keberangkatan menuju Gunung Merapi. Persiapan meliputi pengecekan peralatan, logistik, dan pembagian tugas.</p>
                    <h3>Perlengkapan yang Dibawa</h3>
                    <ul>
                        <li>Tenda dome 4 orang</li>
                        <li>Kompor portable dan bahan bakar</li>
                        <li>Peta topografi dan kompas</li>
                    </ul>
                    <p>Cuaca di jalur Selo cukup bersahabat dan semua anggota tiba dengan selamat di puncak pada tanggal 12 November 2025.</p>
                ',
                'status' => 'published',
                'file_path' => null,
                'created_at' => Carbon::now()->subDays(10),
                'updated_at' => now(),
            ],
            [
                'activity_id' => 2,
                'title' => 'Diklat Dasar Angkatan XX: Menumbuhkan Jiwa Petualang',
                'slug' => Str::slug('Diklat Dasar Angkatan XX: Menumbuhkan Jiwa Petualang'),
                'content' => '
                    <h2>Tujuan Kegiatan</h2>
                    <p>Diklat Dasar ini bertujuan membentuk mental dan karakter calon anggota Mapala yang tangguh dan disiplin. Kegiatan berlangsung di Hutan Wanagama, Gunungkidul.</p>
                    <h3>Materi yang Diberikan</h3>
                    <ul>
                        <li>Dasar-dasar navigasi darat</li>
                        <li>Teknik survival di alam bebas</li>
                        <li>Etika lingkungan dan konservasi</li>
                    </ul>
                    <p>Peserta menunjukkan semangat luar biasa dalam mengikuti seluruh rangkaian kegiatan dari tanggal 15–20 November 2025.</p>
                ',
                'status' => 'published',
                'file_path' => null,
                'created_at' => Carbon::now()->subDays(7),
                'updated_at' => now(),
            ],
            [
                'activity_id' => null,
                'title' => 'Persiapan Rapat Akhir Tahun Mapala Kampus',
                'slug' => Str::slug('Persiapan Rapat Akhir Tahun Mapala Kampus'),
                'content' => '
                    <h2>Rencana Agenda</h2>
                    <p>Rapat akhir tahun akan membahas evaluasi kegiatan 2025 dan rencana kerja tahun 2026. Semua anggota diharapkan hadir untuk memberikan masukan konstruktif.</p>
                    <h3>Agenda Utama</h3>
                    <ol>
                        <li>Laporan kegiatan selama tahun 2025</li>
                        <li>Pemilihan ketua baru</li>
                        <li>Rencana ekspedisi tahun depan</li>
                    </ol>
                ',
                'status' => 'draft',
                'file_path' => null,
                'created_at' => Carbon::now()->subDays(3),
                'updated_at' => now(),
            ],
            [
                'activity_id' => null,
                'title' => 'Panduan Keselamatan Mendaki Gunung untuk Anggota Baru',
                'slug' => Str::slug('Panduan Keselamatan Mendaki Gunung untuk Anggota Baru'),
                'content' => '
                    <h2>Pentingnya Keselamatan</h2>
                    <p>Sebelum mendaki, setiap anggota Mapala wajib memahami prosedur keselamatan dasar agar kegiatan berjalan aman dan nyaman.</p>
                    <h3>Langkah-langkah Dasar</h3>
                    <ul>
                        <li>Periksa kondisi fisik dan perlengkapan sebelum berangkat.</li>
                        <li>Ikuti instruksi dari ketua tim.</li>
                        <li>Jangan memisahkan diri dari rombongan tanpa izin.</li>
                    </ul>
                    <p>Artikel ini masih dalam tahap penyuntingan sebelum diterbitkan di laman resmi Mapala Tarantula.</p>
                ',
                'status' => 'draft',
                'file_path' => null,
                'created_at' => Carbon::now()->subDays(1),
                'updated_at' => now(),
            ],
        ];

        Article::insert($articles);
    }
}
