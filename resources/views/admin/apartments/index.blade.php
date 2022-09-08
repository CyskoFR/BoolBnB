@extends('layouts.back')

@section('content')
<section id="index-apartment" class="p-3">
    <div class="container text-capitalize d-flex flex-column" id="index">
        <h1 class="text-center mt-3 mb-3 text-light">Benvenuto {{ Auth::user()->first_name }}</h1>

        <a class="align-self-center" href="{{route('admin.apartments.create')}}">
            <button class="btn mb-4"><b>Inserisci un nuovo appartamento</b></button>
        </a>

        @foreach ($apartments as $apartment)
        <div class="apartment mb-3 py-5 px-3 d-flex justify-content-between align-items-center">
            <div>
                <a href="{{route('admin.apartments.show', $apartment)}}">
                    <h2>{{$apartment->name}}</h2>
                </a>

                <h3 class="d-none d-md-block">{{$apartment->full_address}}</h3>
            </div>
            <div class="buttons">
                <a href="{{route('admin.messages', $apartment)}}">
                    <button class="btn"><b>Messaggi</b></button>
                </a>

                <a href="{{route('admin.apartments.edit', $apartment)}}">
                    <button class="btn"><b>Modifica</b></button>
                </a>
            </div>
        </div>
        @endforeach

        <a href="/">
            <button class="btn mt-2"><b>Home</b></button>
        </a>

    </div>
</section>
@endsection