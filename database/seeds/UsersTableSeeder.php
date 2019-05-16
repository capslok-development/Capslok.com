<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\User;
use App\PoliticiansInfo;
use App\Wards;
use App\Stance;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

//        echo '\n\nStarting Users seeder';
//
//        $testfile = 'public/datasets/candidates.json';
//        $listener = new \JsonStreamingParser\Listener\InMemoryListener();
//        $stream = fopen($testfile, 'r');
//        try {
//            $parser = new \JsonStreamingParser\Parser($stream, $listener);
//            $parser->parse();
//            fclose($stream);
//        } catch (Exception $e) {
//            fclose($stream);
//        }
//
//        $res = $listener->getJson();
//        $array = $res['data'];
//
//        $addresses[] = null;
//
//        echo '\n\nStarting Users seeder 2';
//
//        foreach($array as $item) {
//            if (!in_array($item[9], ['Mayor', 'Councillor'])) {
//                break;
//            }
//
//            $name = explode(' ', $item[8]);
//            $user = new User();
//            $user->setAttribute('first_name', $name[0]);
//            $user->setAttribute('last_name', $name[1]);
//            $user->setAttribute('user_type', 4);
//            $user->save();
//
//
//            $candidateType = $item[9] == "Mayor" ? 2 : 1;
//            $politicianInfo = new PoliticiansInfo();
//            $politicianInfo->user_id = $user->id;
//            $politicianInfo->profile_type_id = $candidateType;
//            if($candidateType == 1) {
//                $ward = Wards::where('name', 'like', '%'.$item[10].'%')->first();
//                if(empty($ward)) {
//                    $user->delete();
//                    break;
//                }
//                $politicianInfo->ward_id = $ward->id;
//            }
//            $politicianInfo->save();
//
//
//            Stance::create([
//                'title' => 'Add title or slogan',
//                'content' => 'What are your stances?',
//                'user_id' => $user->id
//            ]);
//
//        }

        // Admin user
        DB::table('users')->insert([
            'user_name'             => 'admin-user',
            'password'              => bcrypt('testpass'),
            'first_name'            => 'Admin',
            'last_name'             => 'User',
            'email'                 => 'admin@user.com',
            'user_type'             => 3,                                       /* admin */
            'date_of_birth'         => Carbon::createFromDate(1986, 4, 9, 0),   /* Apr 9, 1986 */
            'profile_pic_path'      => 'images/user-img-placeholder.jpg',
            'background_pic_path'   => 'images/bg-img-placeholder.png',
            'account_locked'        => 0,
            'verified'              => 1,
            'approved'              => 1,
            'frozen'                => 0,
        ]);

        // Moderator user
        DB::table('users')->insert([
            'user_name'             => 'moderator-user',
            'password'              => bcrypt('testpass'),
            'first_name'            => 'Moderator',
            'last_name'             => 'User',
            'email'                 => 'moderator@user.com',
            'user_type'             => 2,                                       /* moderator */
            'date_of_birth'         => Carbon::createFromDate(1986, 4, 9, 0),   /* Apr 9, 1986 */
            'profile_pic_path'      => 'images/user-img-placeholder.jpg',
            'background_pic_path'   => 'images/bg-img-placeholder.png',
            'account_locked'        => 0,
            'verified'              => 1,
            'approved'              => 1,
            'frozen'                => 0,
        ]);

        // Normal user
        DB::table('users')->insert([
            'user_name'             => 'normal-user',
            'password'              => bcrypt('testpass'),
            'first_name'            => 'Normal',
            'last_name'             => 'User',
            'email'                 => 'normal@user.com',
            'user_type'             => 1,                                       /* normal */
            'date_of_birth'         => Carbon::createFromDate(1986, 4, 9, 0),   /* Apr 9, 1986 */
            'profile_pic_path'      => 'images/user-img-placeholder.jpg',
            'background_pic_path'   => 'images/bg-img-placeholder.png',
            'account_locked'        => 0,
            'verified'              => 0,
            'approved'              => 0,
            'frozen'                => 0,
        ]);

        echo '\n\nCompleted seeding users addresses!\n';
    }
}
