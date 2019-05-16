<?php

use Illuminate\Database\Seeder;

class WardsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('wards')->insert([
            'city' => 1,
            'name' => 'Old Kildonan',
        ]);
        DB::table('wards')->insert([
            'city' => 1,
            'name' => 'Mynarski',
        ]);
        DB::table('wards')->insert([
            'city' => 1,
            'name' => 'Point Douglas',
        ]);
        DB::table('wards')->insert([
            'city' => 1,
            'name' => 'Daniel McIntyre',
        ]);
        DB::table('wards')->insert([
            'city' => 1,
            'name' => 'St. James - Brooklands - Weston',
        ]);
        DB::table('wards')->insert([
            'city' => 1,
            'name' => 'St. Charles',
        ]);
        DB::table('wards')->insert([
            'city' => 1,
            'name' => 'Charleswood - Tuxedo - Whyte Ridge',
        ]);
        DB::table('wards')->insert([
            'city' => 1,
            'name' => 'River Heights - Fort Garry',
        ]);
        DB::table('wards')->insert([
            'city' => 1,
            'name' => 'Fort Rouge - East Fort Garry',
        ]);
        DB::table('wards')->insert([
            'city' => 1,
            'name' => 'South Winnipeg - St. Norbert',
        ]);
        DB::table('wards')->insert([
            'city' => 1,
            'name' => 'St. Vital',
        ]);
        DB::table('wards')->insert([
            'city' => 1,
            'name' => 'St. Boniface',
        ]);
        DB::table('wards')->insert([
            'city' => 1,
            'name' => 'Transcona',
        ]);
        DB::table('wards')->insert([
            'city' => 1,
            'name' => 'Elmwood - East Kildonan',
        ]);
        DB::table('wards')->insert([
            'city' => 1,
            'name' => 'North Kildonan',
        ]);
    }
}
