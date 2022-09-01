<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

use App\Apartment;
use App\Category;
use App\Service;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $apartments = Apartment::query()->where('user_id', Auth::id())->get();

        return view('admin.apartments.index', compact('apartments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $services = Service::all();

        return view('admin.apartments.create', compact('categories', 'services') );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // richiesta post per create apartment al database

        //validazione
        $request->validate([
            'name' => 'required|string|max:255',
            'rooms' => 'required|integer|min:1|max:255',
            'beds' => 'required|integer|min:1|max:255',
            'bathrooms' => 'required|integer|min:1|max:255',
            'description' => 'required|string|max:65535',
            'size' => 'required|integer|min:10|max:65535',
            'full_address' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,bmp,png',
            'is_visible' => 'sometimes|accepted',
            'category_id' => 'required|exists:categories,id',
            'services' => 'sometimes|exists:services,id'
        ]);
        //store
        $data = $request->all();
        //fetch geo data appartamento
        $indirizzo = $data['full_address'];
        $geo = Http::get("https://api.tomtom.com/search/2/search/{$indirizzo}.json", [
            'key' => 'RYIXIrvLjWrNeQyGjLi5JoEGgH0IPDU2',
            'countrySet' => 'IT'
        ]);
        
        $geo_json = json_decode($geo);
        
        $url_image = "https://api.tomtom.com/map/1/staticimage?key=RYIXIrvLjWrNeQyGjLi5JoEGgH0IPDU2&zoom=16&center={$geo_json->results[0]->position->lon},{$geo_json->results[0]->position->lat}&format=png&layer=basic&style=main&width=800&height=600";
        //creazione appartamento
        $newApartment = new Apartment();
        $newApartment->name = $data['name'];
        $newApartment->rooms = $data['rooms'];
        $newApartment->beds = $data['beds'];
        $newApartment->bathrooms = $data['bathrooms'];
        $newApartment->description = $data['description'];
        $newApartment->size = $data['size'];
        $newApartment->full_address = $indirizzo;
        $newApartment->latitude = $geo_json->results[0]->position->lat;
        $newApartment->longitude = $geo_json->results[0]->position->lon;
        $newApartment->image = Storage::put('images', $data['image']);
        $newApartment->map_image = $url_image;
        $newApartment->is_visible = isset($data['is_visible']);
        //foreign key
        $newApartment->user_id = Auth::id();
        $newApartment->category_id = $data['category_id'];
        $newApartment->save();
        //pivot servizi
        if(isset($data['services'])){
            $newApartment->services()->sync($data['services']);
        }

        return redirect()->route('admin.apartments.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Apartment $apartment)
    {
        //403 se entro in un appartamento non mio
        if($apartment->user_id != Auth::id()){
            abort(403, 'non hai il permesso di entrare qui');
        }
        return view('admin.apartments.show', compact('apartment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( Apartment $apartment)
    {
        if($apartment->user_id != Auth::id()){
            abort(403, 'non hai il permesso di entrare qui');
        }
        $categories = Category::all();
        $services = Service::all();
        $apartmentServices = $apartment->services->map(function ($item) {
            return $item->id;
        })->toArray();
        return view('admin.apartments.edit',  compact('categories', 'apartmentServices', 'services' ,'apartment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Apartment $apartment)
    {
        if($apartment->user_id != Auth::id()){
            abort(403, 'non hai il permesso di entrare qui');
        }
        //validazione
        $request->validate([
            'name' => 'required|string|max:255',
            'rooms' => 'required|integer|min:1|max:255',
            'beds' => 'required|integer|min:1|max:255',
            'bathrooms' => 'required|integer|min:1|max:255',
            'description' => 'required|string|max:65535',
            'size' => 'required|integer|min:10|max:65535',
            'full_address' => 'required|string|max:255',
            'image' => 'image|mimes:jpeg,bmp,png',
            'is_visible' => 'sometimes|accepted',
            'category_id' => 'required|exists:categories,id',
            'services' => 'sometimes|exists:services,id'
        ]);

        $data = $request->all();
        //fetch geo data appartamento
        $geo = '';
        $indirizzo = $data['full_address'];
        //se l'indirizzo cambia, rieseguo la richiesta, altrimenti no
        if ($apartment->full_address != $indirizzo) {
            $geo = Http::get("https://api.tomtom.com/search/2/search/{$indirizzo}.json", [
                'key' => 'RYIXIrvLjWrNeQyGjLi5JoEGgH0IPDU2',
                'countrySet' => 'IT'
            ]);
        }
        $geo_json = json_decode($geo);

        if($apartment->longitude && $apartment->latitude){
            $url_image = "https://api.tomtom.com/map/1/staticimage?key=RYIXIrvLjWrNeQyGjLi5JoEGgH0IPDU2&zoom=16&center={$apartment->longitude},{$apartment->latitude}&format=png&layer=basic&style=main&width=800&height=600";
  
        }else{
            $url_image = "https://api.tomtom.com/map/1/staticimage?key=RYIXIrvLjWrNeQyGjLi5JoEGgH0IPDU2&zoom=16&center={$geo_json->results[0]->position->lon},{$geo_json->results[0]->position->lat}&format=png&layer=basic&style=main&width=800&height=600";
        }


        //update appartamento
        $apartment->name = $data['name'];
        $apartment->rooms = $data['rooms'];
        $apartment->beds = $data['beds'];
        $apartment->bathrooms = $data['bathrooms'];
        $apartment->description = $data['description'];
        $apartment->size = $data['size'];
        $apartment->full_address = $indirizzo;
        $apartment->latitude = $geo_json->results[0]->position->lat ?? $apartment->latitude;
        $apartment->longitude = $geo_json->results[0]->position->lon ?? $apartment->longitude;
        //gestione storage image
        // se l'immagine esiste gia' non e' required e non si aggiorna, non serve l'old sul blade
        if(isset($data['image'])){
            Storage::delete('images' , $apartment->image);
            $apartment->image = Storage::put('images', $data['image']);
        }
        $apartment->map_image = $url_image;
        $apartment->is_visible = isset($data['is_visible']);
        //foreign key
        $apartment->user_id = Auth::id();
        $apartment->category_id = $data['category_id'];
        $apartment->save();
        //pivot servizi
        if(isset($data['services'])){
            $apartment->services()->sync($data['services']);
        }
        

        return redirect()->route('admin.apartments.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Apartment $apartment)
    {   
        if($apartment->user_id != Auth::id()){
            abort(403, 'non hai il permesso di entrare qui');
        }
        Storage::delete('images' , $apartment->image);
        $apartment->delete();

        return redirect()->route('admin.apartments.index');
    }
}
