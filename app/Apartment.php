<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    public function category(){

        return $this->belongsTo('App\Category');
    }
    public function services(){
        
        return $this->belongsToMany('App\Service');
    }
    public function user(){
        
        return $this->belongsTo('App\User');
    }
    public function messages(){

        return $this->hasMany('App\Message');
    }
}
