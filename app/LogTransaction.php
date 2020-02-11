<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogTransaction extends Model
{
    //LogTransaction <- User
    public function userLogTransaction() {
        return $this->belongsTo('App\User', 'actor_id', 'id');
    }

    //LogTransaction <- Transaction
    public function transactionLogTransaction() {
        return $this->belongsTo('App\Transaction', 'transaction_id', 'id');
    }
}
