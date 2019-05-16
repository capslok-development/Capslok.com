<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    protected $toTruncate = ['cities', 'contactus', 'politicians_info', 'politicians_party', 'profile_types', 'stances',
        'user_contact_info', 'user_types', 'users', 'wards', 'ward_addresses'];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach($this->toTruncate as $table) {
            DB::table($table)->truncate();
        }

        $this->call(WardsTableSeeder::class);
        $this->call(UserTypesTableSeeder::class);
        $this->call(ProfileTypesSeeder::class);
        $this->call(PoliticiansPartySeeder::class);
//        $this->call(PoliticiansInfoSeeder::class);
        $this->call(UsersTableSeeder::class);
//        $this->call(StancesTableSeeder::class);
        $this->call(CitiesTableSeeder::class);
//        $this->call(ContactInfoSeeder::class);
        $this->call(WardAddressesTableSeeder::class);
    }
}
