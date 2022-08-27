@extends('layouts.app')

@section('content')
-- @dd($apartment->user) --
<div class="container text-capitalize">
    <h1 class="text-center">dettaglio appartamento in back-office</h1>
    <h2>{{$apartment->name}}</h2>

    <div id="actions">
        <a class="btn btn-primary" href="{{route('admin.apartments.edit', $apartment)}}">Modifica</a>
        {{-- form per il destroy --}}
        {{-- <a class="btn btn-danger" href="{{route('admin.apartments.edit', $apartment)}}">Modifica</a> --}}
    </div>
</div>
@endsection