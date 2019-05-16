<?php

use Illuminate\Database\Seeder;

class ProfileTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // For actual site
        DB::table('profile_types')->insert(['type' => 'City Council', 'enabled' => 1]);
        DB::table('profile_types')->insert(['type' => 'Mayoral', 'enabled' => 1]);
        DB::table('profile_types')->insert(['type' => 'Provincial', 'enabled' => 0]);
        DB::table('profile_types')->insert(['type' => 'Federal', 'enabled' => 0]);
    }
}
