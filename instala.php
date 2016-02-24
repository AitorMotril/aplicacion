<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
</head>
<body>    
<?php
include_once './config/config.php';

$conn = mysqli_connect($servername, $username, $password);

if (!$conn) {
    echo "Conexión fallada: " . mysqli_connect_error();
} else {
    echo "Conexión realizada";
}

$sql = "CREATE DATABASE IF NOT EXISTS $dbname;";

if (mysqli_query($conn, $sql)) {
    echo "La base de datos se ha creado correctamente";
} else {
    echo "Error creando la base de datos: " . mysqli_error($conn);
}

$sql = "USE $dbname;";

if (mysqli_query($conn, $sql)) {
    echo "Base de datos seleccionada correctamente";
} else {
    echo "Error al seleccionar la base de datos: " . mysqli_error($conn);
}

$sql = "CREATE TABLE IF NOT EXISTS usuarios (
  login VARCHAR(25) NOT NULL PRIMARY KEY,
  password VARCHAR(100) NOT NULL,
  rol SET('administrador', 'jefe') NOT NULL,
  nombre VARCHAR(200) NOT NULL,
  apellidos VARCHAR(200) NOT NULL
) ENGINE = InnoDB;";

mysqli_query($conn, $sql)or die("error al crear la tabla usuarios" . mysqli_error($conn));

$sql = "INSERT INTO usuarios(login, password, rol, nombre, apellidos)
VALUES('admin', password('admin'), 'administrador', 'Aitor', 'Igartua');";

if (mysqli_query($conn, $sql)) {
    echo "El usuario administrador se ha creado correctamente";
} else {
    echo "Error creando el usuario administrador: " . mysqli_error($conn);
}

$sql = "INSERT INTO usuarios(login, password, rol, nombre, apellidos)
VALUES('jefe', password('jefe'), 'jefe', 'Aitor', 'Igartua');";

if (mysqli_query($conn, $sql)) {
    echo "El usuario jefe se ha creado correctamente";
} else {
    echo "Error creando el usuario jefe: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
</body>
</html>