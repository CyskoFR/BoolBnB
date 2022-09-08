@extends('layouts.back')

@section('content')
<section id="show-messages" class="p-4 pt-5">
    <div class="message_container mb-4 p-3">
        <div class="owner_info_section">
            <h3>Messaggio su: <b>{{$message->apartment->name}}</b></h3>
            <h5>in: <b>{{$message->apartment->full_address}}</b></h5>
            <p>del {{date('d-M-y h:i', strtotime($message->created_at))}}</p>
        </div>
        <div class="sender_info_section p-3 pb-4">
            <h4><b>{{$message->full_name}}</b> scrive:</h4>
            <p>{{$message->text}}</p>
        </div>
    </div>
    <button class="btn btn-danger"data-toggle="modal" data-target="#deleteButton">Elimina Messaggio</button>
    <!-- Delete Confirm Modal -->
    <div class="modal fade" id="deleteButton" tabindex="-1" role="dialog" aria-labelledby="deleteButtonLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center ">
                    <b>Sei sicuro di voler eliminare questo messaggio?</b>
                </div>
                <div class="modal-footer">
                    {{-- form per il destroy --}}
                    <form class="mx-2" action="{{ route('admin.message.destroy', [$message->apartment ,$message]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger"data-toggle="modal" data-target="#deleteButton">Elimina</button>
                    </form>            
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Chiudi</button>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection