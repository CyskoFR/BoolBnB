<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

//models
use App\Apartment;
use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Builder;

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
        // //geolocalizzazione indirizzo
        // $rawAddress = $data['full_address'];
        // $geoResponse = Http::get("https://api.tomtom.com/search/2/search/{$rawAddress}.json", [
        //     'key' => 'RYIXIrvLjWrNeQyGjLi5JoEGgH0IPDU2',
        // ])->json();

        // //cast float to string 
        // $final_address = $geoResponse['results']['0']['position'];
        // $final_address_lat = number_format($final_address['lat'],5,'.','');
        // $final_address_lon = number_format($final_address['lon'],5,'.','');
        // //dd( $final_address_lat, $final_address_lon);

        //
        // $geometry_list =
        // [
        //     "type" => 'CIRCLE',
        //     "position" => "{$final_address_lat},{$final_address_lon}",
        //     "radius" => "20000" 
        // ];
        // $test = implode("",$geometry_list);

        // //dd($test);
        // $result = Http::post("https://api.tomtom.com/search/2/geometrySearch/{$rawAddress}.json?", [
        //     'key' => 'RYIXIrvLjWrNeQyGjLi5JoEGgH0IPDU2',
        //      'geometryList' => $geometry_list,
        //     ])->json();

        // $client = new Client([
        //     'headers' => ['Content-Type' => 'application/json']
        //     ]
        // );

        // $response = $client->get("https://api.tomtom.com/search/2/geometrySearch/{$rawAddress}.json?key=RYIXIrvLjWrNeQyGjLi5JoEGgH0IPDU2", [
        //     // 'key' => 'RYIXIrvLjWrNeQyGjLi5JoEGgH0IPDU2',
        //     "json" =>['geometryList'=> $test],
        // ]);
        //dd($result);

        $apartments = Apartment::query()
        ->where('rooms','>=', $data['rooms'] ?? 1)
        ->orWhere('category_id',"=", $data['category_id'] )
        ->orWhere('beds','>=', $data['beds'] ?? 1)


        // ->orWhereHas(function ($query){
        //     $query->select('apartment_id')
        //     ->from('service')
        //     ->whereColumn('service_id', 'service.id');
        // })
        //->with('user', 'category', 'services')
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