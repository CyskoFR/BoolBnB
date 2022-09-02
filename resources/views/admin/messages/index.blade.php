@extends('layouts.back')
@section('content')
<section id="index-messages" class="p-3">
    <div class="container text-capitalize d-flex flex-column" id="index">
        <h1 class="text-center mt-3 mb-3">Ecco l'elenco dei messaggi per il tuo appartamento</h1>
        @foreach ($messages as $message)
        <div>
            <div class="message-header row  mb-3 mb-md-0 justify-content-between align-items-center ">
                <div class=" col-6 pl-3 text-truncate  col-6 d-flex flex-column align-items-start">
                    <a href="{{route('admin.message.show', [$message->apartment, $message])}}">
                        <h4 class="pt-2 pb-1">{{$message->full_name}}</h4>
                    </a>
                    <h5 class="d-none d-md-block">{{$message->mail}}</h5>
                </div>
                <div class="col-6  mx-auto d-flex justify-content-center">
                    <span class="d-inline-block">{{$message->created_at}}</span>
                </div>
                {{-- <div class="buttons col-1  justify-content-end d-none d-md-flex">
                    <a href="#">Delete</a>
                </div> --}}
            </div>
            <div class="message-body px-3 d-none d-md-block mb-3">
                <p class=" container py-2">
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