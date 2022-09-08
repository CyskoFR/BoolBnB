@extends('layouts.back')
@section('content')
<section id="index-sponsorships" class="p-5">
  <div class="container-fluid d-flex flex-column align-items-center text-center">
    @foreach ($sponsorships as $sponsorship)
    <div class="sponsorship gold d-flex justify-content-around mt-3 py-4">
      <div class="hidden gold mx-5">{{$sponsorship->name}}</div>
      <div class="rombo">
        <div class="label">{{$sponsorship->name}}</div>
      </div>
      <div class="upgrade">
        <div>Upgrade di {{$sponsorship->duration}} ore!</div>
        <div>{{$sponsorship->price}} €</div>
      </div>
    </div>

    @endforeach

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