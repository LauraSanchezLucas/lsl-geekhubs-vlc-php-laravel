<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('games')->insert(
            [
            [
                'name' => "The Legend of Zelda",
                'platform' => "Nintendo 64",
            ],
            [
                'name' => "Grand Theft Auto",
                'platform' => "all platforms",
            ],
            [
                'name' => "Super Mario Galaxy",
                'platform' => "Wii",
            ],
            [
                'name' => "Rayman",
                'platform' => "playstation",
            ],
            [
                'name' => "Tombi",
                'platform' => "playstation",
            ]
            ]
        );
    }
}
