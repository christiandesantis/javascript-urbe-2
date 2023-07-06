<?php
// Autor: Christian De Santis

require __DIR__ . '/db.php';

// Preparando y enlazando statement
$stmt = $conn->prepare("DELETE FROM records WHERE id = ?");
$stmt->bind_param("i", $id);

// Seteando parámetros y ejecutando statement
parse_str(file_get_contents("php://input"), $params);
$id = $params['id'];
$stmt->execute();

// Cerrando statement y conexión
$stmt->close();
$conn->close();
