<h2>Hey {{$apartmentOwnerName}} hai ricevuto un nuovo messaggio!! </h2>
<h3>
    L'Utente {{$messageName}} e' interessato al tuo annuncio dal titolo {{$apartmentName}}!
</h3>
<h3>Situato all'indirizzo:
    <i>{{$apartmentAddress}}</i>
</h3>
<h4>Il messaggio dice:</h4>
<p>{{$messageText}}</p>

<h4>Ricontattalo alla sua e-mail: {{$messageSender}}</h4>
<a href="{{route('admin.messages', $apartment)}}">Vai alla pagina dei messaggi</a>