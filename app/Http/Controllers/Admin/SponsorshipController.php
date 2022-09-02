<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Apartment;
use App\Sponsorship;
use Illuminate\Http\Request;
 /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
class SponsorshipController extends Controller
{
    public function index(Apartment $apartment, Sponsorship $sponsorship)
    {
        return view('admin.sponsorships.index', compact('apartment'));
    }
}
