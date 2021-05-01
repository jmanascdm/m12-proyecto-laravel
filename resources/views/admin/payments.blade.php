@extends('layouts.base')

@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="{{ asset('css/notifications/notifications.css') }}">
@endpush

@section('content')

<div>
    <h1>Pagaments</h1>
    <table id="tablaAutomatica" class="col-md-6">
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
                <td dt-col="category">{{ $item->id_category }}</td>
                <td dt-col="account">{{ $item->id_account }}</td>
                <td dt-col="level">{{ $item->level }}</td>
                <td dt-col="order">{{ $item->order }}</td>
                <td dt-col="title">{{ $item->title }}</td>
                <td dt-col="description">{{ $item->description }}</td>
                <td dt-col="price">{{ $item->price }}</td>
                <td dt-col="start_date">{{ $item->start_date }}</td>
                <td dt-col="end_date">{{ $item->end_date }}</td>
                <td dt-col="created_at">{{ $item->created_at }}</td>
                <td dt-col="updated_at">{{ $item->updated_at }}</td>
                <td dt-col="created_by">{{ $item->created_by }}</td>
                <td dt-col="updated_by">{{ $item->updated_by }}</td>
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
<div class="modal fade bd-example-modal-lg" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
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
            <div class="form-group row">
                <label for="category" class="col-sm-4 col-form-label">Categoria</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="category" name="category"/>
                </div>
            </div>
            <div class="form-group row">
                <label for="account" class="col-sm-4 col-form-label">Compte</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="account" name="account"/>
                </div>
            </div>
            <div class="form-group row">
                <label for="level" class="col-sm-4 col-form-label">Nivell</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="level" name="level"/>
                </div>
            </div>
            <div class="form-group row">
                <label for="order" class="col-sm-4 col-form-label">Comanda</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="order" name="order"/>
                </div>
            </div>
            <div class="form-group row">
                <label for="title" class="col-sm-4 col-form-label">Títol</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="title" name="title"/>
                </div>
            </div>
            <div class="form-group row">
                <label for="description" class="col-sm-4 col-form-label">Descripció</label>
                <div class="col-sm-8">
                    <textarea class="form-control" id="description" name="description"></textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="price" class="col-sm-4 col-form-label">Preu</label>
                <div class="col-sm-8">
                    <input type="number" class="form-control" id="price" name="price"/>
                </div>
            </div>
            <div class="form-group row">
                <label for="start_date" class="col-sm-4 col-form-label">Data inici</label>
                <div class="col-sm-8">
                    <input type="date" class="form-control" id="start_date" name="start_date"/>
                </div>
            </div>
            <div class="form-group row">
                <label for="end_date" class="col-sm-4 col-form-label">Data final</label>
                <div class="col-sm-8">
                    <input type="date" class="form-control" id="end_date" name="end_date"/>
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

@include('admin.scripts.scripts')

@endpush
