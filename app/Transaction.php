<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'patron_id', 'book_id', 'date_issued', 'date_due', 'date_returned'
    ];

    //Transaction <- Patron
    public function patronTransaction() {
        return $this->belongsTo('App\Patron', 'patron_id', 'id');
    }

    //Transaction <- Book
    public function bookTransaction() {
        return $this->belongsTo('App\Book', 'book_id', 'id');
    }

    //Transaction -> LogTransaction
    public function transactionLogTransaction() {
        return $this->hasMany('App\LogTransaction', 'transaction_id', 'id');
    }
}
