<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class StocksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = DB::table('users')->first();
        
        $names = ['冷蔵庫', '冷凍庫', '常温'];

        foreach($names as $name) {
            DB::table('stocks')->insert([
                'name' => $name,
                'user_id' => $user->id,
                'created_at' =>  Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
