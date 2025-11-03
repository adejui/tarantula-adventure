<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Loan;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LoanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = ['requested', 'approved', 'borrowed', 'returned', 'rejected', 'late'];
        $loans = [];

        foreach ($statuses as $status) {
            // 2 data untuk setiap status
            for ($i = 0; $i < 2; $i++) {
                $hasUser = $i % 2 === 0; // gantian: satu pakai user_id, satu pakai opa_id
                $loans[] = [
                    'user_id' => $hasUser ? rand(1, 5) : null,   // sesuaikan ID user yang ada
                    'opa_id' => $hasUser ? null : rand(1, 5),    // sesuaikan ID opa yang ada
                    'borrow_date' => Carbon::now()->subDays(rand(1, 10)),
                    'return_date' => Carbon::now()->addDays(rand(1, 10)),
                    'status' => $status,
                    'notes' => fake()->sentence(),
                    'loan_document' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        Loan::insert($loans);
    }
}
