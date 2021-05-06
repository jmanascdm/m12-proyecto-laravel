<?php $title = "Usuaris" ?>
@extends('layouts.base')

@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="{{ asset('css/notifications/notifications.css') }}">
@endpush

@section('content')

<div>
    <h1>Usuaris</h1>
    <button title="Afegir" class="btn btn-warning modalbtn"><i class="fas fa-plus"></i></button>
    <table id="tablaAutomatica" class="col-md-6">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Creat el</th>
                <th>Actualitzat el</th>
                <th>Creat per</th>
                <th>Actualitzat per</th>
                <th>Habilitat</th>
                <th>Accions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
            <tr id="{{ $item->id }}">
                <td dt-col="id">{{ $item->id }}</td>
                <td dt-col="name">{{ $item->name }}</td>
                <td dt-col="email">{{ $item->email }}</td>
                <td dt-col="created_at">{{ $item->created_at }}</td>
                <td dt-col="updated_at">{{ $item->updated_at }}</td>
                <td dt-col="created_by">{{ $item->created_by }}</td>
                <td dt-col="updated_by">{{ $item->updated_by }}</td>
                @if($item->deleted_at == null)
                <td>Sí</td>
                @else
                <td>No</td>
                @endif
                <td>
                    <button dt-tb="user" dt-id="{{ $item->id }}" class="btn btn-danger deletebtn"><i class="fas fa-trash"></i></button>
                    <button dt-id="{{ $item->id }}" dt-tb="user"
                        @if($item->deleted_at == null)
                        dt-enabled="true"
                        @endif
                        class="btn btn-warning modalbtn"><i class="fas fa-edit"></i></button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="modal" tabindex="-1" role="dialog" aria-labelledby="ModalLongTitle" aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="ModalLongTitle">Usuari</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <form>
            <div class="form-group row">
                <label for="email" class="col-sm-4 col-form-label">Email</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="email" name="email" required/>
                </div>
            </div>
        </form>
    </div>
    <div class="modal-footer">
    <div class="mr-auto">
        </div>
        <div>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tancar</button>
            <button type="button" class="btn btn-success" id="save">Enviar</button>
        </div>
    </div>
    </div>
</div>
</div>

@endsection

@push('scripts')

@include('layouts.admin.scripts')
<script>
    $('#save').click(function() {

        var email = $('#email').val();
        var email_r = /^[a-zA-Z0-9]+\@[a-zA-Z0-9]+(\.[a-z]{2,3}){0,2}$/;

        if(!email.match(email_r)) {
            errorNotf({
                title: 'Error!',
                message: 'L\'email proporcionat no és vàlid',
            });
            throw new Error('L\'email proporcionat no és vàlid');
        }

        $.ajax({
            type: 'POST',
            url: '{{ route("user.create") }}',
            data: {
                '_token': '{{ csrf_token() }}',
                email: email
            }, beforeSend: function() {
                infoNotf({
                    title: 'Processant...',
                    message: 'S\'està processant la petició',
                });
            }, success: function() {
                successNotf({
                    title: 'Fet!',
                    message: 'S\'ha enviat una notificació al correu especificat',
                });
            }, error: function() {
                errorNotf({
                    title: 'Error!',
                    message: 'No s\'ha pogut processar la petició',
                });
            }
        })
    })
</script>

@endpush
