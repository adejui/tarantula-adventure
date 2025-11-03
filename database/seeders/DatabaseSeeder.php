<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Database\Seeders\CategorySeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            OpaSeeder::class,
            CategorySeeder::class,
            ItemSeeder::class,
            LoanSeeder::class,
            LoanDetailSeeder::class,
            ActivitySeeder::class,
            ActivityMemberSeeder::class,
            ActivityDocumentSeeder::class,
            ArticleSeeder::class,
        ]);
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
