@extends('layouts.back')

@section('content')
<section id="show-messages" class="p-3">

    {{($message->apartment->user->email)}}
    {{$message->text}}
</section>
@endsection