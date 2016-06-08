<?php
  include_once '../config/config.php';
  include_once '../funciones.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title><?php echo $siteName;?></title>
  <base href='<?php echo $urlbase;?>' target='_self'>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <link rel="stylesheet" href="css/style.css" />
  <link rel="icon" href="img/iconv1.png" type="image/x-icon">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
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
    
      if ($instalar != 1) {
        instalar();
      } else {
        echo "La aplicación ya está instalada y configurada." . "<br>" . 
             "<a href='index.php'>Volver al índice</a>";
      }
    
      //Funcion instalar() de instalación
      function instalar() {
        
        global $servername, $username, $password, $dbname;

        // Variable de instalación de la aplicación, salta a cero si hay algún error
        $instalar = 1;
        $confi = fopen("../config/config.php", "a") or die("Unable to open file!");

        $conn = mysqli_connect($servername, $username, $password);

        if (!$conn) {
          $instalar = 0;
          echo "Conexión fallada: " . mysqli_connect_error() . "<br>";
        } else {
          echo "Conexión realizada" . "<br>";
        }

        $sql = "CREATE DATABASE IF NOT EXISTS $dbname;";

        if (mysqli_query($conn, $sql)) {
          echo "La base de datos se ha creado correctamente o ya existía" . "<br>";
        } else {
          $instalar = 0;
          echo "Error creando la base de datos: " . mysqli_error($conn) . "<br>";
        }

        $sql = "USE $dbname;";

        if (mysqli_query($conn, $sql)) {
          echo "Base de datos seleccionada correctamente" . "<br>";
        } else {
          $instalar = 0;
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
          $instalar = 0;
          echo "Error al crear la tabla usuarios: " . mysqli_error($conn) . "<br>";
        }

        $sql = "INSERT INTO usuarios(login, password, rol, nombre, apellidos)
                VALUES('admin', password('admin'), 'administrador', 'Aitor', 'Igartua');";

        if (mysqli_query($conn, $sql)) {
          echo "El usuario administrador se ha creado correctamente" . "<br>";
        } else {
          $instalar = 0;
          echo "Error creando el usuario administrador: " . mysqli_error($conn) . "<br>";
        }

        $sql = "INSERT INTO usuarios(login, password, rol, nombre, apellidos)
                VALUES('jefe', password('jefe'), 'jefe', 'Aitor', 'Igartua');";

        if (mysqli_query($conn, $sql)) {
          echo "El usuario jefe se ha creado correctamente" . "<br>";
        } else {
          $instalar = 0;
          echo "Error creando el usuario jefe: " . mysqli_error($conn) . "<br>";
        }

        if ($instalar == 1) {
          fwrite($confi, "\n". "$" . "instalar" . " = " . $instalar . ";");
          echo "La aplicación se ha instalado correctamente.";
        } else {
          echo "La instalación no se ha producido correctamente.";
        }

        mysqli_close($conn);

        echo "<br><em><a href='index.php'>Volver al índice</a></em>";
      
      } //end funcion instalar();
      
    ?>
  </p>
</div>  

<!-- Pie de página -->
<div class="container-fluid bg-4 text-center" id='foot01'></div>
<script src="script/javascript.js"></script>
</body>
</html>