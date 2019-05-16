<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Stance extends Model
{
    protected $fillable = [
        'user_id', 'title', 'content'
    ];

    /**
     * gets the user for the politicians info
     */
    public function politiciansInfo() {
        return $this->belongsTo('App\PoliticiansInfo', 'user_id', 'user_id');
    }

    public function getFormattedUpdateTime() {
        // with time
        // return Carbon::parse($this->updated_at)->format('M j, Y, g:i a');

        // without time
        return Carbon::parse($this->updated_at)->format('M j, Y');
    }

    protected $table = 'stances';
}
