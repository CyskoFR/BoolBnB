@extends('layouts.app')

@section('content')
<section id="show-apartment">
    <div class="container text-capitalize">
        <h1 class="text-start py-2">{{$apartment->name}}</h1>
        <h2 class="text-start py-1">{{$apartment->full_address}}</h2>
        <img class="img-fluid rounded" src="{{asset('storage/'.$apartment->image)}}" alt="">
        <h4 class="text-start py-1">{{$apartment->category->name}}</h4>
        <p>{{$apartment->size}}mq - camere {{$apartment->rooms}} - letti  {{$apartment->beds}} - bagni {{$apartment->bathrooms}}</p>
        <h4>Informazioni</h4>
        <p>{{$apartment->description}}</p>
        <h4>Serzizi</h4>
        <ul>
            @foreach ($apartment->services as $service)
            <li class="px-2">{{$service->name}}</li>
            @endforeach
        </ul>
        <h4>Posizione</h4>
        <ul>
            <li>
                latitudine {{$apartment->latitude}}
            </li>
            <li>
                longitudine {{$apartment->longitude}}
            </li>
        </ul>
        <div class="d-flex py-2" id="actions">
            <a class="btn btn-primary" href="{{route('admin.apartments.edit', $apartment)}}">Modifica</a>
            {{-- form per il destroy --}}
            <form class="px-2" action="{{route('admin.apartments.destroy', $apartment)}}" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger">Elimina Appartamento</button>
            </form>
        </div>   
    </div>
</section>

@endsection