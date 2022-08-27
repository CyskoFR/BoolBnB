@extends('layouts.app')

@section('content')
<div class="container ">
    <h1 class="text-center">Qui e' la pagina di edit dell'appartamento</h1>
    <form>
        <div class="form-group">
            <label for="input-name">Titolo dell' annuncio:</label>
            <input type="text" class="form-control" id="input-name"
                placeholder="Inserisci qui il titolo dell'annuncio...">
            <small id="input-name-help" class="form-text text-muted">Max n caratteri</small>
        </div>
        <div class="form-group ">
            {{-- Number: Numero Stanze --}}
            <div class="row pb-2 ">
                <div class="col">
                    <label for="input-rooms">Stanze</label>
                    <input type="number" class="form-control" id="input-rooms" min="1" step="1"
                        placeholder="Inserisci il numero delle stanze...">
                </div>
                {{-- Number: Numero Letti --}}
                <div class="col">
                    <label for="input-beds">Letti</label>
                    <input type="number" class="form-control" id="input-beds" min="1" step="1"
                        placeholder="Inserisci il numero dei letti...">
                </div>

            </div>
            <div class="row pt-2">
                <div class="col">
                    <label for="input-bathrooms">Bagni</label>
                    <input type="number" class="form-control" id="input-bathrooms" min="1" step="1"
                        placeholder="Inserisci il numero dei bagni...">
                </div>
                {{-- Number: Dimensione --}}
                <div class="col">
                    <label for="input-rooms">Dimensioni in m2</label>
                    <input type="number" class="form-control" id="input-rooms" min="1" step="1"
                        placeholder="Immetti la dimensione...">
                </div>

            </div>
            {{-- Number: Numero Bagni --}}

        </div>
        {{-- Textarea: Descrizione appartamento --}}
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Descrizione del locale:</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="5"></textarea>
        </div>
        {{-- Input Text: full_address --}}
        <div class="form-group">
            <label for="input-address">Indirizzo completo:</label>
            <input type="text" class="form-control" id="input-address"
                placeholder="Inserisci qui l'indirizzo del locale...">
        </div>
        {{-- check-box: is_visible --}}
        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Pubblica</label>
        </div>



        <button type="submit" class="btn btn-primary">Submit</button>
    </form>



</div>
@endsection