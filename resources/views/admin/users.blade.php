<?php $title = "Usuaris" ?>
@extends('layouts.base')

@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="{{ asset('css/notifications/notifications.css') }}">
@endpush

@section('content')

<div>
    <h1>Usuaris</h1>
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
                <td>
                    <button dt-tb="user" dt-id="{{ $item->id }}" class="btn btn-danger deletebtn"><i class="fas fa-trash"></i></button>
                    <button dt-id="{{ $item->id }}" class="btn btn-warning modalbtn"><i class="fas fa-edit"></i></button>
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
        <h5 class="modal-title" id="ModalLongTitle">un usuari</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <form>
            <div class="form-group row">
                <label for="name" class="col-sm-4 col-form-label">Nom</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="name" name="name" required/>
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-sm-4 col-form-label">Email</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="email" name="email" required/>
                </div>
            </div>
            <input type="hidden" class="form-control" id="id" name="id" required/>
        </form>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tancar</button>
        <button type="button" class="btn btn-success" id="save">Guardar canvis</button>
    </div>
    </div>
</div>
</div>

@endsection

@push('scripts')

@include('layouts.admin.scripts')
<script>
    $('#save').click(function() {
        var id = $('#id').val();
        var id_r = /^[0-9]{1,20}$/;

        var name = $('#name').val();
        var name_r = /^[a-zA-Z0-9]{1,255}$/;

        var email = $('#email').val();
        var email_r = /(?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:(2(5[0-5]|[0-4][0-9])|1[0-9][0-9]|[1-9]?[0-9]))\.){3}(?:(2(5[0-5]|[0-4][0-9])|1[0-9][0-9]|[1-9]?[0-9])|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])/;

        if(id && !id.match(id_r)) {
            errorNotf({
                title: 'Error!',
                message: 'El ID proporcionat no és vàlid',
            });
            throw new Error('El ID proporcionat no és vàlid');
        }

        if(!name.match(name_r)) {
            errorNotf({
                title: 'Error!',
                message: 'El compte proporcionat no és vàlid',
            });
            throw new Error('El nom proporcionat no és vàlid');
        }

        if(!email.match(email_r)) {
            errorNotf({
                title: 'Error!',
                message: 'L\'establiment proporcionat no és vàlid',
            });
            throw new Error('L\'email proporcionat no és vàlid');
        }

        $.ajax({
            type: 'POST',
            url: '{{ route("user.edit") }}',
            data: {
                '_token': '{{ csrf_token() }}',
                id: id,
                name: name,
                email: email
            }, beforeSend: function() {
                infoNotf({
                    title: 'Processant...',
                    message: 'S\'està processant la petició',
                });
            }, success: function() {
                successNotf({
                    title: 'Fet!',
                    message: 'Base de dades actualitzada correctament',
                });
                location.reload();
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
