@extends('layouts.back')

@section('content')
<section id="index-messages" class="p-3">
    <div class="container">
        @foreach($messages as $message)
        <div class="message d-flex justify-content-between">
            <h3>{{$message->mail}}</h3>
            <h3>{{$message->full_name}}</h3>
            <p>{{$message->text}}</p>
        </div>
        @endforeach
    </div>

</section>
@endsection