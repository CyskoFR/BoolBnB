<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    public function apartments(){
        return $this->hasMany('App\Apartment');
    }
}
