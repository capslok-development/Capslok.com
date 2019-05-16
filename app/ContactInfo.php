<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ContactInfo extends Model
{
    /**
     * gets the user for the politicians info
     */
    public function politiciansInfo() {
        return $this->belongsTo('App\PoliticiansInfo', 'user_id', 'user_id');
    }

    protected $table = 'user_contact_info';
}
