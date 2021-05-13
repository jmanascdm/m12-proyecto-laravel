<?php $title = "Pagaments" ?>
@extends('layouts.base')

@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="{{ asset('css/notifications/notifications.css') }}">
@endpush

@section('content')

<div>
    <h1>Pagaments</h1>
    <button title="Afegir"  class="anadiRegistro btn btn-warning modalbtn"><i class="fas fa-plus">Afegir Pagament</i></button>
    <table id="tablaAutomatica" style="" class="col-md-6">
        <thead>
            <tr>
                <th>Categoria</th>
                <th>Compte</th>
                <th>Nivell</th>
                <th>Comanda</th>
                <th>Títol</th>
                <th>Descripció</th>
                <th>Preu</th>
                <th>Data inici</th>
                <th>Data final</th>
                <th>Habilitat</th>
                <th>Accions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
            <tr id="{{ $item->id }}">
                <td dt-col="category">{{ $item->category }}</td>
                <td dt-col="account">{{ $item->account }}</td>
                <td dt-col="level">{{ $item->level }}</td>
                <td dt-col="order">{{ $item->order }}</td>
                <td dt-col="title">{{ $item->title }}</td>
                <td dt-col="description">{{ $item->description }}</td>
                <td dt-col="price">{{ $item->price }}</td>
                <td dt-col="start_date">{{ $item->start_date }}</td>
                <td dt-col="end_date">{{ $item->end_date }}</td>
                @if($item->deleted_at == null)
                <td>Sí</td>
                @else
                <td>No</td>
                @endif
                <td>
                    <button dt-tb="payment" dt-id="{{ $item->id }}" class="btn btn-danger deletebtn"><i class="fas fa-trash"></i></button>
                    <button dt-id="{{ $item->id }}" dt-tb="payment"
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
        <h5 class="modal-title" id="ModalLongTitle">Modifica els camps</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <form>
            <div class="form-group row">
                <label for="category" class="col-sm-4 col-form-label">Categoria</label>
                <div class="col-sm-8">
                    <select class="form-control" id="category" name="category" required>
                        <option disabled selected>Sel·lecciona una categoria</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="account" class="col-sm-4 col-form-label">Compte</label>
                <div class="col-sm-8">
                    <select class="form-control" class="form-control" id="account" name="account">
                        <option disabled selected>Sel·lecciona un compte</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="level" class="col-sm-4 col-form-label">Nivell</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="level" name="level" required/>
                </div>
            </div>
            <div class="form-group row">
                <label for="order" class="col-sm-4 col-form-label">Comanda</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="order" name="order" required/>
                </div>
            </div>
            <div class="form-group row">
                <label for="title" class="col-sm-4 col-form-label">Títol</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="title" name="title" required/>
                </div>
            </div>
            <div class="form-group row">
                <label for="description" class="col-sm-4 col-form-label">Descripció</label>
                <div class="col-sm-8">
                    <textarea class="form-control" id="description" name="description" required></textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="price" class="col-sm-4 col-form-label">Preu</label>
                <div class="col-sm-8">
                    <input type="number" class="form-control" id="price" name="price" step="any" required/>
                </div>
            </div>
            <div class="form-group row">
                <label for="start_date" class="col-sm-4 col-form-label">Data inici</label>
                <div class="col-sm-8">
                    <input type="date" class="form-control" id="start_date" name="start_date" required/>
                </div>
            </div>
            <div class="form-group row">
                <label for="end_date" class="col-sm-4 col-form-label">Data final</label>
                <div class="col-sm-8">
                    <input type="date" class="form-control" id="end_date" name="end_date" required/>
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
    $.ajax({
        type: 'GET',
        url: '{{ route("categories.get") }}',
        success: function(e) {
            $(e).each(function(index,element) {
                $('#category').append(`<option value="${element.id}">${element.category}</option>`);
            })
        }
    })
    $.ajax({
        type: 'GET',
        url: '{{ route("accounts.get") }}',
        success: function(e) {
            $(e).each(function(index,element) {
                $('#account').append(`<option value="${element.id}">${element.account}</option>`);
            })
        }
    })
</script>

<script>
    $('#save').click(function() {
        var id = $('#id').val();
        var id_r = /^[0-9]{1,20}$/;

        var category = $('#category').val();
        var category_r = /^[0-9]{1,20}$/;

        var account = $('#account').val();
        var account_r = /^[0-9]{1,20}$/;

        var level = $('#level').val();
        var level_r = /^[a-zA-Z0-9]+$/;

        var order = $('#order').val();
        var order_r = /^[a-zA-Z0-9]{1,20}$/;

        var title = $('#title').val();
        var title_r = /^[a-zA-Z0-9\s]{1,150}$/;

        var description = tinymce.activeEditor.getContent();
        var description_r = /^$/;

        var price = $('#price').val();
        var price_r = /^[0-9]+((,|.){1}[0-9]+)?$/;

        var start_date = $('#start_date').val();
        var start_date_obj = new Date(start_date);
        var end_date = $('#end_date').val();
        var end_date_obj = new Date(end_date);
        var date_r = /^[0-9]{4}\-([0][1-9]|[1][1-2])\-([0][1-9]|[1-2][0-9]|[3][0-2])$/;

        if(id && !id.match(id_r)) {
            errorNotf({
                title: 'Error!',
                message: 'El ID proporcionat no és vàlid',
            });
            throw new Error('El ID proporcionat no és vàlid');
        }

        if(!category || !category.match(category_r)) {
            errorNotf({
                title: 'Error!',
                message: 'La categoria proporcionada no és vàlida',
            });
            throw new Error('L\'establiment proporcionat no és vàlid');
        }

        if(!account || !account.match(account_r)) {
            errorNotf({
                title: 'Error!',
                message: 'El compte proporcionat no és vàlid',
            });
            throw new Error('El compte proporcionat no és vàlid');
        }

        if(!level || !level.match(level_r)) {
            errorNotf({
                title: 'Error!',
                message: 'El nivell proporcionat no és vàlid',
            });
            throw new Error('El nivell proporcionat no és vàlid');
        }

        if(!order || !order.match(order_r)) {
            errorNotf({
                title: 'Error!',
                message: 'La comanda proporcionada no és vàlida',
            });
            throw new Error('La comanda proporcionada no és vàlida');
        }

        if(!order || !title.match(title_r)) {
            errorNotf({
                title: 'Error!',
                message: 'El títol proporcionat no és vàlid',
            });
            throw new Error('El títol proporcionat no és vàlid');
        }

        if(!price || !price.match(price_r)) {
            errorNotf({
                title: 'Error!',
                message: 'El preu proporcionat no és vàlid',
            });
            throw new Error('El preu proporcionat no és vàlid');
        }

        if(!start_date || !start_date.match(date_r)) {
            errorNotf({
                title: 'Error!',
                message: 'La data d\'inici proporcionada no és vàlida',
            });
            throw new Error('La data d\'inici proporcionada no és vàlida');
        }

        if(!end_date || !end_date.match(date_r) || start_date_obj>end_date_obj) {
            errorNotf({
                title: 'Error!',
                message: 'La data final proporcionada no és vàlida',
            });
            throw new Error('La data final proporcionada no és vàlida');
        }

        $.ajax({
            type: 'POST',
            url: '{{ route("payment.update") }}',
            data: {
                '_token': '{{ csrf_token() }}',
                id: id,
                category: category,
                account: account,
                level: level,
                order: order,
                title: title,
                description: description,
                price: price,
                start_date: start_date,
                end_date: end_date
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
