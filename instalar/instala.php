<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
</head>
<body>    
<?php
include_once '../config/config.php';

$conn = mysqli_connect($servername, $username, $password);

if (!$conn) {
    echo "Conexión fallada: " . mysqli_connect_error() . "<br>";
} else {
    echo "Conexión realizada" . "<br>";
}

$sql = "CREATE DATABASE IF NOT EXISTS $dbname;";

if (mysqli_query($conn, $sql)) {
    echo "La base de datos se ha creado correctamente o ya existía" . "<br>";
} else {
    echo "Error creando la base de datos: " . mysqli_error($conn) . "<br>";
}

$sql = "USE $dbname;";

if (mysqli_query($conn, $sql)) {
    echo "Base de datos seleccionada correctamente" . "<br>";
} else {
    echo "Error al seleccionar la base de datos: " . mysqli_error($conn) . "<br>";
}

$sql = "CREATE TABLE IF NOT EXISTS usuarios (
  login VARCHAR(25) NOT NULL PRIMARY KEY,
  password VARCHAR(100) NOT NULL,
  rol SET('administrador', 'jefe') NOT NULL,
  nombre VARCHAR(200) NOT NULL,
  apellidos VARCHAR(200) NOT NULL
) ENGINE = InnoDB;";

if (mysqli_query($conn, $sql)) {
    echo "La tabla usuarios se ha creado correctamente o ya existía" . "<br>";
} else {
    echo "Error al crear la tabla usuarios: " . mysqli_error($conn) . "<br>";
}

$sql = "INSERT INTO usuarios(login, password, rol, nombre, apellidos)
VALUES('admin', password('admin'), 'administrador', 'Aitor', 'Igartua');";

if (mysqli_query($conn, $sql)) {
    echo "El usuario administrador se ha creado correctamente" . "<br>";
} else {
    echo "Error creando el usuario administrador: " . mysqli_error($conn) . "<br>";
}

$sql = "INSERT INTO usuarios(login, password, rol, nombre, apellidos)
VALUES('jefe', password('jefe'), 'jefe', 'Aitor', 'Igartua');";

if (mysqli_query($conn, $sql)) {
    echo "El usuario jefe se ha creado correctamente" . "<br>";
} else {
    echo "Error creando el usuario jefe: " . mysqli_error($conn) . "<br>";
}

mysqli_close($conn);

echo "<a href='../index.php'>Volver al índice</a>";
?>
</body>
</html>