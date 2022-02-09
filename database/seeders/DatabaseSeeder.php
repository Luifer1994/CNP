<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //User
        \App\Models\User::factory(1)->create();

        //Products
        $json = '[
            {
                "name": "JABON BAR AZULK*250GR  ACC SUAV",
                "cod" : 4904,
                "ref": "7702310014168"
            },
            {
                "name": "CAFE COLCAFE *50GR GRANULADO",
                "cod" : 533,
                "ref": "7702032253258"
            }
            ]';
        $products = json_decode($json);
        foreach ($products as $product) {

            DB::table('products')->insert([
                "cod" => $product->cod,
                "name" => $product->name,
                "id_reference" => $product->ref,
                "created_at" => now(),
                "updated_at" => now(),
            ]);
        }

        //Center OP
        DB::table('center_operations')->insert([
            "cod" => 101,
            "name" => "PRADO",
            "created_at" => now(),
            "updated_at" => now(),
        ]);
    }
}