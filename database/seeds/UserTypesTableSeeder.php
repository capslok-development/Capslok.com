<?php

use Illuminate\Database\Seeder;

class UserTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_types')->insert(['name' => 'normal']);
        DB::table('user_types')->insert(['name' => 'moderator']);
        DB::table('user_types')->insert(['name' => 'administrator']);
        DB::table('user_types')->insert(['name' => 'politician']);
        DB::table('user_types')->insert(['name' => 'pending politician']);
    }
}
