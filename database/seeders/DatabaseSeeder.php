<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Crime;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        for ($i = 0; $i < 100; $i++) {
            Crime::create([
                'name' => 'Crime ' . $i,
                'details' => 'Details ' . $i,
                'date' => now()->subDays(rand(0, 30))->format('Y-m-d'),
                'zilla_id' => 1,
                'thana_id' => 1,
                'union_id' => rand(3,4),
                'crime_type' => ['red', 'green', 'blue'][rand(0, 2)],
            ]);
        }
    }
}
