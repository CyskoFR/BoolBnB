@extends('layouts.back')

@section('content')
<section id="show-apartment">
    <div class="container text-capitalize">
        <div class="d-flex justify-content-between align-items-center py-3">
            <div class="title_addres">
                <h2 class="pt-4">{{$apartment->name}}</h2>
                <h5 class="text-start flex-wrap">{{$apartment->full_address}}</h5>
            </div>
            <div class="rombo">
                <div class="upgrade"><a href="#">upgrade!</a></div>
            </div>
        </div>
        <img class="img-fluid rounded" src="{{asset('storage/'.$apartment->image)}}" alt="">
        <h4 class="text-start pt-4">{{$apartment->category->name}}</h4>
        <p>{{$apartment->size}}mq - camere {{$apartment->rooms}} - letti {{$apartment->beds}} - bagni
            {{$apartment->bathrooms}}</p>
        <h4 class="text-start">Informazioni</h4>
        <p>{{$apartment->description}}</p>
        <h4>Servizi</h4>
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
        <iframe width="600" height="450" style="border:0" loading="lazy" allowfullscreen
            referrerpolicy="no-referrer-when-downgrade" src="{{"
            https://www.google.com/maps/embed/v1/view?key=AIzaSyCQ7RWBFjqduEmJrdQxabkp5w1nc0KXZeM&center={$apartment->latitude},{$apartment->longitude}&zoom=18&maptype=satellite"}}">
        </iframe>
        <div class="d-flex py-3" id="actions">
            <a href="{{route('admin.apartments.edit', $apartment)}}">
                <button class="btn update_button">Modifica</button></a>
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