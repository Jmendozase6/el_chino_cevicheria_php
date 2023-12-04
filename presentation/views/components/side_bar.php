<?php
$page = substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'], "/") + 1);
?>
<div class="side-menu bg-white vh-100">
  <img class="mx-auto d-flex justify-content-center" src="../../resources/images/logo.png" alt="logo"/>
  <section
      class="d-flex ps-8 gap-4 py-3 justify-content-start align-items-center btn-start <?= $page == "home_view.php" ? 'active' : ''; ?>">
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
    <a class="text-decoration-none color-text <?= $page == "home_view.php" ? 'active-text' : ''; ?>"
       href="../home/home_view.php"><p>Inicio</p></a>
  </section>
  <section
      class="d-flex ps-8 gap-4 py-3 justify-content-start align-items-center btn-start <?= $page == "categories_view.php" ? 'active' : ''; ?>">
    <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 48 48" class="text-lg" height="1em"
         width="1em" xmlns="http://www.w3.org/2000/svg"
         data-darkreader-inline-stroke=""
         style="--darkreader-inline-stroke: currentColor; --darkreader-inline-fill: currentColor;"
         data-darkreader-inline-fill="">
      <path fill="#8BC34A" d="M43,36H29V14h10.6c0.9,0,1.6,0.6,1.9,1.4L45,26v8C45,35.1,44.1,36,43,36z"
            data-darkreader-inline-fill="" style="--darkreader-inline-fill: #95c85a;"></path>
      <path fill="#388E3C" d="M29,36H5c-1.1,0-2-0.9-2-2V9c0-1.1,0.9-2,2-2h22c1.1,0,2,0.9,2,2V36z"
            data-darkreader-inline-fill="" style="--darkreader-inline-fill: #77c97b;"></path>
      <g fill="#37474F" data-darkreader-inline-fill="" style="--darkreader-inline-fill: #beb8b0;">
        <circle cx="37" cy="36" r="5"></circle>
        <circle cx="13" cy="36" r="5"></circle>
      </g>
      <g fill="#78909C" data-darkreader-inline-fill="" style="--darkreader-inline-fill: #9e9689;">
        <circle cx="37" cy="36" r="2"></circle>
        <circle cx="13" cy="36" r="2"></circle>
      </g>
      <path fill="#37474F"
            d="M41,25h-7c-0.6,0-1-0.4-1-1v-7c0-0.6,0.4-1,1-1h5.3c0.4,0,0.8,0.3,0.9,0.7l1.7,5.2c0,0.1,0.1,0.2,0.1,0.3V24 C42,24.6,41.6,25,41,25z"
            data-darkreader-inline-fill="" style="--darkreader-inline-fill: #beb8b0;"></path>
      <polygon fill="#DCEDC8" points="21.8,13.8 13.9,21.7 10.2,17.9 8,20.1 13.9,26 24,15.9"
               data-darkreader-inline-fill="" style="--darkreader-inline-fill: #cee6b2;"></polygon>
    </svg>
    <a class="text-decoration-none color-text <?= $page == "categories_view.php" ? 'active-text' : ''; ?>"
       href="../home/categories_view.php"><p>Categorías</p></a>
  </section>
  <section
      class="d-flex ps-8 gap-4 py-3 justify-content-start align-items-center btn-start <?= $page == "order_view.php" ? 'active' : ''; ?> ">
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
    <a class="text-decoration-none color-text <?= $page == "order_view.php" ? 'active-text' : ''; ?>"
       href="../orders/order_view.php"><p>Pedidos</p></a>

  </section>
  <section
      class="d-flex ps-8 gap-4 py-3 justify-content-start align-items-center btn-start <?= $page == "clients_admin_view.php" ? 'active' : ''; ?> ">
    <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 48 48"
         class="text-lg" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"
         data-darkreader-inline-stroke=""
         style="--darkreader-inline-stroke: currentColor; --darkreader-inline-fill: currentColor;"
         data-darkreader-inline-fill="">
      <rect x="6" y="38" fill="#2196F3" width="4" height="4" data-darkreader-inline-fill=""
            style="--darkreader-inline-fill: #33a2f4;"></rect>
      <rect x="6" y="30" fill="#2196F3" width="12" height="4" data-darkreader-inline-fill=""
            style="--darkreader-inline-fill: #33a2f4;"></rect>
      <rect x="6" y="22" fill="#2196F3" width="20" height="4" data-darkreader-inline-fill=""
            style="--darkreader-inline-fill: #33a2f4;"></rect>
      <rect x="6" y="14" fill="#2196F3" width="28" height="4" data-darkreader-inline-fill=""
            style="--darkreader-inline-fill: #33a2f4;"></rect>
      <rect x="6" y="6" fill="#2196F3" width="36" height="4" data-darkreader-inline-fill=""
            style="--darkreader-inline-fill: #33a2f4;"></rect>
    </svg>
    <a class="text-decoration-none color-text <?= $page == "clients_admin_view.php" ? 'active-text' : ''; ?>"
       href="../home/clients_admin_view.php"><p>Clientes</p></a>
  </section>
  <section
      class="d-flex ps-8 gap-4 py-3 justify-content-start align-items-center btn-start">
    <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 48 48"
         class="text-lg" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"
         data-darkreader-inline-stroke=""
         style="--darkreader-inline-stroke: currentColor; --darkreader-inline-fill: currentColor;"
         data-darkreader-inline-fill="">
      <path fill="#FFC107"
            d="M44,36H30V16c0-1.1,0.9-2,2-2h8c0.6,0,1.2,0.3,1.6,0.8l6,7.7c0.3,0.4,0.4,0.8,0.4,1.2V32 C48,34.2,46.2,36,44,36z"
            data-darkreader-inline-fill="" style="--darkreader-inline-fill: #ffc71e;"></path>
      <g fill="#9575CD" data-darkreader-inline-fill="" style="--darkreader-inline-fill: #9879ce;">
        <path d="M8,36h22V13c0-2.2-1.8-4-4-4H4v23C4,34.2,5.8,36,8,36z"></path>
        <rect y="9" width="10" height="2"></rect>
        <rect y="14" width="10" height="2"></rect>
        <rect y="19" width="10" height="2"></rect>
        <rect y="24" width="10" height="2"></rect>
      </g>
      <g fill="#7E57C2" data-darkreader-inline-fill="" style="--darkreader-inline-fill: #8864c7;">
        <rect x="4" y="11" width="16" height="2"></rect>
        <rect x="4" y="16" width="12" height="2"></rect>
        <rect x="4" y="21" width="8" height="2"></rect>
        <rect x="4" y="26" width="4" height="2"></rect>
      </g>
      <g fill="#37474F" data-darkreader-inline-fill="" style="--darkreader-inline-fill: #beb8b0;">
        <circle cx="39" cy="36" r="5"></circle>
        <circle cx="16" cy="36" r="5"></circle>
      </g>
      <g fill="#78909C" data-darkreader-inline-fill="" style="--darkreader-inline-fill: #9e9689;">
        <circle cx="39" cy="36" r="2.5"></circle>
        <circle cx="16" cy="36" r="2.5"></circle>
      </g>
      <path fill="#455A64"
            d="M44,26h-3.6c-0.3,0-0.5-0.1-0.7-0.3l-1.4-1.4c-0.2-0.2-0.4-0.3-0.7-0.3H34c-0.6,0-1-0.4-1-1v-6 c0-0.6,0.4-1,1-1h5.5c0.3,0,0.6,0.1,0.8,0.4l4.5,5.4c0.1,0.2,0.2,0.4,0.2,0.6V25C45,25.6,44.6,26,44,26z"
            data-darkreader-inline-fill="" style="--darkreader-inline-fill: #b3aca2;"></path>
    </svg>
    <a class="text-decoration-none color-text <?= $page == "products_admin_view.php" ? 'active-text' : ''; ?>"
       href="../products_admin/products_admin_view.php"><p>
        Productos</p>
    </a>
  </section>
  <section
      class="d-flex ps-8 gap-4 py-3 justify-content-start align-items-center btn-start <?= $page == "statistics_view.php" ? 'active' : ''; ?>">
    <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 48 48"
         class="text-lg" height="1em" width="1em"
         xmlns="http://www.w3.org/2000/svg">
      <g fill="#00BCD4">
        <rect x="19" y="22" width="10" height="20"></rect>
        <rect x="6" y="12" width="10" height="30"></rect>
        <rect x="32" y="6" width="10" height="36"></rect>
      </g>
    </svg>
    <a class="text-decoration-none color-text <?= $page == "statistics_view.php" ? 'active-text' : ''; ?>"
       href="../statistics/statistics_view.php"><p>
        Estadísticas</p>
    </a>
  </section>
  <section
      class="d-flex ps-8 gap-4 py-3 justify-content-start align-items-center btn-start <?= $page == "profile_admin_view.php" ? 'active' : ''; ?>">
    <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 48 48"
         class="text-lg" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"
         data-darkreader-inline-stroke=""
         style="--darkreader-inline-stroke: currentColor; --darkreader-inline-fill: currentColor;"
         data-darkreader-inline-fill="">
      <polygon fill="#FF9800" points="24,37 19,31 19,25 29,25 29,31" data-darkreader-inline-fill=""
               style="--darkreader-inline-fill: #ffa21a;"></polygon>
      <g fill="#FFA726" data-darkreader-inline-fill="" style="--darkreader-inline-fill: #ffad34;">
        <circle cx="33" cy="19" r="2"></circle>
        <circle cx="15" cy="19" r="2"></circle>
      </g>
      <path fill="#FFB74D" d="M33,13c0-7.6-18-5-18,0c0,1.1,0,5.9,0,7c0,5,4,9,9,9s9-4,9-9C33,18.9,33,14.1,33,13z"
            data-darkreader-inline-fill="" style="--darkreader-inline-fill: #ffb84f;"></path>
      <path fill="#424242"
            d="M24,4c-6.1,0-10,4.9-10,11c0,0.8,0,2.3,0,2.3l2,1.7v-5l12-4l4,4v5l2-1.7c0,0,0-1.5,0-2.3c0-4-1-8-6-9l-1-2 H24z"
            data-darkreader-inline-fill="" style="--darkreader-inline-fill: #beb9b0;"></path>
      <g fill="#784719" data-darkreader-inline-fill="" style="--darkreader-inline-fill: #e5b181;">
        <circle cx="28" cy="19" r="1"></circle>
        <circle cx="20" cy="19" r="1"></circle>
      </g>
      <polygon fill="#fff" points="24,43 19,31 24,32 29,31" data-darkreader-inline-fill=""
               style="--darkreader-inline-fill: #e8e6e3;"></polygon>
      <polygon fill="#D32F2F" points="23,35 22.3,39.5 24,43.5 25.7,39.5 25,35 26,34 24,32 22,34"
               data-darkreader-inline-fill="" style="--darkreader-inline-fill: #d74343;"></polygon>
      <path fill="#546E7A" d="M29,31L29,31l-5,12l-5-12c0,0-11,2-11,13h32C40,33,29,31,29,31z"
            data-darkreader-inline-fill="" style="--darkreader-inline-fill: #a79f94;"></path>
    </svg>
    <a class="text-decoration-none color-text <?= $page == "profile_admin_view.php" ? 'active-text' : ''; ?>"
       href="../profile_admin/profile_admin_view.php"><p>
        Cuenta</p>
    </a>
  </section>
  <section
      class="d-flex ps-8 gap-4 py-3 justify-content-start align-items-center btn-start">
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
    <a class="text-decoration-none color-text" href="../components/logout.php"><p>Cerrar sesión</p></a>
  </section>
</div>