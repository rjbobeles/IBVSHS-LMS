<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogTransaction extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'actor_id', 'action', 'transaction_id', 'patron_id', 'book_id', 'date_issued', 'date_due', 'date_returned'
    ];

    //LogTransaction <- User
    public function userLogTransaction() {
        return $this->belongsTo('App\User', 'actor_id', 'id');
    }

    //LogTransaction <- Transaction
    public function transactionLogTransaction() {
        return $this->belongsTo('App\Transaction', 'transaction_id', 'id');
    }
}
