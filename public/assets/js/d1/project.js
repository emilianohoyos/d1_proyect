var handleRenderTableData = function () {
    var table = $('#table-default').DataTable({
        lengthMenu: [10, 20, 30, 40, 50],
        responsive: true,
        buttons: [
            { extend: 'print', className: 'btn btn-default btn-sm' },
            { extend: 'csv', className: 'btn btn-default btn-sm' }
        ]
    });
};


/* Controller
------------------------------------------------ */
$(document).ready(function () {
    handleRenderTableData();
});