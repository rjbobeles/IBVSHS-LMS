<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'callnumber', 'title', 'author', 'isbn', 'volume', 'edition', 'year_published', 'publisher', 'genre', 'condition', 'status', 'barcodeno', 'book_image'
    ];

    //Book -> Transaction
    public function bookTransaction() {
        return $this->hasMany('App\Transaction', 'book_id', 'id');
    }

    //Book -> DamageReport
    public function bookDamageReport() {
        return $this->hasMany('App\DamageReport', 'book_id', 'id');
    }

    //Book -> LogBook
    public function bookLogBook() {
        return $this->hasMany('App\LogBook', 'book_id', 'id');
    }

    //Book -> LogTransaction
    public function bookLogTransaction() {
        return $this->hasMany('App\LogTransaction', 'book_id', 'id');
    }
}
