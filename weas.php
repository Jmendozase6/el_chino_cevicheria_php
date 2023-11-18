<?php
$data = [10, 6, 10, 4, 5, 6, 100];
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Gráfico con Chart.js y PHP</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <link rel="stylesheet" href="presentation/resources/bootstrap/css/bootstrap.min.css">
</head>
<body>
<div>
  <div class="container">
    <canvas id="myChart">
      <script>
          const ctx = document.getElementById('myChart');
          new Chart(ctx, {
              type: 'bar',
              data: {
                  labels: ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'],
                  datasets: [{
                      label: 'Ventas Diarias',
                      data: <?= json_encode($data) ?>,
                      borderWidth: 1,
                      backgroundColor: [
                          'rgba(255, 99, 132, 0.3)',
                          'rgba(255, 159, 64, 0.3)',
                          'rgba(255, 205, 86, 0.3)',
                          'rgba(75, 192, 192, 0.3)',
                          'rgba(54, 162, 235, 0.3)',
                          'rgba(153, 102, 255, 0.3)',
                          'rgba(201, 203, 207, 0.3)'
                      ],
                  }],
              },
              options: {
                  scales: {
                      y: {
                          beginAtZero: true
                      }
                  }
              }
          });
      </script>

    </canvas>
  </div>
</div>
</body>
</html>
