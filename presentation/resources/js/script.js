$(document).ready(function () {
    $(".data-table").each(function (_, table) {
        $(table).DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json",
            }, dom: 'Bfrtilp', buttons: [{
                extend: 'excelHtml5',
                text: '<i class="fas fa-file-excel"></i> ',
                titleAttr: 'Exportar a Excel',
                className: 'btn btn-success',
            }, {
                extend: 'pdfHtml5',
                text: '<i class="fas fa-file-pdf"></i> ',
                titleAttr: 'Exportar a PDF',
                className: 'btn btn-danger',
            }, {
                extend: 'print', text: '<i class="fa fa-print"></i> ', titleAttr: 'Imprimir', className: 'btn btn-info',
            },]
        });
    });
});