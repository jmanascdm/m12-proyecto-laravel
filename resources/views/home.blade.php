<?php $title = "Inici" ?>
@extends('layouts.base')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/notifications/notifications.css') }}">
@endpush

@section('content')
<!-- ======= Main Section ======= -->
<div class="mainPagaments container">
    <h1 id="titolPagament">Pagaments INS Camí de Mar</h1>
    <form id="pagaments">
        <div class="row">
            <div class="col-md-6">
                <label for="category" class="form-label">Sel·lecciona una categoria</label>
                <select class="custom-select my-1 mr-sm-2" id="category">
                    <option selected disabled>Sel·lecciona una categoria</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->category }}</option>
                    @endforeach
                </select>
                <script>
                    $('#category').on("change",function() {
                        $('#payment_view').hide();
                        $('#payment').html("<option selected disabled>Sel·lecciona un pagament</option>");
                        var id = $(this).val();
                        const errorNotf = window.createNotification({
                            theme: 'error',
                            showDuration: 3000
                        });
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
            </div>
            <div class="col-md-6">
                <label for="payment" class="form-label">Sel·lecciona un pagament</label>
                <select class="custom-select my-1 mr-sm-2" id="payment">
                    <option selected disabled>Sel·lecciona un pagament</option>
                </select>
                <script>
                    $('#payment').on("change",function() {
                        var id = $(this).val();
                        const errorNotf = window.createNotification({
                            theme: 'error',
                            showDuration: 3000
                        })

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
            </div>
        </div>
    </form>
    <div id="payment_view" style="display: none;">
        <div class="row">
            <div class="col">
                <h2 class="descripcionTitulo" id="title"></h2>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <pre class="descriptionP" id="description"></pre>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <p class="import">Import:</p>
            </div>
            <div class="col">
                <p class="preu" id="price"></p>
            </div>
            <div class="col">
                <button class="login100-form-btn botonForm btn btn-primary" id="paybtn" style="width: 50%;height: 80px;">
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
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        Vols compartir?
        <div class="socials"></div>
    </div>
    <div class="modal-footer">
        <form action="https://sis.sermepa.es/sis/realizarPago" method="post" accept-charset="utf-8" id="form_260">
            <input type="hidden" name="Ds_SignatureVersion" value=""/>
            <input type="hidden" name="Ds_MerchantParameters" value=""/>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tancar</button>
            <button type="submit" class="btn btn-success" id="save">Continuar</button>
        </form>
    </div>
    </div>
</div>
</div>


@endsection

@push('scripts')

<script src="{{ asset('js/notifications/notifications.js') }}"></script>
<script>
const successNotf = window.createNotification({
    theme: 'success',
    showDuration: 5000
});

const errorNotf = window.createNotification({
    theme: 'error',
    showDuration: 5000
});

const infoNotf = window.createNotification({
    theme: 'info',
    showDuration: 5000
});
</script>
<script>
$('#paybtn').click(function() {
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
	$('.modal-body .socials').html(content);

	$('#modal').modal();
})
</script>

@endpush