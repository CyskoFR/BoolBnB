<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Message;
use App\Apartment;
use Faker\Core\Number;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    // public function isUserAuth(Apartment $apartment){
    //     if($apartment->user_id != Auth::id()){
    //         abort(403, 'non hai il permesso di entrare qui');
    //     }
    //     return;
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Apartment $apartment)
    {
        if($apartment->user_id != Auth::id()){
            abort(403, 'non hai il permesso di entrare qui');
        }
        $messages = Message::query()->where('apartment_id', $apartment->id)->get();
        return view('admin.messages.index', compact('messages'));
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( Apartment $apartment, Message $message)
    {
        if($apartment->user_id != Auth::id()){
            abort(403, 'non hai il permesso di entrare qui');
        }
         return view('admin.messages.show', compact('message'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Apartment $apartment ,Message $message)
    {
        $message->delete();
        $messages = Message::query()->where('apartment_id', $apartment->id)->get();

        return view('admin.messages.index', compact('messages'));
    }

    
}
