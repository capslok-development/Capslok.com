<?php
/**
 * Created by PhpStorm.
 * User: jason
 * Date: 2018-08-15
 * Time: 8:59 PM
 */

namespace App;

use Illuminate\Database\Eloquent\Model;


class UserType extends Model
{
    protected $table = 'user_types';

    protected $fillable = [
        'name'
    ];
}