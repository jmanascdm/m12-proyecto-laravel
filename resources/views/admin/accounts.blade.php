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
                <th>clau</th>
                <th>Accions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
            <tr>
                <td dt-id="{{ $item->id }}" dt-col="id"><?= $item->id ?></td>
                <td dt-id="{{ $item->id }}" dt-col="establishment"><?= $item->establishment ?></td>
                <td dt-id="{{ $item->id }}" dt-col="account"><?= $item->account ?></td>
                <td dt-id="{{ $item->id }}" dt-col="fuc"><?= $item->fuc ?></td>
                <td dt-id="{{ $item->id }}" dt-col="key"><?= $item->key ?></td>
                <td>
                    <button dt-id="{{ $item->id }}" class="deletebtn"><i class="fas fa-trash"></i></button>
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
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <textarea id="editfield">
        </textarea>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="submit" class="btn btn-primary">Save changes</button>
    </div>
    </div>
</div>
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
<!-- Datatable -->
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

<!-- Editar campos -->
<script src="https://cdn.tiny.cloud/1/21wmjgvo3uldi678zp5poa3pc2pn0n8cu7rw8iwmp8c3r3n9/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
tinymce.init({
    selector: 'textarea',
    plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
    toolbar_mode: 'floating',
});
</script>
<script>
    var textarea;
    var column;
    var $td;
    var id;

    $('td').dblclick(function() {
        $('#exampleModalCenter').modal();
        tinyMCE.activeEditor.setContent($(this).html());
        column = $(this).attr("dt-col");
        id = $(this).attr("dt-id");
        $td = $(this);
    });

    $('#submit').click(function() {
        textarea = tinyMCE.activeEditor.getContent();
        $.ajax({
            type: 'POST',
            url: '{{ route("account.edit") }}',
            data: {
                '_token': "{{ csrf_token() }}",
                'id': id,
                'column': column,
                'value': textarea,
            }, success: function() {
                $td.html(textarea)
                alert("success");
            }, error: function() {
                alert("error");
            }
        })
    })
</script>

@endpush

@endsection
