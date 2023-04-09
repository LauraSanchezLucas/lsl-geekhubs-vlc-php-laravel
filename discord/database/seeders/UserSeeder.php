<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert(
            [
            [
                "id"=>1,  
                "name" => "Laura",
                "surname"=> "Sanchez",
                "email"=> "laura@laura.com",
                "password"=>encrypt("123456"),
                "age"=> "37",
                "direction"=> "Mas camarena",
                "phone"=> "+34675851486",
                "role_id"=>1
            ],
            [
                "id"=>2,  
                "name" => "Alvaro",
                "surname"=> "Bernabe",
                "email"=> "alvaro@alvaro.com",
                "password"=>encrypt("123456"),
                "age"=> "35",
                "direction"=> "Valencia",
                "phone"=> "+34675851246",
                "role_id"=>2
            ],
            [   
                "id"=>3,  
                "name" => "Maria",
                "surname"=> "Martinez",
                "email"=> "maria@maria.com",
                "password"=>encrypt("123456"),
                "age"=> "27",
                "direction"=> "Alicante",
                "phone"=> "+34671551486",
                "role_id"=>2
            ],
            ]
        );
    }
}
