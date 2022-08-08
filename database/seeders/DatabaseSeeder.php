<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@test.com',
        ]);

        $faker = Faker::create();

        for ($i = 1; $i <= 20; $i++) {
            Product::create([
                'sn' => "PRD" . str_pad($i, 7, '0', STR_PAD_LEFT),
                'name' => $faker->word(),
                'desc' => $faker->sentence(12),
                'price' => $faker->numberBetween(1, 50),
                'stock' => $faker->numberBetween(1, 50)
            ]);
        }
    }
}
