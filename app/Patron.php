<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patron extends Model
{
    //Patron -> Transaction
    public function patronTransaction() {
        return $this->hasMany('App\Transaction', 'patron_id', 'id');
    }

    //Patron -> LogPatron
    public function patronLogPatron() {
        return $this->hasMany('App\LogPatron', 'patron_id', 'id');
    }

    //Patron -> LogTransaction
    public function patronLogTransaction() {
        return $this->hasMany('App\LogTransaction', 'patron_id', 'id');
    }

    //Patron -> DamageReport
    public function patronDamageReport() {
        return $this->hasMany('App\DamageReport', 'patron_id', 'id');
    }
}
