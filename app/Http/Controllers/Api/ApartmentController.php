<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

//models
use App\Apartment;

class ApartmentController extends Controller
{
    
    //lista completa appartamenti
    public function index()
    {
        $apartments = Apartment::where('is_visible', true)->with('user', 'category', 'services')->get();

        return $apartments;
    }
        /**
     * @param int $id
     *
     *
     */
    //Singolo appartemento
    public function searchApartment(Request $request)
    {
        // validazione richiesta get
        $request->validate([
            'full_address' => 'required|string|max:255',
            'rooms' => 'integer|min:1|max:255',
            'beds' => 'integer|min:1|max:255',
            'category_id' => 'exists:categories,id',
            'services' => 'sometimes|exists:services,id'
        ]);
        //fetch dei dati
        $data = $request->all();
        //geolocalizzazione indirizzo
        $rawAddress = $data['full_address'];
        $geoResponse = Http::get("https://api.tomtom.com/search/2/search/{$rawAddress}.json", [
            'key' => 'RYIXIrvLjWrNeQyGjLi5JoEGgH0IPDU2',
        ])->json();

        //cast float to string 
        $final_address = $geoResponse['results']['0']['position'];
        $final_address_lat = number_format($final_address['lat'],5,'.','');
        $final_address_lon = number_format($final_address['lon'],5,'.','');

        //
        $geometry_list="type=CIRCLE,position={$final_address_lat},{$final_address_lon},radius=20000" ;
     
        //dd($geometry_list);
        $result = Http::get("https://api.tomtom.com/search/2/geometrySearch/.json?", [
            'key' => 'RYIXIrvLjWrNeQyGjLi5JoEGgH0IPDU2',
            'geometryList' => "{$geometry_list}",
            ]);
        dd($result);
        $apartments = Apartment::query()
        ->where('rooms', $data['rooms'])
        ->orWhere('category_id', $data['category_id'])
        ->orWhere('beds', $data['beds'])
        ->with('user', 'category', 'services')
        ->get();

        return $apartments;
    }


    /**
     * @param int $id
     *
     *
     */
    //Singolo appartemento
    public function getApartment(Request $request)
    {
        $id = $request->all();
        $apartment = Apartment::query()->where('id', $id)->with('user', 'category', 'services')->get();

        return $apartment;
    }
}