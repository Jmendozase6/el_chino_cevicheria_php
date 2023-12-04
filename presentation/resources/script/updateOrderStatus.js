$(document).ready(function () {
    // Manejador del evento change para el select
    $('#orderStatusSelect').change(function () {
        // Obtén el valor seleccionado
        const selectedOrderStatus = $(this).val();
        const orderId = getOrderId();

        // Realiza una solicitud AJAX al servidor para ejecutar el script PHP
        $.ajax({
            type: 'POST', // O 'GET' según tus necesidades
            url: '../../views/orders/updateOrderStatus.php', // Ruta al script PHP
            data: {orderId: orderId, selectedOrderStatus: selectedOrderStatus}, success: function (response) {
                // Maneja la respuesta del servidor si es necesario
                console.log(response);
            }, error: function (error) {
                // Maneja el error si ocurre
                console.error(error);
            }
        });
    });

    function getOrderId() {
        return $('#orderIdInput').val();
    }
});
