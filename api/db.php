<?php
require __DIR__ . '/../vendor/autoload.php';

// Cargando variables de entorno
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

// Definiendo variables de conexión
$servername = $_ENV['DB_HOST'];
$dbname = $_ENV['DB_NAME'];
$username = $_ENV['DB_USER'];
$password = $_ENV['DB_PASS'];

// Abriendo conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Comprobando conexión
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
