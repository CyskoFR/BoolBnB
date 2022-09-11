<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

//models
use App\Apartment;
use App\Helpers\PaginationHelper;
use Carbon\Carbon;
use League\CommonMark\Extension\Table\Table;

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
            'services' => 'sometimes|exists:services,id',
            'distance' => 'integer|min:1'
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
        ->where('is_visible',1)
        ->with('category', 'user', 'services', /*'sponsorships'*/)
        ->get();

        // propvare le gli apartments with sposnsorships e finltrare da li ????
        //insdd($apartments);
        //sponsorizzati
        $sponsored_apartments = Apartment::query()
        // ->join('apartment_service', 'apartments.id', '=','apartment_service.apartment_id')
        ->join('apartment_sponsorship', 'apartments.id', '=','apartment_sponsorship.apartment_id')
        ->where('expiration_date', '>=', Carbon::now())
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
        ->where('is_visible',1)
        ->with('category', 'user')

        ->get();
        //assegnazione corretta dei servizi agli sponsorizzati
        foreach($sponsored_apartments as $elm){
            $array_services = Apartment::query()
            
             ->join('apartment_service', 'apartments.id', '=','apartment_service.apartment_id')
            ->where('apartment_service.apartment_id', $elm['apartment_id'])
            
             ->join('services', 'apartment_service.service_id', '=','services.id')
             ->select('services.id', 'services.name')
             ->get();
             
            $elm['services']= $array_services;
        };
        /* ----------
        check servizi
        -----------*/
        
        if($services !== null){
        $apartments = $apartments->map(function ($apartment){
             foreach($this->services as $service){
                if(!$apartment->services->contains($service)){
                    return ;
                }
            }
            return $apartment;
         })->filter(); 
        }
        //sponsorizzati
        if($services !== null){
            $sponsored_apartments = $sponsored_apartments->map(function ($apartment){
                 foreach($this->services as $service){
                    if(!$apartment->services->contains($service)){
                        return ;
                    }
                }
                return $apartment;
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
        //sponsorizzati
        $sponsored_apartments = $sponsored_apartments->sortBy(function($apartment){
                return sqrt(
                        pow(($apartment->latitude - $this->final_address_lat),2)+
                        pow(($apartment->longitude - $this->final_address_lon),2)
                    );
                });
        
        //fix mismatch apartment_ id to id in `apartment`.`id`
         $sponsored_apartments = $sponsored_apartments->map(function($apartment){
              $apartment['id'] = $apartment['apartment_id'];
              return $apartment;
         });

         $sponsored_apartments =  $sponsored_apartments->concat($apartments)->unique('id');   
        return $result = PaginationHelper::paginate($sponsored_apartments,8);
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

    public function sponsored(){
        $apartments = Apartment::query()->join('apartment_sponsorship', 'apartments.id', '=','apartment_sponsorship.apartment_id')
        ->where('expiration_date', '>=', Carbon::now())
        ->where('is_visible',1)
        ->paginate(4);
        $apartments = $apartments->map(function($apartment){
            $apartment['id'] = $apartment['apartment_id'];
            return $apartment;
       });

        return $apartments;
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