@extends('layouts.base')

@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="{{ asset('css/notifications/notifications.css') }}">
@endpush

@section('content')

<div style="padding-top: 4%; padding-bottom: 4%;">
    <table id="tablaAutomatica" style="text-align: center; width: 70%;">
        <thead>
            <tr>
                <th>Id</th>
                <th>Establiment</th>
                <th>Compte</th>
                <th>Fuc</th>
                <th>Clau</th>
                <th>Habilitat</th>
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
                <td dt-type="number" dt-col="id" dt-col_ca="Id">{{ $item->id }}</td>
                <td dt-type="number" dt-col="establishment" dt-col_ca="Establiment">{{ $item->establishment }}</td>
                <td dt-type="text" dt-col="account" dt-col_ca="Compte">{{ $item->account }}</td>
                <td dt-type="text" dt-col="fuc" dt-col_ca="Fuc">{{ $item->fuc }}</td>
                <td dt-type="text" dt-col="key" dt-col_ca="Clau">{{ $item->key }}</td>
                <td dt-type="checkbox" dt-col="deleted_at" dt-col_ca="Habilitada">@if($item->deleted_at == null) Sí @else No @endif</td>
                <td dt-type="datetime" dt-col="created_at" dt-col_ca="Creat el">{{ $item->created_at }}</td>
                <td dt-type="datetime" dt-col="updated_at" dt-col_ca="Actualitzat el">{{ $item->updated_at }}</td>
                <td dt-type="text" dt-col="created_by" dt-col_ca="Creat per">{{ $item->created_by }}</td>
                <td dt-type="text" dt-col="updated_by" dt-col_ca="Actualitzat per">{{ $item->updated_by }}</td>
                <td>
                    <button dt-tb="account" dt-id="{{ $item->id }}" class="btn btn-danger deletebtn"><i class="fas fa-trash"></i></button>
                    <button dt-id="{{ $item->id }}" class="btn btn-warning editbtn"><i class="fas fa-edit"></i></button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="edit_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Edita el registre</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <form>
        </form>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tancar</button>
        <button type="button" class="btn btn-primary">Guardar canvis</button>
    </div>
    </div>
</div>
</div>

@endsection

@push('scripts')

@include('admin.scripts.scripts');

@endpush
