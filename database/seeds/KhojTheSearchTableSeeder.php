<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KhojTheSearchTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('khoj_the_searches')->insert([
            [
                'input_values' => "11, 9, 7, 5, 0",
                'user_id' => 1,
            ],
            [
                'input_values' => "100, 89, 79, 69, 9",
                'user_id' => 1,
            ],

        ]);
    }
}
