<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ShoppingListsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(range(1, 3) as $num) {
            DB::table('shopping_lists')->insert([
            'user_id' => 1,
            'food_id' => $num,
            'quantity' => $num,
            'priority' => $num,
            'memo' => "memo{$num}",
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ]);

        }
    }
}
