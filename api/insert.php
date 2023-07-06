<?php
// Autor: Christian De Santis

require __DIR__ . '/db.php';

// Preparando y enlazando statement
$stmt = $conn->prepare("INSERT INTO records (activity, date) VALUES (?, ?)");
$stmt->bind_param("ss", $activity, $date);

// Seteando parámetros y ejecutando statement
$activity = $_POST["activity"];
$date = $_POST["date"];
$stmt->execute();

// Cerrando statement y conexión
$stmt->close();
$conn->close();
