<?php
?>
<div class="side-menu bg-white vh-100">
  <img class="mx-auto d-flex justify-content-center" src="../../resources/images/logo.png" alt="logo"/>
  <section class="d-flex ps-8 gap-4 py-3 justify-content-start align-items-center btn-start">
    <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 48 48"
         class="text-lg" height="1em" width="1em"
         xmlns="http://www.w3.org/2000/svg">
      <polygon fill="#E8EAF6" points="42,39 6,39 6,23 24,6 42,23"></polygon>
      <g fill="#C5CAE9">
        <polygon points="39,21 34,16 34,9 39,9"></polygon>
        <rect x="6" y="39" width="36" height="5"></rect>
      </g>
      <polygon fill="#B71C1C" points="24,4.3 4,22.9 6,25.1 24,8.4 42,25.1 44,22.9"></polygon>
      <rect x="18" y="28" fill="#D84315" width="12" height="16"></rect>
      <rect x="21" y="17" fill="#01579B" width="6" height="6"></rect>
      <path fill="#FF8A65"
            d="M27.5,35.5c-0.3,0-0.5,0.2-0.5,0.5v2c0,0.3,0.2,0.5,0.5,0.5S28,38.3,28,38v-2C28,35.7,27.8,35.5,27.5,35.5z"></path>
    </svg>
      <a class="text-decoration-none text-black" href="#"><p>Inicio</p></a>
  </section>
  <section class="d-flex ps-8 gap-4 py-3 justify-content-start align-items-center btn-start" href="side_bar_current_section.php?section=pedidos">
    <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 48 48"
         class="text-lg" height="1em" width="1em"
         xmlns="http://www.w3.org/2000/svg">
      <g fill="#3F51B5">
        <polygon points="17.8,18.1 10.4,25.4 6.2,21.3 4,23.5 10.4,29.9 20,20.3"></polygon>
        <polygon points="17.8,5.1 10.4,12.4 6.2,8.3 4,10.5 10.4,16.9 20,7.3"></polygon>
        <polygon points="17.8,31.1 10.4,38.4 6.2,34.3 4,36.5 10.4,42.9 20,33.3"></polygon>
      </g>
      <g fill="#90CAF9">
        <rect x="24" y="22" width="20" height="4"></rect>
        <rect x="24" y="9" width="20" height="4"></rect>
        <rect x="24" y="35" width="20" height="4"></rect>
      </g>
    </svg>
    <a class="text-decoration-none text-black" href="../orders/order_view.php"><p>Pedidos</p></a>

  </section>
  <section class="d-flex ps-8 gap-4 py-3 justify-content-start align-items-center btn-start">
    <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 48 48"
         class="text-lg" height="1em" width="1em"
         xmlns="http://www.w3.org/2000/svg">
      <g fill="#00BCD4">
        <rect x="19" y="22" width="10" height="20"></rect>
        <rect x="6" y="12" width="10" height="30"></rect>
        <rect x="32" y="6" width="10" height="36"></rect>
      </g>
    </svg>
    <p>Estadísticas</p>
  </section>
  <section class="d-flex ps-8 gap-4 py-3 justify-content-start align-items-center btn-start">
    <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 48 48"
         class="text-lg" height="1em" width="1em"
         xmlns="http://www.w3.org/2000/svg">
      <path fill="#FFCCBC"
            d="M7,40V8c0-2.2,1.8-4,4-4h24c2.2,0,4,1.8,4,4v32c0,2.2-1.8,4-4,4H11C8.8,44,7,42.2,7,40z"></path>
      <g fill="#FF5722">
        <polygon points="42.7,24 32,33 32,15"></polygon>
        <rect x="14" y="21" width="23" height="6"></rect>
      </g>
    </svg>
    <!--    <a onclick="-->
    <a class="text-decoration-none text-black" href="../components/logout.php"><p>Cerrar sesión</p></a>
  </section>
</div>