@extends('layouts.base')

@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="{{ asset('css/notifications/notifications.css') }}">
<style type="text/css">
    #tablaAutomatica_wrapper {
        text-align: center;
    }

    #tablaAutomatica_filter {
        text-align: center;
        padding-right: 20%;
    }

    #tablaAutomatica_filter.label.input {
        width: 100%;
    }

    #tablaAutomatica_info {
        padding-left: 30%;
    }

    #tablaAutomatica_paginate {
        padding-right: 30%;
    }

    div.dt-buttons {
        text-align: center;
    }

    main span {
        padding-right: 100px;

    }

    main span:hover {
        background-color: none;
        color: orange;
    }

    img {
        max-width: 87px;
        max-height: 87px;
    }

    .btn {
        border: none;
        padding: 18px 58px 18px 19px;
        text-transform: capitalize;
        border-radius: 6px;
        cursor: pointer;
        color: #fff;
        display: inline-block;
        font-size: 16px;
        background-size: 10%;
        transition: 0.6s;
        box-shadow: 0px 7px 21px 0px rgba(0, 0, 0, 0.12);
        background-color: #00A19B;
    }

    body {
        background-color: azure;
        font-size: 1em;
        font-family: sans-serif;
    }

    h1 {
        text-align: center;
        color: cadetblue;
        padding: 4%;
    }

    p {
        text-align: center;
    }

    form {
        width: 60%;
        padding: 2%;
        margin: 10px auto;
    }

    fieldset {
        background-color: #FFF;
    }

    label,
    input {
        display: block;
        width: 48%;
        height: 30px;
        padding: 1%;
        margin-bottom: 10px;
    }

    label {
        float: left;
    }

    input {
        float: right;
        border: none;
        box-shadow: 0 0 3px #AAA;
    }

    input[type="submit"] {
        width: 98%;
        padding-bottom: 3%;
        background-color: #00A19B;
        color: #FFF;
    }

    input[type="submit"]:hover {
        background-color: orange;
    }

    table {
        width: 50%;
        padding: 1%;
        margin: 10px auto;
    }

    td {
        box-shadow: 0 0 3px #CCC;
        background-color: #FFF;
    }

    th {
        text-align: left;
        background-color: #333;
        color: #FFF;
    }

    .dataTables_wrapper .dataTables_filter input {
        padding: initial;
        width: 100%;
    }

</style>
@endpush

@section('content')

<!-- <h1>Afegir Compte</h1>
<form method="post" enctype="multipart/form-data" action="tablaComptes">
    <label for="id">Id</label>
    <input type="text" name="id" required><br><br>
    <label for="establiment">Establiment</label>
    <input type="text" name="establiment" required><br><br>
    <label for="compte">Compte</label>
    <input type="text" name="compte" required><br><br>
    <label for="fuc">Fuc</label>
    <input type="text" name="fuc" required><br><br>
    <label for="clau">Clau</label>
    <input type="text" name="clau" required><br><br><br>

    <input type=submit value="Enviar" name="subir"><br>
</form> -->

<div style="padding-top: 4%; padding-bottom: 4%;">
    <table id="tablaAutomatica" style="text-align: center; width: 70%;">
        <thead>
            <tr>
                <th>id</th>
                <th>establiment</th>
                <th>compte</th>
                <th>fuc</th>
                <th>clau</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
            @foreach($result as $item)
            <tr id="<?= $item->id ?>">
                <td><?= $item->id ?></td>
                <td><?= $item->establishment ?></td>
                <td><?= $item->account ?></td>
                <td><?= $item->fuc ?></td>
                <td><?= $item->key ?></td>
                <td>
                    <form>
                        <button dt-id="{{ $item->id }}" class="deletebtn"><i class="fas fa-trash"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <script>
        $('.deletebtn').click(function(e) {
            e.preventDefault();

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
                        url: '/datatable/delete',
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
</div>

@push('scripts')
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.colVis.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
<script src="{{ asset('js/notifications/notifications.js') }}"></script>
@endpush

<script>
    $(document).ready(function () {
        $('#tablaAutomatica').DataTable({
            lengthMenu: [5,10,25,50,100],
            responsive: true,
            language: {
                searchPlaceholder: 'Buscar...',
                sSearch: '',
                "decimal": "",
                "emptyTable": "No hi han registres",
                "info": "Mostrant _START_ a _END_ de _TOTAL_ registres",
                "infoEmpty": "Mostrant 0 a 0 de 0 registres",
                "infoFiltered": "(Filtrat de _MAX_ total registres)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ resgistres",
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
            dom: 'Blfrtrip',
            buttons: [{
                    extend: 'collection',
                    text: 'Descarregar',
                    className: 'btn-outline-secondary',
                    buttons: [{
                            extend: 'excelHtml5',
                            className: 'btn-outline-secondary',
                            exportOptions: {
                                columns: ':visible'
                            }
                        },
                        {
                            extend: 'pdfHtml5',
                            className: 'btn-outline-secondary',
                            exportOptions: {
                                columns: ':visible'
                            }
                        }
                    ]
                },
                {
                    extend: 'colvis',
                    className: 'btn-outline-secondary',
                    text: 'Filtrar per columna'
                },
            ]
        });
    });
</script>

@endsection
