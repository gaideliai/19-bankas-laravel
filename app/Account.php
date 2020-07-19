<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    public function accountClient()
    {
        return $this->belongsTo('App\Client', 'client_id', 'id');
    }

    public function generateAccount() 
    {
        $IBAN = 'LT';
        foreach (range(1, 2) as $value) {
            $IBAN .= rand(0, 9);
        }
            $IBAN .= '70770';
        foreach (range(1, 11) as $value) {
            $IBAN .= rand(0, 9);
        }
        return $IBAN;
    }
}
