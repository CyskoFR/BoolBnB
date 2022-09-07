<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\MessageReceivedMail;
use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
         //dd($request);
         $data = $request->all();
         $newMessage = new Message();

         $newMessage->apartment_id = $data['apartment_id'];
         $newMessage->mail = $data['mail'];
         $newMessage->full_name = $data['full_name'];
         $newMessage->text = $data['text'];
         $newMessage->save();

         //indirizzo email del proprietario
         $mailto = $newMessage->apartment->user->email;
         //invio mail
         Mail::to($mailto)->send(new MessageReceivedMail($newMessage));
    }

}
