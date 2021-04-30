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
                <td dt-type="text" dt-col="id_category" dt-col_ca="Categoria">{{ $item->id_category }}</td>
                <td dt-type="text" dt-col="id_account" dt-col_ca="Compte">{{ $item->id_account }}</td>
                <td dt-type="text" dt-col="level" dt-col_ca="Nivell">{{ $item->level }}</td>
                <td dt-type="text" dt-col="order" dt-col_ca="Comanda">{{ $item->order }}</td>
                <td dt-type="text" dt-col="title" dt-col_ca="Títol">{{ $item->title }}</td>
                <td dt-type="textarea" dt-col="description" dt-col_ca="Descripció">{{ $item->description }}</td>
                <td dt-type="number" dt-col="price" dt-col_ca="Preu">{{ $item->price }}</td>
                <td dt-type="date" dt-col="start_date" dt-col_ca="Data inici">{{ $item->start_date }}</td>
                <td dt-type="date" dt-col="end_date" dt-col_ca="Data final">{{ $item->end_date }}</td>
                <td dt-type="checkbox" dt-col="deleted_at" dt-col_ca="Habilitat">@if($item->deleted_at == null) Sí @else No @endif</td>
                <td dt-type="datetime" dt-col="created_at" dt-col_ca="Creat el">{{ $item->created_at }}</td>
                <td dt-type="datetime" dt-col="updated_at" dt-col_ca="Actualitzat el">{{ $item->updated_at }}</td>
                <td dt-type="text" dt-col="created_by" dt-col_ca="Creat per">{{ $item->created_by }}</td>
                <td dt-type="text" dt-col="updated_by" dt-col_ca="Actualitzat per">{{ $item->updated_by }}</td>
                <td>
                    <button dt-tb="payment" dt-id="{{ $item->id }}" class="btn btn-danger deletebtn"><i class="fas fa-trash"></i></button>
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
