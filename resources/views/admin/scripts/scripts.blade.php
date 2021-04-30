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
        buttons: [
            {
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
            },
            {
                extend: 'colvis',
                className: 'btn-outline-secondary',
                text: 'Filtrar per columna'
            }
        ]
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
            if(col != "id" && col != "created_at" && col != "updated_at" && col != "created_by" && col != "updated_by" && col != "deleted_at") {
                col_ca = $(element).attr("dt-col_ca");
                type = $(element).attr("dt-type");
                value = $(element).html();

                if(type == "textarea")
                    content = `<div class="form-group row">
                                <label for="${col}" class="col-sm-4 col-form-label">${col_ca}</label>
                                <div class="col-sm-8">
                                <textarea class="form-control" id="${col}" name="${col}">${value}</textarea>
                                </div>
                                </div>`;
                else
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
            var table = $(this).attr('dt-tb');
            if(isNaN(id)) {
                console.log("ID invàlid: "+id);
                errorNotf({
                    title: 'Error!',
                    message: 'El ID proporcionat no és vàlid',
                });
            }
            else {
                $.ajax({
                    type: 'post',
                    url: `/${table}/delete`,
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id": id,
                    },
                    success: function(e) {
                        $(`#${e}`).remove();
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