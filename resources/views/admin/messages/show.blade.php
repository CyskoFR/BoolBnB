@extends('layouts.back')

@section('content')
<section id="show-messages" class="p-3">

    {{($message->apartment->user->email)}}
    {{$message->text}}

    <form action="{{ route('admin.message.destroy', [$message->apartment ,$message]) }}" method="POST">
        @csrf
        @method('DELETE')
        <button class="btn btn-danger">Elimina Messaggio</button>
    </form>
</section>
@endsection