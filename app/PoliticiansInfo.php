<?php

namespace App;

use \DB;
use Illuminate\Database\Eloquent\Model;

class PoliticiansInfo extends Model
{
    protected $table = 'politicians_info';
    protected $primaryKey = 'user_id';


    protected $fillable = [
        'user_id', 'profile_type_id', 'party_id', 'city', 'province', 'ward_id', 'aboutme'
    ];

    /**
     * gets the user for the politicians info
     */
    public function user() {
        return $this->belongsTo('App\User');
    }

    /**
     * gets the stances for the politician
     */
    public function stances() {
        return $this->hasMany('App\Stance', 'user_id', 'user_id')->orderBy('updated_at', 'desc');
    }

    /**
     * gets the contactInfo for the politician
     */
    public function contactme() {
        return $this->hasOne('App\ContactInfo', 'user_id', 'user_id');
    }

    /**
     * gets the name from profile id
     */
    public function getProfileName() {
        return DB::table('profile_types')->where('id', $this->profile_type_id)->first()->type;
    }

    /**
     * gets the name from party id
     */
    public function getParty() {
        return DB::table('politicians_party')->where('id', $this->party_id)->first();
    }

    /**
     * gets the ward
     */
    public function getWard() {
        return DB::table('wards')->where('id', $this->ward_id)->first();
    }

    /**
     * gets candidate type
     */
    public function getType() {
        return DB::table('profile_types')->where('id', $this->profile_type_id)->first();
    }

    /**
     * gets candidate contact info
     */
    public function getContactInfo() {
        return DB::table('user_contact_info')->where('user_id', $this->user_id)->first();
    }
}
