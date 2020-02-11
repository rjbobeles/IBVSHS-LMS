<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogBook extends Model
{
    ///LogBook <- User
    public function userLogBook() {
        return $this->belongsTo('App\User', 'actor_id', 'id');
    }

    //Transaction <- Book
    public function bookLogBook() {
        return $this->belongsTo('App\Book', 'book_id', 'id');
    }
}
