<?php
    include_once '../config/config.php';
    include_once '../funciones.php';
    protege("jefe" || "administrador");
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
  <h3 class="bg-3">Gestión de notas y estadísticas</h3>
  <p>
    <?php
      include_once '../config/config.php';
      include_once '../funciones.php';
      protege("jefe" || "administrador");
      $conn = mysqli_connect($servername, $username, $password, $dbname);
      $cabecerasEncontradas = FALSE; //fijamos el control de encontrar la cabecera
      
      $file = fopen('../1ESO.csv', 'r');
      $sql1 = "INSERT IGNORE INTO asignaturas" . $cursoActivo . " VALUES ";
      $sql2 = "INSERT INTO notas" . $cursoActivo . " (";
      $sql3 = "INSERT INTO notas" . $cursoActivo . " (N_Id_Escolar, Trimestre, id_asignatura, Nota) VALUES (";
      while ($datos = fgetcsv($file)) {  //leemos una lÃ­nea en formato csv
        $asignatura = array();  
        if (!$cabecerasEncontradas) {
          
          if ($datos[0] == "Alumno/a") { // Cabecera encontrada
            $cabecerasEncontradas = TRUE;
            $arrlength = count($datos);

            $sql2 .= "$datos[0],";
            echo "sql2 control 1" . $sql2 . "<br>";
            echo "sql3 " . $sql3 . "<br>";

            for ($x = 1; $x < $arrlength; $x++) { // Cogemos todos los cÃ³digos de asignaturas
              $var = $datos[$x];
              $asignatura[$x - 1] = $var;
              $sql1 .=  "('$var'),";
              $sql2 .=  "$var,";
            }
                    
            echo "sql2 control 2" . $sql2 . "<br>";
            
            $sql1 = substr($sql1, 0, -1); // quitamos la coma sobrante
            $sql1 .= ";";
            if (mysqli_query($conn, $sql1)) {
              echo "Las asignaturas se han insertado correctamente o ya existían<br>";
            } else {
              echo "Error al insertar las asignaturas: " . mysqli_error($conn) . "<br>";
            }

            $sql2 = substr($sql2, 0, -1); // quitamos la coma sobrante

            $sql2 .= ") VALUES (";
            
            echo "sql2 control 3 prueba" . $sql2 . "<br>";
            
            $arrlength2 = count($asignatura);

            for($x = 0; $x < $arrlength2; $x++) {
              echo $asignatura[$x];
              echo " ";
            }
            
          }
        } else { //si !cabecerasEncontradas = FALSE
          
          echo "sql2 control 3 prueba bis" . $sql2 . "<br>";
          
          echo count($asignatura);
          $arrlength2 = count($asignatura);

            for($x = 0; $x < $arrlength2; $x++) {
              echo $asignatura[$x];
              echo "<br>";
            }
          
          $arrlength = count($datos);
          for ($x = 0; $x < $arrlength; $x++) {
            if ($x < ($arrlength - 1)) {
            echo $asignatura[$x];
            }
            $var = $datos[$x];     
            $sql2 .= "'$var',"; //metemos todos los valores de un alumno
          }
          
        echo "sql2 control 4" . $sql2 . "<br>";  
        $sql2 = substr($sql2, 0, -1); //quitamos la coma sobrante
        $sql2 .= "),(";// empezamos otro registro
        }
      }
      echo "sql2 control 5" . $sql2 . "<br>";
      $sql2 = substr($sql2, 0, -2); // quitamos lo sobrante del Ãºltimo registro
      $sql2 .= ";";
      echo "Sql2 " . $sql2;
    ?>    
  </p>
</div>

<!-- Pie de página -->
<div class="container-fluid bg-4 text-center" id='foot01'></div>
<script src="/eduGraph/script/javascript.js"></script>
</body>     
</html>