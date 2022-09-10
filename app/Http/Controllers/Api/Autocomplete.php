<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class Autocomplete extends Controller
{
    public function autocomplete(Request $request){
        $data = request()->all();
        $address = $data['address'];
        $suggested = Http::get("https://api.tomtom.com/search/2/search/{$address}.json", [
            'key' => 'RYIXIrvLjWrNeQyGjLi5JoEGgH0IPDU2',
            'countrySet' => 'IT',
            'limit' => 5
        ]);
        $suggested = $suggested['results'];
        $suggested =array_map(function($item){
            return $item['address']['freeformAddress'];
        },$suggested);

        return $suggested;
    }
}
