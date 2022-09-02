@extends('layouts.back')

@section('content')
<section id="index-sponsorships" class="p-5">
    <div class="container d-flex flex-column align-items-center text-center">
        <div class="sponsorship gold d-flex justify-content-around mt-3 py-4">
            <div class="rombo">
                <div class="label">Gold</div>
            </div>
            <div>
                <div>Upgrade di 144 ore!</div>

                <div>9,99 €</div>
            </div>
        </div>
        <div class="sponsorship silver d-flex justify-content-around mt-3 py-4">
            <div>
                <div>Upgrade di 72 ore!</div>

                <div>5,99 €</div>
            </div>
            <div class="rombo">
                <div class="label">Silver</div>
            </div>
        </div>
        <div class="sponsorship bronze d-flex justify-content-around mt-3 py-4">
            <div class="rombo">
                <div class="label_bronze">Bronze</div>
            </div>
            <div>
                <div>Upgrade di 24 ore!</div>
                <div>2,99 €</div>
            </div>
        </div>
        <a href="{{route('admin.apartments.show', $apartment)}}">
            <button class="btn update_button my-3">Ci voglio ripensare</button></a>
    </div>
</section>
@endsection