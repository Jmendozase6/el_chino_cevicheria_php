<?php
$paymentId = $_GET['payment_id'];
$paymentStatus = $_GET['status'];
$paymentType = $_GET['payment_type'];
$orderId = $_GET['merchant_order_id'];

echo '<h3>Payment Information</h3>';

echo "paymentId: " . $paymentId . '<br>';
echo "paymentStatus: " . $paymentStatus . '<br>';
echo "paymentType: " . $paymentType . '<br>';
echo "orderId: " . $orderId . '<br>';
