<div class="container">
    <h1>Buone notizie <b>{{$apartmentOwnerName}}</b>, hai ricevuto un nuovo messaggio ! </h1>

    <div class="card">
        <h2>L'Utente <b>{{$messageName}}</b> e' interessato al tuo annuncio o dal titolo <b>"{{$apartmentName}}"</b></h2>

        <h2>L'indirizzo dell' annuncio è il seguente:
            <b>{{$apartmentAddress}}</b>
        </h2>
        <br>

        <h2>Il messaggio:</h2>
        <div class="message">
            <h3>{{$messageText}}.</h3>
        </div>
        <br>
        <h4>Ricontattalo subito alla sua e-mail: <b>{{$messageSender}}</b></h4>
        <br>

        <div class="card-footer">
            <button>
                <a href="{{route('admin.messages', $apartment)}}">Vai alla pagina dei messaggi</a>
            </button>
        </div>
    </div>
</div>
    
    <style>
    
        .container {
            background-color: #303030;
            color: #e1e1e1;
            
            padding: 20px;
            border-radius: 8px;
        }
    
        .card {
            border: 2px solid #8d8c8c;
            padding: 20px;
            border-radius: 8px;
            background-color: #1a1a1a;
        }

        .card-footer {
            width: 100%;
            display: flex;
            justify-content: center;
        }
    
        button {
            font-size: .875rem;
            background-color: #42d392;
            border-radius: 8px;
            margin-right: .625rem;
            padding: 10px;
            transition: 0.3s;
        }

        button:hover {
            scale: 1.1;
            transition: 0.3s;
        }
    
        a {
            min-width: 200px;
            text-decoration: none;
            color: black;
        }

        b {
            color: #42d392;
        }

        .message {
            background-color: #303030;
            border-radius: 8px;
            padding: 30px;
            border: 1px solid #8d8c8c;
        }

        h3 {
            margin: 0;
            word-break: break-all;
        }
    
    </style>
