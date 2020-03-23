<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DamageReport extends Model
{
    protected $fillable = [
        'patron_id', 'book_id', 'actor_id', 'comment'
    ];

    ///DamageReport <- User
    public function userDamageReport() {
        return $this->belongsTo('App\User', 'actor_id', 'id');
    }

    //DamageReport <- Book
    public function bookDamageReport() {
        return $this->belongsTo('App\Book', 'book_id', 'id');
    }

    //DamageReport <- Patron
    public function patronDamageReport() {
        return $this->belongsTo('App\Patron', 'patron_id', 'id');
    }
}
