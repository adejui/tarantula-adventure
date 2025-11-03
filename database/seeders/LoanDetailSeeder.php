<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LoanDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $details = [];
        $conditions = ['good', 'fair', 'broken'];

        // Loan ID 1 punya 4 detail barang
        for ($i = 1; $i <= 4; $i++) {
            $details[] = [
                'loan_id' => 1,
                'item_id' => rand(1, 10), // sesuaikan jumlah item di tabel items
                'condition_on_return' => $conditions[array_rand($conditions)],
                'notes' => fake()->sentence(),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // 8 data sisanya untuk loan lain
        for ($i = 0; $i < 8; $i++) {
            $details[] = [
                'loan_id' => rand(2, 6), // sesuaikan jumlah loan di tabel loans
                'item_id' => rand(1, 10),
                'condition_on_return' => $conditions[array_rand($conditions)],
                'notes' => fake()->sentence(),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('loan_details')->insert($details);
    }
}
