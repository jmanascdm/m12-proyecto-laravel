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
                <td dt-col="establishment">{{ $item->establishment }}</td>
                <td dt-col="account">{{ $item->account }}</td>
                <td dt-col="fuc">{{ $item->fuc }}</td>
                <td dt-col="key">{{ $item->key }}</td>
                <td dt-col="created_at">{{ $item->created_at }}</td>
                <td dt-col="updated_at">{{ $item->updated_at }}</td>
                <td dt-col="created_by" >{{ $item->created_by }}</td>
                <td dt-col="updated_by">{{ $item->updated_by }}</td>
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
<div class="modal fade bd-example-modal-lg" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Edita el compte</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <form>
            <div class="form-group row">
                <label for="establishment" class="col-sm-4 col-form-label">Establiment</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="establishment" name="establishment"/>
                </div>
            </div>
            <div class="form-group row">
                <label for="account" class="col-sm-4 col-form-label">Compte</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="account" name="account"/>
                </div>
            </div>
            <div class="form-group row">
                <label for="fuc" class="col-sm-4 col-form-label">Fuc</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="fuc" name="fuc"/>
                </div>
            </div>
            <div class="form-group row">
                <label for="key" class="col-sm-4 col-form-label">Clau</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="key" name="key"/>
                </div>
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tancar</button>
        <button type="button" class="btn btn-success">Guardar canvis</button>
    </div>
    </div>
</div>
</div>

@endsection

@push('scripts')

@include('admin.scripts.scripts');

@endpush
