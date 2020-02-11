<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 'middlename', 'lastname', 'email', 'username', 'password', 'contactno', 'role', 'deactivated'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //User -> LogBook
    public function userLogBook() {
        return $this->hasMany('App\LogBook', 'actor_id', 'id');
    }
    
    //User -> DamageReport
    public function userDamageReport() {
        return $this->hasMany('App\DamageReport', 'actor_id', 'id');
    }
    
    //User -> LogPatron
    public function userLogPatron() {
        return $this->hasMany('App\LogPatron', 'actor_id', 'id');
    }

    //User -> Log Transaction
    public function userLogTransaction() {
        return $this->hasMany('App\LogTransaction', 'actor_id', 'id');
    }

    //User -> LogUser -> Actor (Issuer)
    public function userLogUserActor() {
        return $this->hasMany('App\LogUser', 'actor_id', 'id');
    }

    //User -> LogUser -> Target (Issuee)
    public function userLogUser() {
        return $this->hasMany('App\LogUser', 'user_id', 'id');
    }
}
