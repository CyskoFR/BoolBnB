@extends('layouts.app')

@section('content')
<div class="container text-capitalize " id="index">
    <h1 class="text-center">questo e' l'index degli apartments</h1>
    @foreach ($apartments as $apartment)
    <div class="p-3 bg-warning rounded">
        <a href="{{route('admin.apartments.show', $apartment)}}
        ">
            <h2>{{$apartment->name}}</h2>
        </a>

        <h3>{{$apartment->full_address}}</h3>

    </div>

    @endforeach

</div>
@endsection