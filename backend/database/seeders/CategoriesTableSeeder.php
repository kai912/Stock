<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class categoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = DB::table('admins')->first(); 

        $names = ['肉', '魚', '野菜'];

        foreach($names as $name) {
            DB::table('categories')->insert([
                'name' => $name,
                'admin_id' => $admin->id,
                'created_at' =>  Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
