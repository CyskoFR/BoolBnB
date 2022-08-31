<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $request->validate([
            'apartment_id' => 'required|exists:apartments,id',
            'mail' => 'required|email:filter|max:50',
            'full_name' => 'required|string|max:100',
            'text' => 'required|string|max:65535'
         ]);
         
         $data = $request->all();
         $newMessage = new Message();

         $newMessage->apartment_id = $data['apartment_id'];
         $newMessage->mail = $data['mail'];
         $newMessage->full_name = $data['full_name'];
         $newMessage->text = $data['text'];
         $newMessage->save();
    }

}