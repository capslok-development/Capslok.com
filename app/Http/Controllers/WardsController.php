<?php

namespace App\Http\Controllers;

use App\PoliticiansInfo;
use App\ProfileType;
use App\Wards;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WardsController extends Controller
{
    public $map_url;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
        $temp = DB::table('maps_url')->orderBy('created_at', 'desc')->first();
        $this->map_url = $temp ? $temp->url : '';
    }

    public function showPoliticiansInWard($id) {
        $data['politicians'] = PoliticiansInfo::where('ward_id', $id)->get();
        if (count($data['politicians']) == 0) {
            $data = $this->getAllPoliticiansInfo();
            $data['notfoundward'] = "No candidates registered yet for this ward.";
            $data['map_url'] = $this->map_url;

            return view('welcome')->with('data', $data);
        }

        $data['ward'] = Wards::where('id', $id)->get()[0]->name;
        $data['map_url'] = $this->map_url;
        
        return view("filtered-politicians")->with('data', $data);
    }

    public function getAllPoliticiansInfo() {
        $profile_types = ProfileType::all();
        $politicianInfo_City = PoliticiansInfo::where('profile_type_id', 1)->get();
        $politicianInfo_Municipal = PoliticiansInfo::where('profile_type_id', 2)->get();
        $politicianInfo_Provincial = PoliticiansInfo::where('profile_type_id', 3)->get();
        $politicianInfo_Federal = PoliticiansInfo::where('profile_type_id', 4)->get();

        $data = [
            'profile_types' => $profile_types,
            'politicianInfo' => [
                'city' => $politicianInfo_City,
                'municipal' => $politicianInfo_Municipal,
                'provincial' => $politicianInfo_Provincial,
                'federal' => $politicianInfo_Federal
            ]
        ];
        return $data;
    }
}
