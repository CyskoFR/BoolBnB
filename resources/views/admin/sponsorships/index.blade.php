@extends('layouts.back')
@section('content')
<section id="index-sponsorships" class="p-5">
  <div class="container-fluid d-flex flex-column align-items-center text-center">
    <h2 id="title">Seleziona un metodo di pagamento per continuare:</h2>
    @foreach ($sponsorships as $sponsorship)
    <div class="sponsorship  {{strtolower($sponsorship->name)}} d-flex justify-content-around mt-3 py-4">
      <div class="hidden  mx-5">{{$sponsorship->name}}</div>
      <div class="rombo">
        <div class="label">{{$sponsorship->name}}</div>
      </div>
      <div class="upgrade">
        <div>Upgrade di {{$sponsorship->duration}} ore!</div>
        <div>{{$sponsorship->price}} €</div>
      </div>
    </div>

    @endforeach


    <div class="content">
      <form class="py-4" method="post" id="payment-form"
        action="{{ route('admin.sponsorships.checkout', $apartment )}}">
        @csrf
        <section>
          <div class="bt-drop-in-wrapper">
            <div id="bt-dropin"></div>
          </div>
        </section>
        <input class="d-none" type="text" name="package" id="package">
        <input id="nonce" name="payment_method_nonce" type="hidden" />
        <a href="{{route('admin.apartments.show', $apartment)}}">
          <button class="btn comeback_button my-3">Ci voglio ripensare</button>
        </a>
        <button class="button  btn btn-primary" type="submit"><span>Conferma</span></button>
      </form>
    </div>

  </div>
  </div>
  <script src="https://js.braintreegateway.com/web/dropin/1.13.0/js/dropin.min.js"></script>
  <script>
    // let selectedSponsorship = new Set()
    let package = document.querySelector('#package');
    package.value = '';
    let sponsorships = [...{!! $sponsorships !!}].map(e => e.name)
    const sponsorshipsTagBronze =  document.querySelector(".sponsorship.bronze");
    let sponsorshipsTagSilver =  document.querySelector(".sponsorship.silver");
    let sponsorshipsTagGold =  document.querySelector(".sponsorship.gold");
    sponsorshipsTagBronze.addEventListener('click', e =>{
      package.value = '';
      package.value = 'Bronze';
      console.log(package.value);
      sponsorshipsTagBronze.classList.add('selected');
      sponsorshipsTagSilver.classList.remove('selected');
      sponsorshipsTagGold.classList.remove('selected');
    });
    sponsorshipsTagSilver.addEventListener('click', e =>{
      package.value = '';
      package.value = 'Silver';
      console.log(package.value);
      sponsorshipsTagBronze.classList.remove('selected');
      sponsorshipsTagSilver.classList.add('selected');
      sponsorshipsTagGold.classList.remove('selected');
    })
    sponsorshipsTagGold.addEventListener('click', e =>{
      package.value = '';
      package.value = 'Gold';
      console.log(package.value);
      sponsorshipsTagBronze.classList.remove('selected');
      sponsorshipsTagSilver.classList.remove('selected');
      sponsorshipsTagGold.classList.add('selected');
    })
    
    //form di pagamento
    const title = document.querySelector('h2#title');
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
              if (err || !sponsorships.includes(package.value) ) {
                title.classList.add('text-danger');
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