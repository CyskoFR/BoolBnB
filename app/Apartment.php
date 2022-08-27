<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    public function category(){

        return $this->belongsTo('App\Category');
    }
    public function services(){
        
        return $this->hasMany('App\Service');
    }
    public function user(){
        
        return $this->belongsTo('App\User');
    }
}
