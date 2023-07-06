<?php
// Autor: Christian De Santis

require __DIR__ . '/db.php';

// Preparando y enlazando statement
$stmt = $conn->prepare("UPDATE records SET activity = ?, date = ? WHERE id = ?");
$stmt->bind_param("ssi", $activity, $date, $id);

// Seteando parámetros y ejecutando statement
parse_str(file_get_contents("php://input"), $params);
$id = $params["id"];
$activity = $params["activity"];
$date = $params["date"];
$stmt->execute();

// Cerrando statement y conexión
$stmt->close();
$conn->close();
