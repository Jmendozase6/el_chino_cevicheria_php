setTimeout(function () {
    $(".display-on-error").css("display", "none");
    $(".display-on-success").css("display", "none");
    $(".display-on-error-complaints").css("display", "none");
    $(".display-on-success-complaints").css("display", "none");

    // Hacer una solicitud AJAX para borrar variables de sesión
    $.ajax({
        url: "../../views/contact_us/delete_session_messages.php", type: "POST",
        success: function () {
            console.log('Yes'); // Puedes manejar la respuesta del servidor aquí
        },
        failure: function () {
            console.log('No'); // Puedes manejar la respuesta del servidor aquí
        }
    });
}, 3600);
