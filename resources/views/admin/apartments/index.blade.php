@extends('layouts.back')

@section('content')
<section id="index-apartment" class="p-3">
    <div class="container text-capitalize d-flex flex-column" id="index">
        <h1 class="text-center mt-3 mb-3 text-light">Benvenuto {{ Auth::user()->first_name }}</h1>

        <a class="align-self-center" href="{{route('admin.apartments.create')}}">
            <button class="btn mb-5 create_button"><b>Inserisci un nuovo appartamento</b></button>
        </a>

        @foreach ($apartments as $apartment)
        <div class="apartment row mb-4 p-3 d-flex justify-content-between align-items-center">
            <div class="apartment_info col-12 col-md-8 mr-2">
                <a href="{{route('admin.apartments.show', $apartment)}}">
                    <h2>{{$apartment->name}}</h2>
                </a>

                <h3>{{$apartment->full_address}}</h3>
            </div>
            <div class="buttons d-flex flex-wrap justify-content-center align-items-center">
                <a href="{{route('admin.messages', $apartment)}}">
                    <button class="btn message_button"><b>Messaggi</b></button>
                </a>

                <a href="{{route('admin.apartments.edit', $apartment)}}">
                    <button class="btn modify_button"><b>Modifica</b></button>
                </a>
            </div>
        </div>
        @endforeach

        <a href="/">
            <button class="btn home_button mt-2"><b>Home</b></button>
        </a>

    </div>
</section>
@endsection