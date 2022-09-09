@extends('layouts.back')

@section('content')
<<<<<<< HEAD
{{$transaction}}
=======
{{-- @dd($transaction); --}}
<section id="transaction-result" class="d-flex flex-column align-items-center py-5">
    <h2>La tua transasione di {{$transaction->amount}}€ è stata eseguita con successo!</h2>
    <h3>Grazie per aver effettuato l'upgrade {{$transaction->customer['firstName']}}!</h3>
    <a href="{{route('admin.apartments.index')}}">
        <button class="btn update_button my-4">Torna ai tuoi appartamenti</button>
    </a>
</section>

>>>>>>> bb2af64ed824a58d7ea032dba719188da6db2e3e
@endsection