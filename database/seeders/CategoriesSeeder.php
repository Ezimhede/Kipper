<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // populate the categories table
        DB::table('categories')->insert([
            'name' => 'Bank Cards'
        ]);
        DB::table('categories')->insert([
            'name' => 'Passports'
        ]);
        DB::table('categories')->insert([
            'name' => 'Vehicle Papers'
        ]);
        DB::table('categories')->insert([
            'name' => 'Driver\'s license'
        ]);
        DB::table('categories')->insert([
            'name' => 'Others'
        ]);
    }
}
