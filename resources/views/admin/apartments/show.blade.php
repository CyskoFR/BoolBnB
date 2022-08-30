@extends('layouts.app')

@section('content')
{{-- -- @dd($apartment->user) -- --}}
{{-- @dd($geo_json->results[0]->position->lat); --}}
<div class="container text-capitalize">
    <h1 class="text-center">dettaglio appartamento in back-office</h1>
    <h2>{{$apartment->name}}</h2>

    <ul>
        <li>
            latitudine {{$apartment->latitude}}
        </li>
        <li>
            longitudine {{$apartment->longitude}}
        </li>
    </ul>
    <img class="img-fluid" src="{{asset('storage/'.$apartment->image)}}" alt="">
    <div id="actions">
        <a class="btn btn-primary" href="{{route('admin.apartments.edit', $apartment)}}">Modifica</a>
        {{-- form per il destroy --}}
        <form action="{{route('admin.apartments.destroy', $apartment)}}" method="POST">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger">Elimina Appartamento</button>

        </form>

    </div>
</div>
@endsection