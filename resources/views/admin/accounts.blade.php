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
