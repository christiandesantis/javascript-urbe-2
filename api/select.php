<?php
// Autor: Christian De Santis

require __DIR__ . '/db.php';

// Ejecutando query y obteniendo resultados
$sql = "SELECT * FROM records";
$result = $conn->query($sql);

// Convirtiendo resultados a JSON e imprimiendo
$rows = array();
while ($row = $result->fetch_assoc()) {
  $rows[] = $row;
}
echo json_encode($rows);

// Cerrando conexión
$conn->close();
