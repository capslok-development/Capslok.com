<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wards extends Model
{
    protected $table = 'wards';
    protected $primaryKey = 'id';

    /**
     * gets all politicians_info for this ward
     */
    public function politiciansInfos() {
        return $this->hasMany('App\PoliticiansInfo', 'ward_id', 'id');
    }

    /**
     * gets all postalcodes for this ward
     */
    public function postalcodes() {
        return $this->hasMany('App\PostalCodes', 'ward_id', 'id');
    }

    /**
     * gets the city for the ward
     */
    public function city() {
        return $this->hasOne('App\City', 'user_id', 'user_id');
    }

}
