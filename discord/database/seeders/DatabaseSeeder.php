<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            PartySeeder::class,
            GameSeeder::class,
            UserSeeder::class,
        ]);

        \App\Models\User::factory(10)->create();
        \App\Models\Message::factory(20)->create();
    }
}
