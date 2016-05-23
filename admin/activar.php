<?php
    include_once '../config/config.php';
    include_once '../funciones.php';
    protege("administrador");
?>
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
  <h3 class="bg-3">Activar curso</h3>
  <p>
    <?php
      $file = fopen('../RegAlumAitor.csv', 'r');
      $datos = fgetcsv($file, 0, ',', '"');
      $arrlength = count($datos);
      $conn = mysqli_connect($servername, $username, $password, $dbname);

      $sql = "CREATE TABLE IF NOT EXISTS alumnos" . $cursoActivo . " (";

      for ($x = 0; $x < $arrlength; $x++) {
          $var = $datos[$x];
          $var = sanear_string($var);
          if ($x != ($arrlength - 1)) {
              if ($var == "N_Id_Escolar") {
                  $sql .= $var . " VARCHAR(40)" . " PRIMARY KEY, ";
              } else {
              $sql .= $var . " VARCHAR(40)" . ", ";
              }
          } else {
                  $sql .= $var . " VARCHAR(40)" . ") ENGINE=InnoDB DEFAULT CHARSET=utf8;";
          }
      }

      if (mysqli_query($conn, $sql)) {
          echo "La tabla alumnos" . $cursoActivo . " se ha creado correctamente o ya existía" . "<br>";
      } else {
          echo "Error al crear la tabla alumnos: " . mysqli_error($conn) . "<br>";
      }

      $sql = "CREATE TABLE IF NOT EXISTS cabecera" . $cursoActivo . " (";

      for ($x = 0; $x < $arrlength; $x++) {
          $var = $datos[$x];
          $var = sanear_string($var);
          if ($x != ($arrlength - 1)) {
              $sql .= $var . " VARCHAR(40)" . ", ";
              } else {
                  $sql .= $var . " VARCHAR(40)" . ") ENGINE=InnoDB DEFAULT CHARSET=utf8;";
              }
      }

      if (mysqli_query($conn, $sql)) {
          echo "La tabla cabecera" . $cursoActivo . " se ha creado correctamente o ya existía" . "<br>";
      } else {
          echo "Error al crear la tabla cabecera: " . mysqli_error($conn) . "<br>";
      }

      $sql = "CREATE TABLE IF NOT EXISTS asignaturas" . $cursoActivo . " ( "
              . "id_asignatura VARCHAR(10) NOT NULL PRIMARY KEY) ENGINE=InnoDB;";

      if (mysqli_query($conn, $sql)) {
          echo "La tabla asignaturas" . $cursoActivo . " se ha creado correctamente o ya existía" . "<br>";
      } else {
          echo "Error al crear la tabla asignaturas: " . mysqli_error($conn) . "<br>";
      }

      $sql = "CREATE TABLE IF NOT EXISTS notas" . $cursoActivo . " ( " .
             "N_Id_Escolar VARCHAR(40) NOT NULL,
             Trimestre VARCHAR(10) NOT NULL,
             id_asignatura VARCHAR(10) NOT NULL,
             Nota INT,
             FOREIGN KEY (N_Id_Escolar) REFERENCES alumnos" . $cursoActivo . "(N_Id_Escolar), " .
             "FOREIGN KEY (id_asignatura) REFERENCES asignaturas" . $cursoActivo . "(id_asignatura), " .
             "PRIMARY KEY (N_Id_Escolar, Trimestre, id_asignatura, Nota) ) ENGINE=InnoDB;";

      if (mysqli_query($conn, $sql)) {
          echo "La tabla notas" . $cursoActivo . " se ha creado correctamente o ya existía" . "<br>";
      } else {
          echo "Error al crear la tabla notas: " . mysqli_error($conn) . "<br>";
      }      

      $sql = "SELECT COUNT(*) FROM cabecera" . $cursoActivo . ";";
      $result = mysqli_query($conn, $sql);
      $fila = mysqli_fetch_array($result, MYSQLI_NUM);
      if ($fila[0] == 1) {
          echo "Los datos de la cabecera" . $cursoActivo . " ya están insertados" . "<br>";
      } else {
          $sql = "INSERT INTO cabecera" . $cursoActivo . " VALUES(";

          for ($x = 0; $x < $arrlength; $x++) {
              $var = $datos[$x];
              if ($x != ($arrlength -1)) {
              $sql .= "'$var'" . ", ";
              } else {
              $sql .= "'$var'" . ");";
              }
          }

          if (mysqli_query($conn, $sql)) {
              echo "Se han insertado correctamente los datos de las cabecera" . $cursoActivo . "<br>";
          } else {
              echo "Error al insertar los datos de las cabeceras: " . $cursoActivo . mysqli_error($conn) . "<br>";
          }
      }

      echo "<a href='../index.php'>Volver al índice</a>";
    ?>
  </p>
</div>

<!-- Pie de página -->
<div class="container-fluid bg-4 text-center" id='foot01'></div>
<script src="/eduGraph/script/javascript.js"></script>
</body>
</body>
</html>