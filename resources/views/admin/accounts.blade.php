<?php $title = "Comptes" ?>
@extends('layouts.base')

@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="{{ asset('css/notifications/notifications.css') }}">
@endpush

@section('content')

<div class="mb-5">
    <h1>Comptes</h1>
    <button title="Afegir" class="btn btn-warning modalbtn"><i class="fas fa-plus"></i></button>
    <table class="col-md-6" id="tablaAutomatica">
        <thead>
            <tr>
                <th>Id</th>
                <th>Establiment</th>
                <th>Compte</th>
                <th>Fuc</th>
                <th>Clau</th>
                <th>Creat el</th>
                <th>Actualitzat el</th>
                <th>Creat per</th>
                <th>Actualitzat per</th>
                <th>Habilitada</th>
                <th>Accions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
            <tr id="{{ $item->id }}">
                <td dt-col="id">{{ $item->id }}</td>
                <td dt-col="establishment">{{ $item->establishment }}</td>
                <td dt-col="account">{{ $item->account }}</td>
                <td dt-col="fuc">{{ $item->fuc }}</td>
                <td dt-col="key">{{ $item->key }}</td>
                <td dt-col="created_at">{{ $item->created_at }}</td>
                <td dt-col="updated_at">{{ $item->updated_at }}</td>
                <td dt-col="created_by" >{{ $item->created_by }}</td>
                <td dt-col="updated_by">{{ $item->updated_by }}</td>
                @if($item->deleted_at == null)
                <td>Sí</td>
                @else
                <td>No</td>
                @endif
                <td>
                    <button title="Eliminar" dt-tb="account" dt-id="{{ $item->id }}" class="btn btn-danger deletebtn"><i class="fas fa-trash"></i></button>
                    <button dt-id="{{ $item->id }}" dt-tb="account"
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
        <h5 class="modal-title" id="ModalLongTitle">Compte</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <form>
            <div class="form-group row">
                <label for="establishment" class="col-sm-4 col-form-label">Establiment</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="establishment" name="establishment" required/>
                </div>
            </div>
            <div class="form-group row">
                <label for="account" class="col-sm-4 col-form-label">Compte</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="account" name="account" required/>
                </div>
            </div>
            <div class="form-group row">
                <label for="fuc" class="col-sm-4 col-form-label">Fuc</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="fuc" name="fuc" required/>
                </div>
            </div>
            <div class="form-group row">
                <label for="key" class="col-sm-4 col-form-label">Clau</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="key" name="key" required/>
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
            <button type="button" class="btn btn-success" id="save">Guardar canvis</button>
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
        var id = $('#id').val();
        var id_r = /^[0-9]{1,20}$/;

        var establishment = $('#establishment').val();
        var establishment_r = /^[0-9]{1,11}$/;

        var account = $('#account').val();
        var account_r = /^[a-zA-Z0-9]{1,150}$/;

        var fuc = $('#fuc').val();
        var fuc_r = /^[a-zA-Z0-9]{1,150}$/;

        var key = $('#key').val();
        var key_r = /^[a-zA-Z0-9]{1,150}$/;

        if(id && !id.match(id_r)) {
            errorNotf({
                title: 'Error!',
                message: 'El ID proporcionat no és vàlid',
            });
            throw new Error('El ID proporcionat no és vàlid');
        }

        if(!establishment.match(establishment_r)) {
            errorNotf({
                title: 'Error!',
                message: 'L\'establiment proporcionat no és vàlid',
            });
            throw new Error('L\'establiment proporcionat no és vàlid');
        }

        if(!account.match(account_r)) {
            errorNotf({
                title: 'Error!',
                message: 'El compte proporcionat no és vàlid',
            });
            throw new Error('El compte proporcionat no és vàlid');
        }

        if(!fuc.match(fuc_r)) {
            errorNotf({
                title: 'Error!',
                message: 'El fuc proporcionat no és vàlid',
            });
            throw new Error('El fuc proporcionat no és vàlid');
        }

        if(!key.match(key_r)) {
            errorNotf({
                title: 'Error!',
                message: 'La clau proporcionada no és vàlida',
            });
            throw new Error('La clau proporcionada no és vàlida');
        }

        $.ajax({
            type: 'POST',
            url: '{{ route("account.update") }}',
            data: {
                '_token': '{{ csrf_token() }}',
                id: id,
                establishment: establishment,
                account: account,
                fuc: fuc,
                key: key
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
