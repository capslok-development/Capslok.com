<?php

namespace App;

use \DB;
use Illuminate\Database\Eloquent\Model;

class PoliticiansParty extends Model
{
    protected $table = 'politicians_party';
    protected $primaryKey = 'user_id';

    /**
     * gets the politiciansInfo for the politician party
     */
    public function politiciansInfo() {
        return $this->belongsTo('App\PoliticiansInfo');
    }
}
