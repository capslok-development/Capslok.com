<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Kyslik\ColumnSortable\Sortable;

class UserContactInfo extends Authenticatable
{
    use Notifiable;
    protected $table = 'user_contact_info';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'user_id', 'phone_number', 'primary_email', 'secondary_email', 'address', 'city_id', 'is_politician', 'fb_link', 'twitter_link', 'other_link'
    ];

    public function user() {
        return $this->hasOne('App\User');
    }

    public function city() {
        return $this->hasOne('App\City');
    }
}
