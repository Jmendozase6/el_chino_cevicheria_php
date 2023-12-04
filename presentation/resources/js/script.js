$(document).ready(function () {
    $(".data-table").each(function (_, table) {
        $(table).DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json",
            },
        });
    });
});