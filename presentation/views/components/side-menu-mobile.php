<?php
$page = substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'], "/") + 1);
?>

<div class="side-menu-mobile">
  <nav class="navbar fixed-bottom bg-body-tertiary px-5 pb-3 py-3">
    <div class="container-fluid">
      <a class="text-decoration-none color-text <?= $page == "home_view.php" ? 'active-text' : ''; ?>"
         href="../home/home_view.php"
         type="button"><i class="bi bi-house-door-fill"></i>
      </a>
      <a class="text-decoration-none color-text <?= $page == "order_view.php" ? 'active-text' : ''; ?>"
         href="../orders/order_view.php"
         type="button"><i class="bi bi-file-earmark-bar-graph-fill"></i>
      </a>
      <a class="text-decoration-none color-text <?= $page == "categories_view.php" ? 'active-text' : ''; ?>"
         href="../home/categories_view.php"
         type="button"><i class="bi bi-file-earmark-bar-graph-fill"></i>
      </a>
      <a class="text-decoration-none color-text <?= $page == "clients_admin_view.php" ? 'active-text' : ''; ?>"
         href="../home/clients_admin_view.php"
         type="button"><i class="bi bi-person-fill"></i>
      </a>
      <a class="text-decoration-none color-text <?= $page == "statistics_view.php" ? 'active-text' : ''; ?> "
         href="../statistics/statistics_view.php"
         type="button"><i class="bi bi-bar-chart-line-fill"></i>
      </a>
      <a class="text-decoration-none color-text <?= $page == "products_admin_view.php" ? 'active-text' : ''; ?>"
         href="../products_admin/products_admin_view.php"
         type="button"><i class="bi bi-card-checklist"></i>
      </a>
      <a class="text-decoration-none color-text"
         href="../components/logout.php" type="button"><i class="bi bi-box-arrow-left"></i>
      </a>
    </div>
  </nav>
</div>