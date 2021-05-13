<?php $title = "Usuaris" ?>
@extends('layouts.base')

@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="{{ asset('css/notifications/notifications.css') }}">
<link rel="stylesheet" href="{{ asset('miCss.css') }}">
@endpush

@section('content')

<div>
    <h1>Usuaris</h1>
    <button title="Afegir" id="addbtn" class="anadiRegistro btn btn-warning"><i class="fas fa-plus">Afegir Usuari</i></button>
    <table id="tablaAutomatica" class="col-md-6">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Email</th>
                <th>Admin</th>
                <th>Habilitat</th>
                <th>Accions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
            <tr id="{{ $item->id }}">
                <td dt-col="name">{{ $item->name }}</td>
                <td dt-col="email">{{ $item->email }}</td>
                @if($item->admin == 1)
                <td dt-col="admin">Sí</td>
                @else
                <td dt-col="admin">No</td>
                @endif
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

<!-- Modal afegir -->
<div class="modal fade bd-example-modal-lg" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="ModalLongTitle" aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="ModalLongTitle">Afegir usuari</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <form>
            <div class="form-group row">
                <label for="email" class="col-sm-4 col-form-label">Email</label>
                <div class="col-sm-8">
                    <input type="email" class="form-control" id="addemail" name="addemail" required/>
                </div>
            </div>
        </form>
    </div>
    <div class="modal-footer">
    <div class="mr-auto">
        </div>
        <div>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tancar</button>
            <button type="button" class="btn btn-success" data-dismiss="modal" id="add">Enviar</button>
        </div>
    </div>
    </div>
</div>
</div>

<!-- Modal editar -->
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
                <label for="name" class="col-sm-4 col-form-label">Nom</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="name" name="name" required/>
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-sm-4 col-form-label">Email</label>
                <div class="col-sm-8">
                    <input type="email" class="form-control" id="email" name="email" required/>
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-sm-4 col-form-label">Admin</label>
                <div class="col-sm-8">
                    <input type="checkbox" class="form-control" id="admin" name="admin" required/>
                </div>
            </div>
            <input type="hidden" class="form-control" id="id" name="id" required/>
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
<!-- Afegir usuaris -->
<script>
    $('#addbtn').click(function (){
        $('#modalAdd').modal();
    })
</script>
<script>
    $('#add').click(function() {

        var email = $('#addemail').val();
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
<!-- Editar usuaris -->
<script>
    $('#save').click(function (){
        var id = $('#id').val();
        var id_r = /^[0-9]{1,20}$/;

        var name = $('#name').val();
        var name_r = /^[ña-zA-Z0-9\s]{4,255}$/;

        var email = $('#email').val();
        var email_r = /^[a-zA-Z0-9]+\@[a-zA-Z]+(\.[a-zA-Z]{2,3}){1,2}$/;

        var admin;
        var admin_c = $('#admin')[0].checked;
        if(admin_c) admin = 1;
        else admin = 0;

        if(!id || !id.match(id_r)) {
            errorNotf({
                title: 'Error!',
                message: 'El ID proporcionat no és vàlid',
            });
            throw new Error('El ID proporcionat no és vàlid');
        }

        if(!name || !name.match(name_r)) {
            errorNotf({
                title: 'Error!',
                message: 'El nom proporcionat no és vàlid',
            });
            throw new Error('El nom proporcionat no és vàlid');
        }

        console.log(email);

        if(!email || !email.match(email_r)) {
            errorNotf({
                title: 'Error!',
                message: 'L\'email proporcionat no és vàlid',
            });
            throw new Error('L\'email proporcionat no és vàlid');
        }

        $.ajax({
            type: 'POST',
            url: '{{ route("user.update") }}',
            data: {
                '_token': '{{ csrf_token() }}',
                id: id,
                name: name,
                email: email,
                admin: admin
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
