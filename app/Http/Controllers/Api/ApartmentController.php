<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Apartment;
use App\Service;

class ApartmentController extends Controller
{
    

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

    public function getApartment(Request $request)
    {
        $id = $request->all();
        $apartment = Apartment::query()->where('id', $id)->with('user', 'category', 'services')->get();

        return $apartment;
    }

   /* public function getServices(Request $request)
    {
        $id = $request->all();
        $apartment = Apartment::find($id);
        $services = Service::whereHas('apartments', function ($query) use ($id) {
            $query->where('apartment_id', $id);
        })->get();

        return $services;
    }*/
}