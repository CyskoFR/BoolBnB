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

    <div id="actions">
        <a class="btn btn-primary" href="{{route('admin.apartments.edit', $apartment)}}">Modifica</a>
        {{-- form per il destroy --}}
        {{-- <a class="btn btn-danger" href="{{route('admin.apartments.edit', $apartment)}}">Modifica</a> --}}
    </div>
</div>
@endsection