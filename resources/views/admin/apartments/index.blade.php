@extends('layouts.app')

@section('content')
<div class="container text-capitalize">
    <h1 class="text-center">questo e' l'index degli apartments</h1>
    @foreach ($apartments as $apartment)
    <h2>{{$apartment->name}}</h2>
    <h3>{{$apartment->full_address}}</h3>
    @endforeach

</div>
@endsection