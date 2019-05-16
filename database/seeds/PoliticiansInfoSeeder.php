<?php

use Illuminate\Database\Seeder;

class PoliticiansInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

//        /* municipal */
//        DB::table('politicians_info')->insert([
//            'user_id'           => 1,
//            'profile_type_id'   => 2,
//            'party_id'          => 1,           /* Conservative Party of Canada */
//            'city'              => 'Winnipeg',
//            'province'          => 'MB',
//            'ward_id'           => 7,
//            'aboutme'           => "1 This is my about me section, lorem ipsum and so on.",
//        ]);
//
//        DB::table('politicians_info')->insert([
//            'user_id'           => 2,
//            'profile_type_id'   => 2,
//            'party_id'          => 2,           /* Liberal Party of Canada */
//            'city'              => 'Winnipeg',
//            'province'          => 'MB',
//            'ward_id'           => 1,
//            'aboutme'           => "2 This is my about me section, lorem ipsum and so on.",
//        ]);
//
//        DB::table('politicians_info')->insert([
//            'user_id'           => 3,
//            'profile_type_id'   => 2,
//            'party_id'          => 3,           /* Bloc Québécois */
//            'city'              => 'Winnipeg',
//            'province'          => 'MB',
//            'ward_id'           => 1,
//            'aboutme'           => "3 This is my about me section, lorem ipsum and so on.",
//        ]);
//
//        DB::table('politicians_info')->insert([
//            'user_id'           => 4,
//            'profile_type_id'   => 2,
//            'party_id'          => 4,           /* New Democratic Party */
//            'city'              => 'Winnipeg',
//            'province'          => 'MB',
//            'ward_id'           => 1,
//            'aboutme'           => "4 This is my about me section, lorem ipsum and so on.",
//        ]);
//
//        /* city council */
//        DB::table('politicians_info')->insert([
//            'user_id'           => 5,
//            'profile_type_id'   => 1,
//            'party_id'          => 1,           /* Conservative Party of Canada */
//            'city'              => 'Edmonton',
//            'province'          => 'AB',
//            'ward_id'           => 1,
//            'aboutme'           => "This is my about me section, lorem ipsum and so on.",
//        ]);
//
//        DB::table('politicians_info')->insert([
//            'user_id'           => 6,
//            'profile_type_id'   => 1,
//            'party_id'          => 2,           /* Liberal Party of Canada */
//            'city'              => 'Edmonton',
//            'province'          => 'AB',
//            'ward_id'           => 1,
//            'aboutme'           => "This is my about me section, lorem ipsum and so on.",
//        ]);
//
//        DB::table('politicians_info')->insert([
//            'user_id'           => 7,
//            'profile_type_id'   => 1,
//            'party_id'          => 3,           /* Bloc Québécois */
//            'city'              => 'Edmonton',
//            'province'          => 'AB',
//            'ward_id'           => 1,
//            'aboutme'           => "This is my about me section, lorem ipsum and so on.",
//        ]);
//
//        DB::table('politicians_info')->insert([
//            'user_id'           => 8,
//            'profile_type_id'   => 1,
//            'party_id'          => 4,           /* New Democratic Party */
//            'city'              => 'Edmonton',
//            'province'          => 'AB',
//            'ward_id'           => 1,
//            'aboutme'           => "This is my about me section, lorem ipsum and so on.",
//        ]);
//
//        DB::table('politicians_info')->insert([
//            'user_id'           => 24,
//            'profile_type_id'   => 1,
//            'party_id'          => 4,           /* New Democratic Party */
//            'city'              => 'Edmonton',
//            'province'          => 'AB',
//            'ward_id'           => 1,
//            'aboutme'           => "This is my about me section, lorem ipsum and so on.",
//        ]);
//
//        DB::table('politicians_info')->insert([
//            'user_id'           => 25,
//            'profile_type_id'   => 1,
//            'party_id'          => 4,           /* New Democratic Party */
//            'city'              => 'Edmonton',
//            'province'          => 'AB',
//            'ward_id'           => 1,
//            'aboutme'           => "This is my about me section, lorem ipsum and so on.",
//        ]);
//
//        /* provincial */
//        DB::table('politicians_info')->insert([
//            'user_id'           => 9,
//            'profile_type_id'   => 3,
//            'party_id'          => 1,           /* Conservative Party of Canada */
//            'city'              => 'Toronto',
//            'province'          => 'ON',
//            'ward_id'           => 1,
//            'aboutme'           => "This is my about me section, lorem ipsum and so on.",
//        ]);
//
//        DB::table('politicians_info')->insert([
//            'user_id'           => 10,
//            'profile_type_id'   => 3,
//            'party_id'          => 2,           /* Liberal Party of Canada */
//            'city'              => 'Toronto',
//            'province'          => 'ON',
//            'ward_id'           => 1,
//            'aboutme'           => "This is my about me section, lorem ipsum and so on.",
//        ]);
//
//        DB::table('politicians_info')->insert([
//            'user_id'           => 11,
//            'profile_type_id'   => 3,
//            'party_id'          => 3,           /* Bloc Québécois */
//            'city'              => 'Toronto',
//            'province'          => 'ON',
//            'ward_id'           => 1,
//            'aboutme'           => "This is my about me section, lorem ipsum and so on.",
//        ]);
//
//        DB::table('politicians_info')->insert([
//            'user_id'           => 12,
//            'profile_type_id'   => 3,
//            'party_id'          => 4,           /* New Democratic Party */
//            'city'              => 'Toronto',
//            'province'          => 'ON',
//            'ward_id'           => 1,
//            'aboutme'           => "This is my about me section, lorem ipsum and so on.",
//        ]);
//
//        /* Federal */
//        DB::table('politicians_info')->insert([
//            'user_id'           => 16,
//            'profile_type_id'   => 4,
//            'party_id'          => 1,           /* Conservative Party of Canada */
//            'city'              => 'Vancouver',
//            'province'          => 'BC',
//            'ward_id'           => 1,
//            'aboutme'           => "This is my about me section, lorem ipsum and so on.",
//        ]);
//
//        DB::table('politicians_info')->insert([
//            'user_id'           => 13,
//            'profile_type_id'   => 4,
//            'party_id'          => 2,           /* Liberal Party of Canada */
//            'city'              => 'Vancouver',
//            'province'          => 'BC',
//            'ward_id'           => 1,
//            'aboutme'           => "This is my about me section, lorem ipsum and so on.",
//        ]);
//
//        DB::table('politicians_info')->insert([
//            'user_id'           => 14,
//            'profile_type_id'   => 4,
//            'party_id'          => 3,           /* Bloc Québécois */
//            'city'              => 'Vancouver',
//            'province'          => 'BC',
//            'ward_id'           => 1,
//            'aboutme'           => "This is my about me section, lorem ipsum and so on.",
//        ]);
//
//        DB::table('politicians_info')->insert([
//            'user_id'           => 15,
//            'profile_type_id'   => 4,
//            'party_id'          => 4,           /* New Democratic Party */
//            'city'              => 'Vancouver',
//            'province'          => 'BC',
//            'ward_id'           => 1,
//            'aboutme'           => "This is my about me section, lorem ipsum and so on.",
//        ]);
//
//        // Pending politician
//        DB::table('politicians_info')->insert([
//            'user_id'           => 20,
//            'profile_type_id'   => 4,
//            'party_id'          => 4,           /* New Democratic Party */
//            'city'              => 'Vancouver',
//            'province'          => 'BC',
//            'ward_id'           => 1,
//            'aboutme'           => "This is my about me section, lorem ipsum and so on.",
//        ]);
    }
}
