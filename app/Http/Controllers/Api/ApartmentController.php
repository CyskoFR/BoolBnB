<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Apartment;

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
        $apartment = Apartment::query()->where('id', $id)->get();

        return $apartment;
    }
}