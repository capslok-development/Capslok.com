<?php

use Illuminate\Database\Seeder;

class PoliticiansPartySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('politicians_party')->insert(['name' => 'Conservative Party of Canada']);
        DB::table('politicians_party')->insert(['name' => 'Liberal Party of Canada']);
        DB::table('politicians_party')->insert(['name' => 'Bloc Québécois']);
        DB::table('politicians_party')->insert(['name' => 'New Democratic Party']);
        DB::table('politicians_party')->insert(['name' => 'Green Party of Canada']);
    }
}
