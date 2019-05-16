<?php

use Illuminate\Database\Seeder;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cities')->insert([
            'name' => 'Winnipeg',
        ]);
//        DB::table('cities')->insert([
//            'name' => 'Edmonton',
//        ]);
//        DB::table('cities')->insert([
//            'name' => 'Toronto',
//        ]);
//        DB::table('cities')->insert([
//            'name' => 'Vancouver',
//        ]);
    }
}
