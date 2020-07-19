<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    public function clientAccounts()
    {
        return $this->hasMany('App\Account', 'client_id', 'id');
    }

    
}
