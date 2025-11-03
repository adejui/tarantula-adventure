<?php

namespace Database\Seeders;

use App\Models\ActivityMember;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ActivityMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [];

        // Misal ada 12 activity (dari ActivitySeeder sebelumnya)
        // dan user_id antara 1–8
        for ($activityId = 1; $activityId <= 12; $activityId++) {
            // Tiap activity punya 2–5 anggota acak
            $memberCount = rand(2, 5);
            $userIds = collect(range(1, 8))->shuffle()->take($memberCount);

            foreach ($userIds as $userId) {
                $data[] = [
                    'activity_id' => $activityId,
                    'user_id' => $userId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        ActivityMember::insert($data);
    }
}
