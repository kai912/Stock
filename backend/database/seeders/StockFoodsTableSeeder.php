<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class StockFoodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $food = DB::table('foods')->first();
        $stock = DB::table('stocks')->first();

        foreach(range(1, 2) as $num) {
            DB::table('stock_foods')->insert([
                'stock_id'=> $stock->id,
                'food_id' => $food->id,
                'count' => $num,
                'register_date' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
