<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class FoodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('foods')->insert([
            'category_id' => 1,
            'name' => "鶏むね肉",
            'volume' => 100,
            'unit' => 'g',
            'protein' => 22.3,
            'fat' => 1.5,
            'carbohydrate' => 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('foods')->insert([
            'category_id' => 1,
            'name' => "鶏もも肉",
            'volume' => 100,
            'unit' => 'g',
            'protein' => 16.2,
            'fat' => 14,
            'carbohydrate' => 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        
    }
}
