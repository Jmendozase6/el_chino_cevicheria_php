<?php

require_once __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

// Email
define("EMAIL_CRED", $_ENV['EMAIL_CRED']);

// Mercado Pago
define("MERCADO_PAGO_TEST_PUBLIC_KEY", $_ENV['MERCADO_PAGO_TEST_PUBLIC_KEY']);
define("MERCADO_PAGO_ACCESS_TOKEN", $_ENV['MERCADO_PAGO_ACCESS_TOKEN']);

// Database General
define("DRIVER", $_ENV['DRIVER']);
define("HOST", $_ENV['HOST']);
define("PORT", $_ENV['PORT']);

// Database Production
define("P_USER", $_ENV['P_USER']);
define("P_PASS", $_ENV['P_PASS']);
define("P_BASE", $_ENV['P_BASE']);

// Database Development
define("D_USER", $_ENV['D_USER']);
define("D_PASS", $_ENV['D_PASS']);
define("D_BASE", $_ENV['D_BASE']);