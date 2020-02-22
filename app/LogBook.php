<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogBook extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'actor_id', 'action', 'book_id', 'callnumber', 'title', 'author', 'isbn', 'volume', 'edition', 'year_published', 'publisher', 'genre', 'condition', 'status', 'barcodeno', 'book_image'
    ];

    ///LogBook <- User
    public function userLogBook() {
        return $this->belongsTo('App\User', 'actor_id', 'id');
    }

    //Transaction <- Book
    public function bookLogBook() {
        return $this->belongsTo('App\Book', 'book_id', 'id');
    }
}
