<?php $title = "Inici" ?>
@extends('layouts.base')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/notifications/notifications.css') }}">
@endpush

@section('content')
<!-- ======= Main Section ======= -->
<div class="mainPagaments container">
    <h1 tabindex="3" id="titolPagament">Pagaments INS Camí de Mar</h1>
    <div id="pagaments">
        <div class="row">
            <div class="col-md-6">
                <label for="category" class="form-label">Sel·lecciona un curs</label>
                <select tabindex="4" class="custom-select my-1 mr-sm-2" id="category" aria-controls="payment">
                    <option selected disabled>Categoria...</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->category }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6" style="display: none;">
                <label for="payment" class="form-label">Sel·lecciona un pagament</label>
                <select tabindex="5" class="custom-select my-1 mr-sm-2" id="payment" aria-controls="payment_view">
                    <option selected disabled>Pagament...</option>
                </select>
            </div>
        </div>
    </div>
    <div id="payment_view" style="display: none;">
        <div class="row">
            <div class="col">
                <h2 tabindex="6" class="descripcionTitulo" id="title"></h2>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <pre tabindex="7" class="descriptionP" id="description"></pre>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <p class="import">Import:</p>
            </div>
            <div class="col">
                <p tabindex="8" class="preu" id="price"></p>
            </div>
            <div class="col">
                <button tabindex="9" class="login100-form-btn botonForm btn btn-primary" id="paybtn" style="width: 50%;height: 80px;">
                    Fer Pagament
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="modal" tabindex="-1" role="dialog" aria-labelledby="ModalLongTitle" aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="ModalLongTitle">Realitzar un pagament</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Tancar">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <form action="https://sis.sermepa.es/sis/realizarPago" method="post" accept-charset="utf-8" id="form_260">
    <div class="modal-body">

        <div class="row">
            <label for="name" class="col-lg-4 col-form-label">
                Nom i cognoms
            </label>
            <div class="col-lg-8">
                <input class="form-control" type="text" name="name" id="name" autocomplete="name" required/>
            </div>
        </div>

    </div>
    <div class="modal-footer">
        <div class="mr-auto">
            Vols compartir? <span class="socials"></span>
        </div>
            <input type="hidden" name="Ds_SignatureVersion" value=""/>
            <input type="hidden" name="Ds_MerchantParameters" value=""/>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tancar</button>
            <button type="submit" class="btn btn-success" id="save">Continuar</button>
    </div>
    </form>
    </div>
</div>
</div>

@endsection

@push('scripts')

<script>
    $('#category').on("change",function() {
        $('#payment_view').hide();
        $('#payment').closest("div").show();
        $('#payment').html("<option selected disabled>Pagament...</option>");
        var id = $(this).val();
        if(isNaN(id)) {
            errorNotf({
                title: 'Error!',
                message: 'ID categoria invàlid',
            });
        } else {
            $.ajax({
                type: 'POST',
                url: '{{ route("home.payments") }}',
                data: {
                    '_token': "{{ csrf_token() }}",
                    id: id,
                }, success: function(e) {
                    for(const payment of e) {
                        $('#payment').append(`<option value="${payment.id}">${payment.title}</option>`)
                    }
                }, error: function() {
                    errorNotf({
                        title: 'Error!',
                        message: 'No s\'ha pogut processar la petició',
                    });
                }
            })
        }
    })
</script>

<script>
    $('#payment').on("change",function() {
        var id = $(this).val();
        if(isNaN(id)) {
            errorNotf({
                title: 'Error!',
                message: 'ID categoria invàlid',
            })
        } else {
            $.ajax({
                type: 'POST',
                url: '{{ route("home.payment") }}',
                data: {
                    '_token': "{{ csrf_token() }}",
                    id: id,
                }, success: function(e) {
                    $('#payment_view').show();
                    $('#title').html(e[0].title);
                    $('#description').html(e[0].description);
                    $('#price').html(e[0].price+"€");
                }, error: function() {
                    errorNotf({
                        title: 'Error!',
                        message: 'No s\'ha pogut processar la petició',
                    });
                }
            })
        }
    })
</script>

<script>
$('#paybtn').click(function() {
    if($('#payment').val()) {
        var category = $(`#category option[value="${$('#category').val()}"]`).html();
        var title = $('#title').html();
        var price = $('#price').html();

        var content =
        `<a href="https://twitter.com/intent/tweet?text=Fent%20el%20pagament%20de%20${category}%20-%20${title}%20per%20${price}%20a&hashtags=inscamidemar&url=inscamidemar.cat" title="Compartir a Twitter" target="_blank">
            <i class="fab fa-twitter"></i>
        </a>
        <a href="https://api.whatsapp.com/send?text=Fent%20el%20pagament%20de%20${category}%20-%20${title}%20per%20${price}%20a%20inscamidemar.cat" title="Compartir a Whatsapp" target="_blank">
            <i class="fab fa-whatsapp"></i>
        </a>
        <a href="https://t.me/share/url?text=Fent%20el%20pagament%20de%20${category}%20-%20${title}%20per%20${price}&url=inscamidemar.cat" title="Compartir a telegram" target="_blank">
            <i class="fab fa-telegram"></i>
        </a>
        <a href="https://www.facebook.com/sharer/sharer.php?u=pagaments.inscamidemar.cat" class="fb-xfbml-parse-ignore" title="Compartir a telegram" target="_blank">
            <i class="fab fa-facebook"></i>
        </a>
        <a href="mailto:?subject=Pagament de ${category}&amp;body=Estic realitzant el pagament de ${category} - ${title} per ${price}€!" title="Compartir per correu" target="_blank"target="_blank">
            <i class="far fa-envelope"></i>
        </a>`;
        $('.modal-footer .socials').html(content);

        $('#modal').modal();
    } else {
        errorNotf({
            title: 'Error!',
            message: 'Has de sel·leccionar un pagament primer.',
        });
    }
})
</script>

@endpush