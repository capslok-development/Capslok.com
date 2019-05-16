<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostalCodes extends Model
{
    protected $table = 'postalcodes';
    protected $primaryKey = 'id';

    /**
     * gets the ward that this postalcode belongs to
     */
    public function ward() {
        return $this->hasOne('App\Wards', 'id', 'ward_id');
    }
}
