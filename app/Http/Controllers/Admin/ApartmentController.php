<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

use App\Apartment;
use App\Category;
use App\Service;
use Illuminate\Support\Facades\Auth;
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
        $apartments = Apartment::all();
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
        
        //creazione appartamento
        $apartment = new Apartment();
        $apartment->name = $data['name'];
        $apartment->rooms = $data['rooms'];
        $apartment->beds = $data['beds'];
        $apartment->bathrooms = $data['bathrooms'];
        $apartment->description = $data['description'];
        $apartment->size = $data['size'];
        $apartment->full_address = $indirizzo;
        $apartment->latitude = $geo_json->results[0]->position->lat;
        $apartment->longitude = $geo_json->results[0]->position->lon;
        $apartment->image = Storage::put('images', $data['image']);
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Apartment $apartment)
    {

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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Apartment $apartment)
    {
        $apartment->delete();
        return redirect('admin.apartments.index');
    }
}
