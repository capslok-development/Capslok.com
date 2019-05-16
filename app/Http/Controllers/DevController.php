<?php

namespace App\Http\Controllers;

use App\MapsUrl;
use App\Stance;
use App\UserType;
use App\Wards;
use \DB;
use Illuminate\Http\Response;
use SimpleXMLElement;
use App\User;
use App\PoliticiansInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;

class DevController extends Controller
{
    public $numAllUsers = 0;
    public $numNormalUsers = 0;
    public $numModeratorUsers = 0;
    public $numAdminUsers = 0;
    public $numPoliticianUsers = 0;
    public $numPendingPoliticianUsers = 0;
    public $numNonRegisteredPoliticianUsers = 0;

    public $allUserCounts = [];
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

        $this->numAllUsers = User::all()->count();
        $this->numNormalUsers = User::where('user_type', 1)->count();
        $this->numModeratorUsers = User::where('user_type', 2)->count();
        $this->numAdminUsers = User::where('user_type', 3)->count();
        $this->numPoliticianUsers = User::where([['user_type', 4], ['candidate_has_joined', 1]])->count();
        $this->numPendingPoliticianUsers = User::where('user_type', 5)->count();
        $this->numNonRegisteredPoliticianUsers = User::where([['user_type', 4], ['candidate_has_joined', 0]])->count();

        $this->allUserCounts = [
            $this->numAllUsers,
            $this->numNormalUsers,
            $this->numModeratorUsers,
            $this->numAdminUsers,
            $this->numPoliticianUsers,
            $this->numPendingPoliticianUsers,
            $this->numNonRegisteredPoliticianUsers
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function userlisting() {
        $users = User::sortable()->paginate(15);
        $user_types = UserType::all();
        $filter = 0;
        $user_counts = $this->allUserCounts;

        return view('home')->with(compact('users', 'user_types', 'filter', 'user_counts'));
    }

    public function regularuserlisting() {
        $users = User::where('user_type', 1)->sortable()->paginate(15);
        $user_types = UserType::all();
        $filter = 1;
        $user_counts = $this->allUserCounts;

        return view('home')->with(compact('users', 'user_types', 'filter', 'user_counts'));
    }

    public function moderatoruserlisting() {
        $users = User::where('user_type', 2)->sortable()->paginate(15);
        $user_types = UserType::all();
        $filter = 2;
        $user_counts = $this->allUserCounts;

        return view('home')->with(compact('users', 'user_types', 'filter', 'user_counts'));
    }

    public function adminuserlisting() {
        $users = User::where('user_type', 3)->sortable()->paginate(15);
        $user_types = UserType::all();
        $filter = 3;
        $user_counts = $this->allUserCounts;

        return view('home')->with(compact('users', 'user_types', 'filter', 'user_counts'));
    }

    public function politicianuserlisting() {
        $users = User::where([['user_type', 4], ['candidate_has_joined', 1]])->sortable()->paginate(15);
        $user_types = UserType::all();
        $filter = 4;
        $user_counts = $this->allUserCounts;

        return view('home')->with(compact('users', 'user_types', 'filter', 'user_counts'));
    }

    public function pendingpoliticianuserlisting() {
        $users = User::where('user_type', 5)->sortable()->paginate(15);
        $user_types = UserType::all();
        $filter = 5;
        $user_counts = $this->allUserCounts;

        return view('home')->with(compact('users', 'user_types', 'filter', 'user_counts'));
    }

    public function nonRegisteredPoliticianslisting() {
        $users = User::where([['user_type', 4], ['candidate_has_joined', 0]])->sortable()->paginate(15);
        $user_types = UserType::all();
        $filter = 6;
        $user_counts = $this->allUserCounts;

        return view('home')->with(compact('users', 'user_types', 'filter', 'user_counts'));
    }

    public function updateCandidates() {
        if (Auth::user()->user_type != 3) {
            return view('home');
        } else {
            return view('admin.updateCandidates');
        }
    }

    public function processNewCandidates(Request $request) {
        if (Auth::user()->user_type != 3) {
            return view('home');
        }

        $file = Input::file('kml_file')->openFile();
        $xml = simplexml_load_string($file->fread($file->getSize()));
        $json = json_decode(json_encode($xml));

        $candidatesJson = $json->Document->Folder->Placemark;
        $candidates = [];

        foreach ($candidatesJson as $c) {
            $fullName = explode(" ", $c->ExtendedData->Data[2]->value);
            $candidate = [
                'first_name' => count($fullName) > 2 ? $fullName[0].' '.$fullName[1] : $fullName[0],
                'last_name' => count($fullName) > 2 ? $fullName[2] : $fullName[1],
                'phone_number' => $c->ExtendedData->Data[6]->value,
                'ward_id' => Wards::where('name', 'like', $c->name)->first()->id
            ];
            $exists = User::where('first_name', $candidate['first_name'])->first();

            if(!$exists) {
                array_push($candidates, $candidate);
            }
        }

        foreach ($candidates as $new) {
            $newCandidate = new User();
            $newCandidate['first_name'] = $new['first_name'];
            $newCandidate->last_name = $new['last_name'];
            $newCandidate->ward_id = $new['ward_id'];
            $newCandidate->approved = 1;
            $newCandidate->verified = 1;
            $newCandidate->user_type = 4;
            $newCandidate->phone_number = $new['phone_number'];
            $newCandidate->save();

            $politicianInfo = new PoliticiansInfo();
            $politicianInfo->user_id = $newCandidate->id;
            $politicianInfo->profile_type_id = 1;
            $politicianInfo->ward_id = 1;
            $politicianInfo->save();


            Stance::create([
                'title' => 'Title',
                'content' => 'What are your stances?',
                'user_id' => $newCandidate->id
            ]);
        }


        $saveFile = $request->file('kml_file');
        $sub_path = 'kml'; //line 2
        $destination_path = public_path($sub_path);  //line 4
        $saveFile->move($destination_path,  'ElectoralWard.kml');  //line 5

        return view('admin.updateCandidates')->with('step3', 'Uploaded KML file and added missing candidates to CAPSLOK.');
    }

    public function updateMap(Request $request) {
        $originalJson = simplexml_load_string(file_get_contents('kml/ElectoralWard.kml'));

        $candidates = $originalJson->Document->Folder->Placemark;

        foreach($candidates as $new) {
            //Website/profile
            try {
                $fullName = explode(" ", $new->ExtendedData->Data[2]->value);
                $first_name = count($fullName) > 2 ? $fullName[0].' '.$fullName[1] : $fullName[0];
                $last_name = count($fullName) > 2 ? $fullName[2] : $fullName[1];
                $user_id = User::where([['first_name', $first_name], ['last_name', $last_name]])->first()->id;
                $new->ExtendedData->Data[0]->value = "www.capslok.com/profile/".$user_id;
//            $website = (array)$new->ExtendedData->Data[0];
//            $website["@attributes"]['name'] = "Profile";
//
//            //Councillor
//            $website = (array)$new->ExtendedData->Data[2];
//            $website["@attributes"]['name'] = "Councillor";
//
//            //Phone Number
//            $website = (array)$new->ExtendedData->Data[6];
//            $website["@attributes"]['name'] = "Phone Number";
            } catch (\Exception $ex) {
                continue;
            }

        }

        foreach($candidates as $new) {
            unset($new->ExtendedData->Data[8]);
            unset($new->ExtendedData->Data[7]);
            unset($new->ExtendedData->Data[5]);
            unset($new->ExtendedData->Data[4]);
            unset($new->ExtendedData->Data[3]);
            unset($new->ExtendedData->Data[1]);
        }
        $originalJson->saveXML('kml/ElectoralWard.kml');

        return view('admin.updateCandidates')->with('step4', 'Updated the KML file with proper data.');
    }

    public function downloadKMLFile()
    {
        return response()->download(public_path('kml/ElectoralWard.kml'));
    }

    public function addPoliticiansWithTypeFromJsonFile(Request $request)
    {
        if (Auth::user()->user_type != 3) {
            return view('home');
        }

        $saveFile = $request->file('json_file');
        $sub_path = 'candidates'; //line 2
        $destination_path = public_path($sub_path);  //line 4
        $saveFile->move($destination_path,  'candidates.json');  //line 5

        $testfile = 'candidates/candidates.json';
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

        foreach($array as $item) {
            if (!in_array($item[9], ['Mayor', 'Councillor'])) {
                break;
            }

            $name = explode(' ', $item[8]);
            $exists = User::where([['first_name', $name[0]], ['last_name', $name[1]]])->first();

            if ($exists) {
                if ($item[9] == "Mayor")
                {
                    $poli = PoliticiansInfo::where('user_id', $exists->id)->first();
                    $poli->profile_type_id = 2;
                    $poli->save();
                }
                continue;
            }

            $user = new User();
            $user->setAttribute('first_name', $name[0]);
            $user->setAttribute('last_name', $name[1]);
            $user->setAttribute('user_type', 4);
            $user->save();


            $candidateType = $item[9] == "Mayor" ? 2 : 1;
            $politicianInfo = new PoliticiansInfo();
            $politicianInfo->user_id = $user->id;
            $politicianInfo->profile_type_id = $candidateType;
            if($candidateType == 1) {
                $ward = Wards::where('name', 'like', '%'.$item[10].'%')->first();
                if(empty($ward)) {
                    $user->delete();
                    break;
                }
                $politicianInfo->ward_id = $ward->id;
            }
            $politicianInfo->save();


            Stance::create([
                'title' => 'Add title or slogan',
                'content' => 'What are your stances?',
                'user_id' => $user->id
            ]);

        }

        return view('admin.updateCandidates')->with('step1', 'Created candidate profiles.');
    }

    public function updateMapURL(Request $request)
    {
        if (Auth::user()->user_type != 3) {
            return view('home');
        }

        $url = $request->request->get('map_url');
        $map = new MapsUrl();
        $map->url = $url;
        $map->save();

        return view('admin.updateCandidates')->with('step6', 'Updated the Ward Map on CAPSLOK.');
    }

    public function components($component_name, $component_p1 = NULL, $component_p2 = NULL) {
        if ($component_name == 'politician-card') {
            if (isset($component_p1)) {
                $info = PoliticiansInfo::where('user_id', intval($component_p1))->first();
            } else {
                $info = PoliticiansInfo::first();
            }

            return view('dev/' . $component_name . '-dev')->with('info', $info);
        }
        else if ($component_name == 'politician-view') {
            $profile_type_id = (isset($component_p2) ? $component_p2 : 2);
            $politicians_info = PoliticiansInfo::where('profile_type_id', $profile_type_id)->sortable()->paginate(3);
            
            $title = DB::table('profile_types')->where('id', $profile_type_id)->first()->type;

            return view('dev/' . $component_name . '-dev')
                    ->with('title', $title)
                    ->with('numRows', (isset($component_p1) ? $component_p1 : 1))
                    ->with('politicians_info', $politicians_info);
        }
        else {
            return view('dev/' . $component_name . '-dev');
        }
    }
}
