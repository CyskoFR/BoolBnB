<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- stylesheet specifica per la SPA --}}
    <link rel="stylesheet" href="{{asset('css/front.css')}}">
    <title>Home BoolBnB</title>
</head>

<body>
    <div id="root">
        {{-- app vue running --}}
    </div>
    {{-- script che inizializza Vue e esegue l'hook a #root --}}
    <script src="{{asset('js/front.js')}}"></script>
</body>

</html>