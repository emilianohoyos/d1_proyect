var handleRenderTableData = function () {
    try {
        var table = $('#table-default').DataTable({
            lengthMenu: [10, 20, 30, 40, 50],
            responsive: true,
            buttons: [
                { extend: 'print', className: 'btn btn-default btn-sm', text: 'Imprimir' },
                { extend: 'csv', className: 'btn btn-default btn-sm', text: 'Exportar CSV' }
            ],
            language: {
                "decimal": "",
                "emptyTable": "No hay datos disponibles",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
                "infoEmpty": "Mostrando 0 a 0 de 0 registros",
                "infoFiltered": "(filtrado de _MAX_ registros totales)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ registros",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscar:",
                "zeroRecords": "No se encontraron registros coincidentes",
                "paginate": {
                    "first": "Primero",
                    "last": "Último",
                    "next": "Siguiente",
                    "previous": "Anterior"
                },
                "aria": {
                    "sortAscending": ": activar para ordenar columna ascendente",
                    "sortDescending": ": activar para ordenar columna descendente"
                }
            },
            drawCallback: function (settings) {
                // Verificar si no hay datos
                if (settings._iRecordsTotal === 0) {
                    // Ocultar los botones de exportación
                    $('.dt-buttons').hide();
                    // Ocultar el selector de registros por página
                    $('.dataTables_length').hide();
                } else {
                    // Mostrar los botones y el selector si hay datos
                    $('.dt-buttons').show();
                    $('.dataTables_length').show();
                }
            },
            initComplete: function (settings, json) {
                // Verificar si la tabla está vacía
                if (this.api().data().length === 0) {
                    // Ocultar elementos innecesarios
                    $('.dt-buttons').hide();
                    $('.dataTables_length').hide();
                    $('.dataTables_filter').hide();
                }
            }
        });

        // Manejar errores de inicialización
        table.on('error.dt', function (e, settings, techNote, message) {
            console.error('Error en DataTable:', message);
            // Mostrar mensaje de error al usuario
            $('#table-default').html('<div class="alert alert-warning">No se pudieron cargar los datos. Por favor, intente nuevamente.</div>');
        });

    } catch (error) {
        console.error('Error al inicializar DataTable:', error);
        // Mostrar mensaje de error al usuario
        $('#table-default').html('<div class="alert alert-warning">No se pudieron cargar los datos. Por favor, intente nuevamente.</div>');
    }
};


/* Controller
------------------------------------------------ */
$(document).ready(function () {
    // Verificar si la tabla existe antes de inicializarla
    if ($('#table-default').length) {
        handleRenderTableData();
    }
});