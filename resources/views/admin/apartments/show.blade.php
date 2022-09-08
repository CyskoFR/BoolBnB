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
                <div class="upgrade"><a href="{{route('admin.sponsorships', $apartment)}}">upgrade!</a></div>
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
        <iframe width="100%" height="300" style="border:0" loading="lazy" allowfullscreen
            referrerpolicy="no-referrer-when-downgrade" src="{{"
            https://www.google.com/maps/embed/v1/place?q={$apartment->latitude},{$apartment->longitude}&key=AIzaSyCQ7RWBFjqduEmJrdQxabkp5w1nc0KXZeM&center={$apartment->latitude},{$apartment->longitude}&zoom=18&maptype=satellite"}}">
        </iframe>
        <div class="d-flex py-3" id="actions">
            <a href="{{route('admin.apartments.index')}}">
            <button class="btn update_button mx-2">Indietro</button></a>
            <a href="{{route('admin.apartments.edit', $apartment)}}">
                <button class="btn update_button">Modifica</button>
            </a>
            <button class="btn btn-danger"data-toggle="modal" data-target="#deleteButton">Elimina Appartamento</button>
            <!-- Save Confirm Modal -->
            <div class="modal fade" id="deleteButton" tabindex="-1" role="dialog" aria-labelledby="deleteButtonLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body text-center ">
                            <b>Sei sicuro di voler eliminare questo annuncio?</b>
                        </div>
                        <div class="modal-footer">
                            {{-- form per il destroy --}}
                            <form class="mx-2" action="{{route('admin.apartments.destroy', $apartment)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger"data-toggle="modal" data-target="#deleteButton">Elimina</button>
                            </form>            
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Chiudi</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection