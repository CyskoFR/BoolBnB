@extends('layouts.back')

@section('content')
<section id="show-messages" class="p-3">

    {{($message->apartment->user->email)}}
    {{$message->text}}

    <form action="{{ route('admin.message.destroy', [$message->apartment ,$message]) }}" method="POST">
        @csrf
        @method('DELETE')
        <button onclick="return confirm('Sei sicuro di voler eliminare questo messaggio?')" class="btn btn-danger">Elimina Messaggio</button>
    </form>
</section>
@endsection