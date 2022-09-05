<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

//models
use App\Apartment;
use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Mockery\Undefined;

class ApartmentController extends Controller
{   
    public $final_address_lat;
    public $final_address_lon;
    
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

        /* ----------
        geodata fetching 
        -----------*/
        $rawAddress = $request->input('full_address');
        $geoResponse = Http::get("https://api.tomtom.com/search/2/search/{$rawAddress}.json", [
            'key' => 'RYIXIrvLjWrNeQyGjLi5JoEGgH0IPDU2',
        ])->json();
        //cast float to string 
        $final_address = $geoResponse['results']['0']['position'];
        $final_address_lat = $final_address['lat'];
        $final_address_lon = $final_address['lon'];
        $this->final_address_lat = $final_address_lat;
        $this->final_address_lon = $final_address_lon;
        //dd( $final_address_lat, $final_address_lon);
        $boundries = $this->fetchBoundries($final_address_lat, $final_address_lon, 20);   
        /* ----------
        query builder 
        -----------*/
        $rooms = $request->input('rooms');
        $beds = $request->input('beds');
        $category_id = $request->input('category_id');
        $services = explode(',',$request->input('services'));
        //dd($services);
        /* ----------
        test servizi 
        -----------*/
        
        // $apartments = Apartment::query()
        // //->when($services, function($query, $services){
        //      ->join('apartment_service', 'id','=','apartment_service.apartment_id')
        //      ->select('service_id') 
        // //})
        // ->get();
        
        // return $apartments;

        $apartments = Apartment::query()
        // ->join('apartment_service', 'id','=','apartment_service.apartment_id')
        // ->select('apartment_id','service_id')
        ->when($rooms, function($query, $rooms){
            return $query->where('rooms','>=', $rooms); 
        })
        ->when($beds, function($query, $beds){
            return $query->where('beds','>=', $beds); 
        })
        ->when($category_id, function($query, $category_id){
            return $query->where('category_id', $category_id); 
        })
        // ->whereBetween('latitude', array($boundries['lat']['0'],$boundries['lat']['1']))
        // ->whereBetween('longitude', array($boundries['log']['0'],$boundries['log']['1']))
        
        //->with('category', 'user', 'services')

        // ->groupBy('apartment_id')
        // ->having('service_id' , $services) 
        ->get();
        $apartments_with_distance = $apartments->sortBy(function($apartment){
            return sqrt(
                    pow(($apartment->latitude - $this->final_address_lat),2)+
                    pow(($apartment->longitude - $this->final_address_lon),2)
                );
            });
        return $apartments_with_distance;    
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
    
    //HELPERS

    // thanks to http://janmatuschek.de/LatitudeLongitudeBoundingCoordinates#Longitude
    public function fetchBoundries(float $lat_deg, float $lon_deg , int $distance ){
        $EARTHS_RADIUS_KM = 6371.01;
        //conversione deg / rad
        $lat_rad = $lat_deg*(pi()/180);
        $log_rad = $lon_deg*(pi()/180);
        //raggio angolare
        $angular_radius = $distance / $EARTHS_RADIUS_KM;
        //min max lat in rad
        $lat_min_rad = $lat_rad - $angular_radius; 
        $lat_max_rad = $lat_rad + $angular_radius; 
        //delta lon
        $deltaLon = asin(sin($angular_radius) / cos($lat_rad));
        //min max lon in rad
        $lon_min_rad = $log_rad - $deltaLon;
        $lon_max_rad = $log_rad + $deltaLon;

        //min max lat in deg
        $lat_min_deg = $lat_min_rad * (180/pi());
        $lat_max_deg = $lat_max_rad * (180/pi());
        //min max log in deg
        $lon_min_deg = $lon_min_rad * (180/pi());
        $lon_max_deg = $lon_max_rad * (180/pi());
        return [
            'lat' => [$lat_min_deg ,$lat_max_deg],
            'log' => [$lon_min_deg, $lon_max_deg]
        ];
    }

    //searchbar
    public function searchbar(Request $request) {

        $param = $request -> all();
        $apartments = Apartment::query()->where('name', $param)
        ->orWhere('full_address', $param)
        ->get();

        return $apartments;
    }
}