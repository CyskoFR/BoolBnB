@extends('layouts.back')

@section('content')
<section id="index-sponsorships" class="p-5">
    <div class="container-fluid d-flex flex-column align-items-center text-center">
        <div class="sponsorship gold d-flex justify-content-around mt-3 py-4">
            <div class="hidden gold mx-5">GOLD</div>
            <div class="rombo">
                <div class="label">Gold</div>
            </div>
            <div class="upgrade">
                <div>Upgrade di 144 ore!</div>
                <div>9,99 €</div>
            </div>
        </div>
        <div class="sponsorship silver d-flex justify-content-around mt-3 py-4">
            <div class="hidden silver mx-5">SILVER</div>
            <div class="upgrade">
                <div>Upgrade di 72 ore!</div>
                <div>5,99 €</div>
            </div>
            <div class="rombo">
                <div class="label">Silver</div>
            </div>
        </div>
        <div class="sponsorship bronze d-flex justify-content-around mt-3 py-4">
            <div class="hidden bronze mx-5">BRONZE</div>
            <div class="rombo">
                <div class="label">Bronze</div>
            </div>
            <div class="upgrade">
                <div>Upgrade di 24 ore!</div>
                <div>2,99 €</div>
            </div>
        </div>
        <a href="{{route('admin.apartments.show', $apartment)}}">
            <button class="btn comeback_button my-3">Ci voglio ripensare</button></a>
    </div>
</section>
@endsection