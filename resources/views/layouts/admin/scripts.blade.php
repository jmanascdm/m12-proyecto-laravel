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
                orientation: 'landscape',
                pageSize: 'LEGAL',
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

<!-- Editor textarea -->
<script src="https://cdn.tiny.cloud/1/21wmjgvo3uldi678zp5poa3pc2pn0n8cu7rw8iwmp8c3r3n9/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

<!-- Eliminar registres -->
<script>
    /**
     * Al presionar el boton para eliminar un registro aparecerá un mensaje de confirmacion. Si continuamos con la eliminacion
     *  se recogen el ID y la tabla del registro a eliminar des de los atributos del boton 'data-id' y 'data-table' respectivamente.
     * Si los datos son correctos, estas variables se utilizan para enviar la petición al servidor y eliminar el registro.
     * En cualquier caso, se notifica visualmente al usuario del estado de la peticion, y en caso de ejecutarse correctamente,
     *  se elimina el registro de la tabla al momento.
     */
    function deletebtn() {
        if(confirm("Estas segur que vols eliminar el registre?")) {
            var id = $(this).attr('data-id');
            var table = $(this).attr('data-tb');
            if(isNaN(id)) {
                errorNotf({
                    title: 'Error!',
                    message: `El ID proporcionat (${id}) no és vàlid`,
                });
            } else {
                $.ajax({
                    type: 'POST',
                    url: `/${table}/delete`,
                    data: {
                        '_token': "{{ csrf_token() }}",
                        'id': id,
                    }, beforeSend: function() {
                        infoNotf({
                            title: 'Processant...',
                            message: 'S\'està processant la petició',
                        });
                    }, success: function() {
                        $(`#${id}`).remove();
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
    }
    $('.deletebtn').click(deletebtn);
</script>

<!-- Editar camps -->
<script>
    /**
     * Al presionar el boton de modal (editar/añadir) se recogen el ID, la tabla y el boobleano de habilitado del registro
     *  des de los atributos del boton 'data-id', 'data-table' y 'data-enabled' respectivamente.
     * 
     * Antes de mostrar el modal se elimina el contenido de los inputs/textarea y se comprieba si existe la variable ID.
     * Si la variable no existe, significa que se esta añadiendo un registro, por lo que los campos aparecerán vacios.
     * Si existe, se rellenan los campos a partir de los datos en el HTML:
     *  Por cada input en el modal, se recoge el valor HTML de la columna con el atributo 'data-col' que tenga el mismo valor
     *  que el ID del input del modal de cada iteracion, y se le asigna el valor usando el atributo 'value'.
     * 
     * Tambien se comprueba si el campo esta habilitado o no, y se muetra el boton correspondiente para realizar la accion
     *  contraria.
     */
    function modalbtn() {
        var id = $(this).attr("data-id");
        var enabled = $(this).attr("data-enabled");
        var table = $(this).attr("data-tb");

        // Para la tabla de pagos, al editar un pago se recoge el ID de la categoria/cuenta asociadas para preseleccionarlas
        var category = $(`tr#${id} td[data-category]`).attr('data-category');
        var account = $(`tr#${id} td[data-account]`).attr('data-account');

        tinymce.remove();
        $('#modal input.form-control').attr('value',"");
        $('#modal textarea.form-control').html("");
        $('#modal .modal-footer div').first().html("");

        if(!isNaN(id)) {
            $('#modal #id').attr('value',id);
            $('#modal input.form-control').each(function(index,element) {
                if($(element)[0].type == "checkbox" && $(`#${id} td[data-col="${$(element).attr('id')}"]`).html() == "Sí") {
                    $(element).attr('checked','true');
                }
                $(element).attr('value', $(`#${id} td[data-col="${$(element).attr('id')}"]`).html() )
            });
            
            $('#modal textarea.form-control').each(function(index,element) {
               $(element).html( $(`#${id} td[data-col="${$(element).attr('id')}"]`).html() );
            });

            if(category) {
                $(`#modal select#id_category option[value=${category}]`).attr('selected',true);
            }
            if(account) {
                $(`#modal select#id_account option[value=${account}]`).attr('selected',true);
            }

            if(enabled){
                $('#modal .modal-footer div').first().html(`<button type="button" data-id="${id}" data-tb="${table}" class="btn btn-warning" onclick="disable($(this));">Deshabilitar</button>`);
            } else {
                $('#modal .modal-footer div').first().html(`<button type="button" data-id="${id}" data-tb="${table}" class="btn btn-success" onclick="enable($(this));">Habilitar</button>`);
            }
        }

        tinymce.init({
            selector: 'textarea',
        });

        $('#modal').modal();
    }
    /**
     * Cada vez que se modifica la tabla (por ejemplo, al filtrar las columnas) se vuelve a aplicar el evento clic a los botones editar y borrar
     */
    $('.modalbtn').click(modalbtn);
    $('*[aria-controls="tablaAutomatica"]').click(function() {
        $('.modalbtn').click(modalbtn);
        $('.deletebtn').click(deletebtn);
    });
</script>

<!-- Deshabilitar camps -->
<script>
    /**
     * Al presionar el boton de deshabilitar se recogen el ID y la tabla del registro a eliminar des de los atributos del boton
     *  'data-id' y 'data-table' respectivamente. En cualquier caso, se notifica visualmente al usuario del estado de la peticion.
     */
    function disable(element) {
        var id = element.attr('data-id');
        var table = element.attr('data-tb');
        if(isNaN(id)) {
            errorNotf({
                title: 'Error!',
                message: `El ID proporcionat (${id}) no és vàlid`,
            });
        } else {
            $.ajax({
                type: 'POST',
                url: `/${table}/disable`,
                data: {
                    '_token': "{{ csrf_token() }}",
                    'id': id,
                }, beforeSend: function() {
                    infoNotf({
                        title: 'Processant...',
                        message: 'S\'està processant la petició',
                    });
                }, success: function() {
                    successNotf({
                        title: 'Fet!',
                        message: 'Registre deshabilitat correctament',
                    });
                    location.reload();
                }, error: function() {
                    errorNotf({
                        title: 'Error!',
                        message: 'No s\'ha pogut deshabilitar el registre',
                    });
                }
            })
        }
    }
</script>

<!-- Habilitar camps -->
<script>
    function enable(element) {
        var id = element.attr('data-id');
        var table = element.attr('data-tb');
        if(isNaN(id)) {
            errorNotf({
                title: 'Error!',
                message: `El ID proporcionat (${id}) no és vàlid`,
            });
        } else {
            $.ajax({
                type: 'POST',
                url: `/${table}/enable`,
                data: {
                    '_token': "{{ csrf_token() }}",
                    'id': id,
                }, beforeSend: function() {
                    infoNotf({
                        title: 'Processant...',
                        message: 'S\'està processant la petició',
                    });
                }, success: function() {
                    successNotf({
                        title: 'Fet!',
                        message: 'Registre habilitat correctament',
                    });
                    location.reload();
                }, error: function() {
                    errorNotf({
                        title: 'Error!',
                        message: 'No s\'ha pogut habilitar el registre',
                    });
                }
            })
        }
    }
</script>