<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Mail;
use Kyslik\ColumnSortable\Sortable;

class User extends Authenticatable
{
    use Notifiable;
    use Sortable;

    public $first_name;

    public $sortable = ['id', 'user_name', 'first_name', 'last_name', 'email', 'user_type', 'verified', 'num_logins'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_name', 'first_name', 'last_name', 'home_address', 'email', 'password', 'user_type', 'description', 'date_of_birth', 'profile_pic_path', 'background_pic_path'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function politiciansInfo() {
        return $this->hasOne('App\PoliticiansInfo');
    }

    public function contactInfo() {
        return $this->hasOne('App\UserContactInfo');
    }

    public function getUserType() {
        return ucwords(\DB::select('select * from user_types where id = :id', ['id' => $this->user_type])[0]->name);
    }

    public function verifyUser()
    {
        return $this->hasOne('App\VerifyUser');
    }

    public function validate($user) {
        if (in_array(null, [$user->first_name, $user->last_name])) {
            return false;
        }

        return true;
    }

    public function setAttribute($property, $value) {
        $this->attributes[$property] = ! is_null ($value) ? $value : null;
    }
}
