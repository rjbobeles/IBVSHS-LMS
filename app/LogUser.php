<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogUser extends Model
{
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];


    //User <- Loguser <- Actor (Issuer)
    public function userLogUserActor() {
        return $this->belongsto('App\User', 'actor_id', 'id');
    }

    //User <- LogUser <- Target (Issuee)
    public function userLogUser() {
        return $this->belongsto('App\User', 'user_id', 'id');
    }
}
