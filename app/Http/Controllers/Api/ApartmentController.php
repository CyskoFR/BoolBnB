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
use phpDocumentor\Reflection\Types\Void_;

class ApartmentController extends Controller
{   
    public $final_address_lat;
    public $final_address_lon;
    public $services;
    public int $distance;
    
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
        if($request->input('distance') != null){
            $this->distance = $request->input('distance');
        }
        else{
            $this->distance = 20;
        }
        //dd($this->distance);
        $boundries = $this->fetchBoundries($final_address_lat, $final_address_lon, $this->distance);   
        /* ----------
        query builder 
        -----------*/
        $rooms = $request->input('rooms');
        $beds = $request->input('beds');
        $category_id = $request->input('category_id');
        
        /* ----------
        check esistenza servizi
        -----------*/
        if($request->input('services') != null){
            $services = explode(',',$request->input('services'));
            $this->services = $services;
        }else{
            $services = null;
        }

        /* ----------
        query builder 
        -----------*/
        $apartments = Apartment::query()
        ->when($rooms, function($query, $rooms){
            return $query->where('rooms','>=', $rooms); 
        })
        ->when($beds, function($query, $beds){
            return $query->where('beds','>=', $beds); 
        })
        ->when($category_id, function($query, $category_id){
            return $query->where('category_id', $category_id); 
        })
        ->whereBetween('latitude', array($boundries['lat']['0'],$boundries['lat']['1']))
        ->whereBetween('longitude', array($boundries['log']['0'],$boundries['log']['1'])) 
        ->with('category', 'user', 'services')
        ->get();
        /* ----------
        check servizi
        -----------*/

        if($services !== null){
        $apartments =  $apartments->map(function ($apartment){
             foreach($this->services as $service){
                if(!$apartment->services->contains($service)){
                    return ;
                }else{
                    return $apartment;
                }
            }
         })->filter(); 
        }

        /* ----------
        sort by distance
        -----------*/

        $apartments = $apartments->sortBy(function($apartment){
            return sqrt(
                    pow(($apartment->latitude - $this->final_address_lat),2)+
                    pow(($apartment->longitude - $this->final_address_lon),2)
                );
            });

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
}