@extends('layouts.back')
{{-- //@dd($transaction); --}}
@section('content')

<section id="transaction-result" class="d-flex flex-column align-items-center py-5">
    <h2>La tua transasione di {{$transaction->amount}}€ è stata eseguita con successo!</h2>
    <h3>Grazie per aver effettuato l'upgrade {{$transaction->customer['firstName']}}!</h3>
    <a href="{{route('admin.apartments.show', request()->route()->parameters['apartment'])}}">
        <button class="btn update_button my-4">Torna all'appartamento</button>
    </a>
</section>
@endsection