<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogPatron extends Model
{
    //LogPatron <- User
    public function userLogPatron() {
        return $this->belongsTo('App\User', 'actor_id', 'id');
    }

    //LogPatron <- Patron
    public function patronLogPatron() {
        return $this->belongsTo('App\Patron', 'patron_id', 'id');
    }
}
