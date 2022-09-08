@extends('layouts.back')
@section('content')
<section id="index-messages" class="p-3">
    <div class="container text-capitalize d-flex flex-column" id="index">
        <h1 class="text-center mt-2 mb-4">Ecco l'elenco dei messaggi per il tuo appartamento</h1>
        @foreach ($messages as $message)
        <div class="message_container mb-3">
            <div class="message-header row  mb-3 mb-md-0 justify-content-between align-items-center ">
                <div class="col-9 pl-4 text-truncate d-flex flex-column align-items-start">
                    <a href="{{route('admin.message.show', [$message->apartment, $message])}}">
                        <h4 class="pt-2 pb-1">{{$message->full_name}}</h4>
                    </a>
                    <h5>{{$message->mail}}</h5>
                </div>
                <div class="col-3 mx-auto d-flex justify-content-center">
                    <span class="d-inline-block">{{ date('d-M-y h:i', strtotime($message->created_at)) }}</span>
                </div>
            </div>
            <div class="message-body px-3 d-none d-md-block mb-3">
                <p class="m-0 container py-2">
                    {{$message->text}}
                </p>
            </div>
        </div>

        @endforeach

        <a href="/">
            <button class="btn mt-2"><b>Home</b></button>
        </a>
    </div>
</section>
@endsection