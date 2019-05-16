<?php

use Illuminate\Database\Seeder;
use App\WardAddresses;
use App\Wards;


class WardAddressesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $testfile = 'public/datasets/ward_address_dataset.json';
        $listener = new \JsonStreamingParser\Listener\InMemoryListener();
        $stream = fopen($testfile, 'r');
        try {
            $parser = new \JsonStreamingParser\Parser($stream, $listener);
            $parser->parse();
            fclose($stream);
        } catch (Exception $e) {
            fclose($stream);
        }

        $res = $listener->getJson();
        $array = $res['data'];

        $addresses[] = null;

        echo '\n\nStarting seeder for ward addresses!\n';

        foreach($array as $item) {
            $wardAddress = new WardAddresses();
            $wardAddress->setHouseNumber($item[8]);
            $wardAddress->setStreetName($item[10]);
            $wardAddress->setStreetType($item[11]);
            $wardAddress->setNeighbourhood($item[15]);
            $wardAddress->setWardName($item[16]);
            $wardAddress->setWardId(Wards::where('name', $item[16])->first()['id']);
            if ($wardAddress->validate()) {
                $wardAddress->save();
            }
        }

        echo '\n\nCompleted seeding ward addresses!\n';
    }
}
