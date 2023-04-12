<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PartySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('parties')->insert(
            [
                [
                    'name' => "Super Signals",
                    'rules' => "Always keep to the purpose of the group! Don’t share irrelevant messages about other topics, don’t be offended if others leave. Not everyone wants the same information, please don’t send in a hundred “thank you” messages. If you feel gratitude towards someone – tell them in a private message.",
                ],
                [
                    'name' => "Power players",
                    'rules' => "Always keep to the purpose of the group! Don’t share irrelevant messages about other topics, don’t be offended if others leave. Not everyone wants the same information, please don’t send in a hundred “thank you” messages. If you feel gratitude towards someone – tell them in a private message.",
                ],
                [
                    'name' => "Teach us",
                    'rules' => "Always keep to the purpose of the group! Don’t share irrelevant messages about other topics, don’t be offended if others leave. Not everyone wants the same information, please don’t send in a hundred “thank you” messages. If you feel gratitude towards someone – tell them in a private message.",
                ],
                [
                    'name' => "On demand",
                    'rules' => "Always keep to the purpose of the group! Don’t share irrelevant messages about other topics, don’t be offended if others leave. Not everyone wants the same information, please don’t send in a hundred “thank you” messages. If you feel gratitude towards someone – tell them in a private message.",
                ],
                [
                    'name' => "Power Guides",
                    'rules' => "Always keep to the purpose of the group! Don’t share irrelevant messages about other topics, don’t be offended if others leave. Not everyone wants the same information, please don’t send in a hundred “thank you” messages. If you feel gratitude towards someone – tell them in a private message.",
                ]
            ]
        );
    }
}
