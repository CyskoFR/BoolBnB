<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Apartment;
use App\Service;

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
        $request->validate([
            'full_address' => 'required|string|max:255',
            'rooms' => 'integer|min:1|max:255',
            'beds' => 'integer|min:1|max:255',
            'category_id' => 'exists:categories,id',
            'services' => 'sometimes|exists:services,id'
        ]);

        $request->all();


        $apartment = Apartment::all();

        return $apartment;
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