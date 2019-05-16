<?php

namespace App\Http\Controllers;

use App\MapsUrl;
use App\PostalCodes;
use App\WardAddresses;
use App\Wards;
use GuzzleHttp;
use Illuminate\Http\Request;
use App\PoliticiansInfo;
use App\ProfileType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use function MongoDB\BSON\toJSON;
use Carbon\Carbon;

class HomeController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $postalcode = null)
    {
        $address = null;
        if ($request != null && $request->postalcode != null) {
            $address = $request->postalcode;
        }

        if (Auth::user() && Auth::user()->home_address) {
            try {
                $data = $this->getPoliticiansInfoByAddress(Auth::user()->home_address);
                if ($data) {
                    $data['hideViewAllButton'] = true;
                    $data['map_url'] = $this->map_url;
                    return view('filtered-politicians')->with('data', $data);
                } else {
                    $data = $this->getPoliticiansInfoByWardId();
                    if ($data) {
                        $data['hideViewAllButton'] = true;
                        $data['map_url'] = $this->map_url;
                        return view('filtered-politicians')->with('data', $data);
                    }
                }
            } catch (\Exception $ex) {
                $data = $this->getAllPoliticiansInfo();
                $data['map_url'] = $this->map_url;
                return view('welcome')->with('data', $data);
            }
        }

        $data = null;
        if ($address !== null) {
            $data = $this->getPoliticiansInfoByAddress($address);
            if ($data) {
                $data['hideViewAllButton'] = true;
                $data['map_url'] = $this->map_url;
                return view('filtered-politicians')->with('data', $data);
            }
        }

        if ($data == null || count($data) == 0) {
            $data = $this->getAllPoliticiansInfo();
        }
        $data['map_url'] = $this->map_url;
        return view('welcome')->with('data', $data);
    }

    public function allPoliticiansInfoView() {
        $data = $this->getAllPoliticiansInfo();
        $data['map_url'] = $this->map_url;
        return view('welcome')->with('data', $data);
    }

    public function getAllPoliticiansInfo() {
        $profile_types = ProfileType::all();
        $politicianInfo_City = PoliticiansInfo::where('profile_type_id', 1)->get();
        $politicianInfo_Municipal = PoliticiansInfo::where('profile_type_id', 2)->get();
        $politicianInfo_Provincial = PoliticiansInfo::where('profile_type_id', 3)->get();
        $politicianInfo_Federal = PoliticiansInfo::where('profile_type_id', 4)->get();
        //dd($politicianInfo_City->first()['city']);
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

    public function getPoliticiansInfoByWardId($id = null) {
        $ward = null;

        if ($id == null && Auth::user() != null && Auth::user()->ward_id != null) {
            $ward = Wards::where('id', Auth::user()->ward_id)->first();

            $data['politicians'] = $ward->politiciansInfos;
            $data['address'] = '';
            $data['ward'] = $ward->name;

            if(count($ward->politiciansInfos) > 0) {
                return $data;
            }
        }

        return null;
    }

    public function getPoliticiansInfoByAddress($request) {
//        $address = PostalCodes::where('postal_code', $request)->get();
        $address = explode(" ", $request);
        $index = 0;
        $streetNum = $address[$index++];
        $streetName = $address[$index++];
        $streetType = !empty($address[$index]) ? $address[$index] : null;

        $wardAddress = WardAddresses::where([['house_number', '=', $streetNum], ['street_name', '=', $streetName], ['street_type', '=', $streetType]])->firstOrFail();

        if (empty($address) || empty($address[0]) || $wardAddress == null || $wardAddress->street_name == null) {
            return null;
        }

        $ward = Wards::where('id', $wardAddress->ward_id)->first();

        if (empty($ward)) {
            return Redirect::back()->with('notfound','No ward found for this postalcode.');
        }

        if (empty($ward->politiciansInfos) || count($ward->politiciansInfos) == 0) {
            return null;
        }

        $data['politicians'] = $ward->politiciansInfos;
        $data['address'] = strtoupper($request);
        $data['ward'] = $ward->name;

        return $data;
    }

    public function searchByProfileType(Request $request) {
        $politicianInfo = PoliticiansInfo::where('profile_type_id', $request->id)->get();

        $data['politicians'] = $politicianInfo;
        $data['title'] = $politicianInfo[0]->getProfileName();

        $data['map_url'] = $this->map_url;
        return view('filtered-politicians')->with('data', $data);
    }

    public function postalCodeSubmission(Request $request) {
        return $this->index($request, $request->postalcode);
    }

    public function searchByHomeAddress(Request $request) {
        try {
            $address = explode(" ", $request->address);
            $index = 0;
            $streetNum = $address[$index++];
            $streetName = $address[$index++];
            $streetType = !empty($address[$index]) ? $address[$index] : null;

            $wardAddress = WardAddresses::where([['house_number', '=', $streetNum], ['street_name', '=', $streetName], ['street_type', '=', $streetType]])->firstOrFail();

            if($wardAddress->street_name == null) {
                throw new \Exception();
            }

            $data['politicians'] = PoliticiansInfo::where('ward_id', intVal($wardAddress->ward_id))->get();
            $ward = Wards::where('id', $wardAddress->ward_id)->get();
            if ($ward[0] !== null) {
                $data['ward'] = Wards::where('id', $wardAddress->ward_id)->get()[0]->name;
            } else {
                throw new \Exception();
            }

            if (count($data['politicians']) == 0) {
                return Redirect::back()->with('notfoundaddress','No politicians registered in ward '.$wardAddress->ward_id.'.');
            }
            $data['map_url'] = $this->map_url;
            return view("filtered-politicians")->with('data', $data);
        } catch (\Exception $ex) {
            return Redirect::back()->with('notfoundaddress','This address is currently not supported.');
        }
    }

    public function whereDoIVote(Request $request) {
        try {
            $params = str_replace(" ", "%20", $request->address);
            $client = new GuzzleHttp\Client();
            $res = $client->get('https://winnipeg.ca/clerks/election/election2018/registration/app/ElectionApplication.asp?action=find-address&term='.$params);

            $addressId = json_decode($res->getBody()->getContents())[0]->id;
            $response = $client->get('https://winnipeg.ca/clerks/election/election2018/registration/app/ElectionApplication.asp?action=where-do-i-vote&addressId='.$addressId);

            $location =  json_decode($response->getBody()->getContents());

            $electionDay['facility'] = $location->electionDayPolls[0]->facilityName;
            $electionDay['address'] = $location->electionDayPolls[0]->address;
            $electionDay['distance'] = $location->electionDayPolls[0]->distanceInKilometers;

            $date = Carbon::parse(date($location->electionDayPolls[0]->pollDates[0]->startTime), 'UTC');
            $time = $date->format('h:ma');
            $electionDay['day'] = $date->format('M d');
            $electionDay['start_time'] = $time;

            $date = Carbon::parse(date($location->electionDayPolls[0]->pollDates[0]->endTime), 'UTC');
            $time = $date->format('h:ma');
            $electionDay['end_time'] = $time;

            $advancePolls = null;
            $counter = 0;
            foreach($location->advancePolls as $poll) {
                $advancePolls[$counter]['facility'] = $poll->facilityName;
                $advancePolls[$counter]['address'] = $poll->address;
                $advancePolls[$counter]['distance'] = $poll->distanceInKilometers;

                $i = 0;
                foreach($poll->pollDates as $polldate){
                    $date = Carbon::parse(date($polldate->startTime), 'UTC');
                    //$date = $date->format('M d, Y \f\r\o\m h:ma');
                    $day = $date->format('M d');
                    $time = $date->format('h:ma');

                    $advancePolls[$counter]['day'][$i] = $day;
                    
                    $advancePolls[$counter]['start_time'][$i] = $time;

                    $date = Carbon::parse(date($polldate->endTime), 'UTC');
                    $time = $date->format('h:ma');

                    $advancePolls[$counter]['end_time'][$i++] = $time;
                }
                $counter++;
            }

            if ($electionDay == null) {
                return Redirect::back()->with('notfoundvoteaddress','No data on this address');
            }

            return Redirect::back()->with(['electionDay' => $electionDay])->with(['advancePolls' => $advancePolls]);
        } catch (\Exception $ex){
            return Redirect::back()->with('notfoundvoteaddress','No data on this address');
        }
    }

    public function getpurposeRepresentatives() {
        return view('purpose.representatives');
    }

    public function getpurposeVoters() {
        return view('purpose.voters');
    }

    public function getpurposeElections() {
        return view('purpose.elections');
    }

    public function getInfoRepresentatives() {
        return view('info.representatives');
    }

    public function getInfoVoters() {
        return view('info.voters');
    }

    public function getInfoElections() {
        return view('info.elections');
    }

    public function getInfoVotingInfo() {
        return view('info.voting-info');
    }
    public function getInfoPrivacyInfo() {
        return view('info.privacy-info');
    }    
    public function getServicesCapsFeedInfo() {
        return view('services.capsfeed-info');
    }
    public function getServicesCapsInsightInfo() {
        return view('services.capsinsight-info');
    }  
    public function getServicesCapsReadInfo() {
        return view('services.capsread-info');
    }           
}
