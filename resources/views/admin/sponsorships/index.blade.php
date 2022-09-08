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
    <div class="content">
        <form method="post" id="payment-form"
            action="{{ route('admin.sponsorships.checkout',[$apartment, $sponsorships['0']]) }}">
            @csrf
            <section>
                <div class="bt-drop-in-wrapper">
                    <div id="bt-dropin"></div>
                </div>
            </section>
            <input id="nonce" name="payment_method_nonce" type="hidden" />
            <button class="button" type="submit"><span>Test Transaction</span></button>
        </form>
    </div>
    </div>
    <script src="https://js.braintreegateway.com/web/dropin/1.13.0/js/dropin.min.js"></script>
    <script>
        var form = document.querySelector('#payment-form');
        var client_token = "{{ $token }}";
        braintree.dropin.create({
          authorization: client_token,
          selector: '#bt-dropin',
        }, function (createErr, instance) {
          if (createErr) {
            console.log('Create Error', createErr);
            return;
          }
          form.addEventListener('submit', function (event) {
            event.preventDefault();
            instance.requestPaymentMethod(function (err, payload) {
              if (err) {
                console.log('Request Payment Method Error', err);
                return;
              }
              // Add the nonce to the form and submit
              document.querySelector('#nonce').value = payload.nonce;
              form.submit();
            });
          });
        });
    </script>
</section>
@endsection