<?php $title = "Categories" ?>
@extends('layouts.base')

@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="{{ asset('css/notifications/notifications.css') }}">
@endpush

@section('content')

<div>
    <h1>Categories</h1>
    <button title="Afegir" class="anadiRegistro btn btn-warning modalbtn"><i class="fas fa-plus">Afegir Categoria</i></button>
    <table id="tablaAutomatica" class="col-md-6">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Habilitada</th>
                <th>Accions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
            <tr id="{{ $item->id }}">
                <td data-col="category">{{ $item->category }}</td>
                @if($item->deleted_at == null)
                <td>Sí</td>
                @else
                <td>No</td>
                @endif
                <td>
                    <button data-id="{{ $item->id }}" data-tb="category" class="btn btn-danger deletebtn"><i class="fas fa-trash"></i></button>
                    <button data-id="{{ $item->id }}" data-tb="category"
                        @if($item->deleted_at == null)
                        data-enabled="true"
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
        <h5 class="modal-title" id="ModalLongTitle">Categoria</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <form>
            <div class="form-group row">
                <label for="category" class="col-sm-4 col-form-label">Nom</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="category" name="category" required/>
                </div>
            </div>
            <input type="hidden" class="form-control" id="id" name="id"/>
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

        var category = $('#category').val();
        var category_r = /^[a-zA-Z0-9\s]{1,150}$/;

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
            throw new Error('La categoria proporcionada no és vàlida');
        }

        $.ajax({
            type: 'POST',
            url: '{{ route("category.update") }}',
            data: {
                '_token': '{{ csrf_token() }}',
                id: id,
                category: category,
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
            }, error: function(e) {
                var error = 'No s\'ha pogut processar la petició:';
                $.each($(e)[0].responseJSON.errors, function(index,element) {
                    error += "\n·"+element[0]; 
                });
                errorNotf({
                    title: 'Error!',
                    message: error,
                });
            }
        })
    })
</script>

@endpush
