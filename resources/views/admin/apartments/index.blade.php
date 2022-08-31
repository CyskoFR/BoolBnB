@extends('layouts.back')

@section('content')
<section id="index-apartment" class="p-3">
    <div class="container text-capitalize d-flex flex-column" id="index">
        <h1 class="text-center mt-3 mb-3 text-light">Benvenuto {{ Auth::user()->first_name }}</h1>
        
        <a class="align-self-center" href="{{route('admin.apartments.create')}}">
            <button class="btn mb-4"><b>Crea un nuovo appartamento</b></button>
        </a>

        @foreach ($apartments as $apartment)
        <div class="apartment mb-3 p-3 d-flex justify-content-between align-items-center">
            <div>
                <a href="{{route('admin.apartments.show', $apartment)}}">
                    <h2>{{$apartment->name}}</h2>
                </a>
                
                <h3>{{$apartment->full_address}}</h3>
            </div>
            <div class="buttons">
                <a href="">
                    <button class="btn"><b>Messaggi</b></button>
                </a>
                
                <a href="{{route('admin.apartments.edit', $apartment)}}">
                    <button class="btn"><b>Modifica</b></button>
                </a>
            </div>
        </div>
        @endforeach

        <a href="/">
            <button class="btn"><b>Home</b></button>
        </a>
    </div>
</section>
@endsection