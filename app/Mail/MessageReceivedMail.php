<?php

namespace App\Mail;

use App\Message;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MessageReceivedMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The Message instance.
     *
     * @var Message
     */
    protected $message;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( Message $message)
    {
        $this->message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.messageReceived')
                    ->with([
                        'messageName' =>$this->message->full_name,
                        'messageText' =>$this->message->text,
                        'messageSender' =>$this->message->mail,
                        'apartmentName' => $this->message->apartment->name,
                        'apartmentAddress' => $this->message->apartment->full_address,
                        'apartmentOwnerName' => $this->message->apartment->user->first_name,
                        'apartment' => $this->message->apartment
                    ]);
    }
}
