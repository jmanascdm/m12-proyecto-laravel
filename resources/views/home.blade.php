@extends('layouts.base')

@section('content')
<!-- ======= Main Section ======= -->
<div class="mainPagaments container">
    <h1 id="titolPagament">Pàgina de Pagaments</h1>
    <form id="pagaments">
        <div class="row">
            <div class="col">
                <label for="category" class="form-label">Selecciona el Curs</label>
                <select class="custom-select my-1 mr-sm-2" id="category">
                    <option selected disabled>Sel·lecciona una categoria</option>
                </select>
            </div>
            <div class="col">
                <label for="payment" class="form-label">Opció de pagament</label>
                <select class="custom-select my-1 mr-sm-2" id="payment">
                    <option selected disabled>Sel·lecciona un pagament</option>
                </select>
            </div>
        </div>
    </form>
    <div class="row">
        <div class="col">
            <h2 class="descripcionTitulo">Descripció:</h2>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <p class="descriptionP">Aqui se muestra la Descripción:</p>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <p class="import">Import:</p>
        </div>
        <div class="col">
            <p class="preu">100€</p>
        </div>
        <div class="col">
            <button class="login100-form-btn botonForm" style="width: 50%;height: 80px;">
                Fer Pagament
            </button>
        </div>
    </div>
</div>

@endsection
