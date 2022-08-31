@extends('layouts.back')

@section('content')
<section id="index-apartment" class="p-3">
    <div class="container text-capitalize " id="index">
        <h1 class="text-center mb-2 text-light">Benvenuto {{ Auth::user()->first_name }}</h1>
        @foreach ($apartments as $apartment)
        <div class="apartment mb-3 p-3 d-flex justify-content-between align-items-center">
            <div>
                <a href="{{route('admin.apartments.show', $apartment)}}">
                    <h2>{{$apartment->name}}</h2>
                </a>

                <h3>{{$apartment->full_address}}</h3>
            </div>
            <div class="buttons">
                <a href="{{route('admin.messages', $apartment)}}">
                    <button class="btn">Messaggi</button>
                </a>

                <a href="{{route('admin.apartments.edit', $apartment)}}">
                    <button class="btn">Modifica</button>
                </a>
            </div>
        </div>
        @endforeach

        <a href="{{route('admin.dashboard')}}">
            <button class="btn">Home</button>
        </a>
    </div>
</section>
@endsection