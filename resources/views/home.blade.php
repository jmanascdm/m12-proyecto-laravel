@extends('layouts.base')

@section('content')
<!-- ======= Main Section ======= -->
<div class="mainPagaments container">
    <h1 id="titolPagament">Pàgina de Pagaments</h1>
    <form id="pagaments">
        <div class="row">
            <div class="col-md-6">
                <label for="category" class="form-label">Sel·lecciona la categoria</label>
                <select class="custom-select my-1 mr-sm-2" id="category">
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->category }}</option>
                    @endforeach
                    <option selected disabled>Sel·lecciona una categoria</option>
                </select>
                <script>
                    $('#category').on("change",function() {
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
                                        $('#payment').prepend(`<option value="${payment.id}">${payment.title}</option>`)
                                    }
                                }, error: function() {
                                    alert("error")
                                }
                            })
                        }
                    })
                </script>
            </div>
            <div class="col-md-6">
                <label for="payment" class="form-label">Opció de pagament</label>
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
                                    alert("error")
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
                <button class="login100-form-btn botonForm" style="width: 50%;height: 80px;">
                    Fer Pagament
                </button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')

<script src="{{ asset('js/notifications/notifications.js') }}"></script>

@endpush