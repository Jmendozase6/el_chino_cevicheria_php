<?php
?>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="../home_client/home_client_view.php">
      <img src="../../resources/images/logo.png" alt="Logo" width="30" height="24"
           class="d-inline-block align-text-top">
      Inicio
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="../sign_in/sign_in_view.php">Iniciar sesión</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../cart_client/cart_client_view.php">Carrito</a>
        </li>
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Buscar Producto" aria-label="Buscar Producto">
        <button class="btn btn-outline-success" type="submit">Buscar</button>
      </form>
    </div>
  </div>
</nav>