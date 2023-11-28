<?php
include '../landing/base_landing_view.php';
$content = '
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2 class="text-center mb-4">Libro de Reclamaciones</h2>
            <form action="complaint_book.php" enctype="multipart/form-data">
                <div class="form-group py-2">
                    <label for="nombre">Nombre:</label>
                    <input type="text" class="form-control" id="nombre" placeholder="Ingrese su nombre" required>
                </div>

                <div class="form-group py-2">
                    <label for="email">Correo Electrónico:</label>
                    <input type="email" class="form-control" id="email" placeholder="Ingrese su correo electrónico" required>
                </div>

                <div class="form-group py-2">
                    <label for="mensaje">Mensaje de Reclamación:</label>
                    <textarea class="form-control form-control-textarea" id="mensaje" rows="4" placeholder="Ingrese su reclamación" required></textarea>
                </div>

                <button type="submit" class="btn btn-primary btn-submit">Enviar Reclamación</button>
            </form>
        </div>
    </div>
</div>
';
displayBaseWeb($content);
?>
