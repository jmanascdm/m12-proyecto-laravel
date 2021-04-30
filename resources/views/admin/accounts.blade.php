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
                <td dt-type="number" dt-col="id" dt-col_ca="Id">{{ $item->id }}</td>
                <td dt-type="number" dt-col="establishment" dt-col_ca="Establiment">{{ $item->establishment }}</td>
                <td dt-type="text" dt-col="account" dt-col_ca="Compte">{{ $item->account }}</td>
                <td dt-type="text" dt-col="fuc" dt-col_ca="Fuc">{{ $item->fuc }}</td>
                <td dt-type="text" dt-col="key" dt-col_ca="Clau">{{ $item->key }}</td>
                <td dt-type="datetime" dt-col="created_at" dt-col_ca="Creat el">{{ $item->created_at }}</td>
                <td dt-type="datetime" dt-col="updated_at" dt-col_ca="Actualitzat el">{{ $item->updated_at }}</td>
                <td dt-type="text" dt-col="created_by" dt-col_ca="Creat per">{{ $item->created_by }}</td>
                <td dt-type="text" dt-col="updated_by" dt-col_ca="Actualitzat per">{{ $item->updated_by }}</td>
                <td>
                    <button dt-id="{{ $item->id }}" class="btn btn-danger deletebtn"><i class="fas fa-trash"></i></button>
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
<!-- Notificacions -->
<script src="{{ asset('js/notifications/notifications.js') }}"></script>

<!-- Datatables -->
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.colVis.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
<script>
    $(document).ready(function () {
        $("tr:even").addClass("even");
        $('#tablaAutomatica').DataTable({
            lengthMenu: [5,10,25,50,100],
            responsive: true,
            language: {
                searchPlaceholder: 'Buscar',
                sSearch: '',
                "decimal": "",
                "emptyTable": "No hi han registres",
                "info": "Mostrant _START_ a _END_ de _TOTAL_ registres",
                "infoEmpty": "Mostrant 0 a 0 de 0 registres",
                "infoFiltered": "(Filtrat de _MAX_ total registres)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar resgistres _MENU_",
                "loadingRecords": "Carregant...",
                "processing": "Processant...",
                "search": "Buscar:",
                "zeroRecords": "No s'han trobat resultats",
                "paginate": {
                    "first": "Primer",
                    "last": "Últim",
                    "next": "Següent",
                    "previous": "Anterior"
                }
            },
            dom: 'Bflrtrip',
            buttons: [{
                            extend: 'excelHtml5',
                            text: '<i class="far fa-file-excel"></i>',
                            exportOptions: {
                                columns: ':visible'
                            }
                        },
                        {
                            extend: 'pdfHtml5',
                            text: '<i class="far fa-file-pdf"></i>',
                            exportOptions: {
                                columns: ':visible'
                            }
                        }
                        ,
                {
                    extend: 'colvis',
                    className: 'btn-outline-secondary',
                    text: 'Filtrar per columna'
                },
            ]
        });
    });
</script>

<!-- Editar camps -->
<script src="https://cdn.tiny.cloud/1/21wmjgvo3uldi678zp5poa3pc2pn0n8cu7rw8iwmp8c3r3n9/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    $('.editbtn').click(function() {
        var $form = $('#edit_modal .modal-body form');
        $form.html("");

        var id = $(this).attr("dt-id");
        var col,col_ca,type,content,value;
        $(`#${id}`).find("td").each(function(index,element) {
            col = $(element).attr("dt-col");
            if(col != "id" && col != "created_at" && col != "updated_at" && col != "created_by" && col != "updated_by") {
                col_ca = $(element).attr("dt-col_ca");
                type = $(element).attr("dt-type");
                value = $(element).html();

                content = `<div class="form-group row">
                            <label for="${col}" class="col-sm-4 col-form-label">${col_ca}</label>
                            <div class="col-sm-8">
                            <input type="${type}" class="form-control" id="${col}" name="${col}" value="${value}">
                            </div>
                            </div>`;

                $form.append(content);
                if(type == "checkbox") if(value == " Sí ")
                    $form.find("input").last().attr("checked","true");
            }
        });
        $form.find("div.form-group:last-child").remove();
        $('#edit_modal').modal();
        tinymce.init({
            selector: 'textarea',
            plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
            toolbar_mode: 'floating',
        });
    })
</script>

<!-- Eliminar registres -->
<script>
    $('.deletebtn').click(function() {
        const successNotf = window.createNotification({
            theme: 'success',
            showDuration: 3000
        });

        const errorNotf = window.createNotification({
            theme: 'error',
            showDuration: 3000
        });
        
        if(confirm("Estas segur que vols eliminar el registre?")) {
            var id = $(this).attr('dt-id');
            if(isNaN(id)) console.log("ID invàlid: "+id);
            else {
                $.ajax({
                    type: 'post',
                    url: '/',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id": id,
                    },
                    success: function(e) {
                        $('#'+e).remove();
                        successNotf({
                            title: 'Fet!',
                            message: 'Registre eliminat correctament',
                        });
                    }, error: function() {
                        errorNotf({
                            title: 'Error!',
                            message: 'No s\'ha pogut eliminar el registre',
                        });
                    }
                })
            }
        }
    })
</script>

@endpush
