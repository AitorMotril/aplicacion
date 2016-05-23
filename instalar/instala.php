<!DOCTYPE html>
<html lang="es">
<head>
  <title><?php echo $siteName;?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <link rel="stylesheet" href="/eduGraph/css/style.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <link rel="icon" href="/eduGraph/img/iconv1.png" type="image/x-icon">
</head>
<body>
  
<!-- Cabecera con la imagen de logo y el lema de la página -->
<div class="container-fluid clearfix" id="toplogo"></div>

<!-- Menú superior de navegación fijo -->
<nav class="navbar navbar-inverse" data-spy="affix" data-offset-top="77" id="nav01"></nav>

<div class="container-fluid">
  <h3 class="bg-3">Instalación</h3>
  <p>
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
  </p>
</div>  

<!-- Pie de página -->
<div class="container-fluid bg-4 text-center" id='foot01'></div>
<script src="/eduGraph/script/javascript.js"></script>
</body>
</html>