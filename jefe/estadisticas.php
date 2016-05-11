<?php
    include_once '../config/config.php';
    include_once '../funciones.php';
    protege("jefe" || "administrador");
?>
<!DOCTYPE html>
<html lang="es">
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../css/style.css" />
</head>
<body>
    <nav>
        <ul>
            <li><a href='/aplicacion/index.php'>Indice</a></li>
            <li><a href='/aplicacion/regAlumnos.php'>Registrar alumnos</a></li>
            <li><a href='/aplicacion/instalar/instala.php'>Instalador</a></li>
            <li><a href='/aplicacion/admin/admin.php'>Admin</a></li>
            <li><a href='/aplicacion/jefe/jefe.php'>Jefe de estudios</a></li>
        </ul>
    </nav>
    <main>
    <header>Página de gestión de notas y estadísticas - Indice</header>      
    <?php
    include_once '../config/config.php';
    include_once '../funciones.php';
    protege("jefe" || "administrador");
    $file = fopen('../1ESO.csv', 'r');
    $cabecerasEncontradas = FALSE;
    $sql = "INSERT INTO notas" . $cursoActivo . " VALUES(";
    /*
    while ($datos = fgetcsv($file)) {
      $arrlength = count($datos);
      if($datos[0] == "Alumno/a") {
        for ($x = 1; $x < $arrlength; $x++) {
          $var = $datos[$x];
          echo $var . "<br>";
          $cabecerasEncontradas = TRUE;
        }
      }
      if($cabecerasEncontradas) {
        for ($x = 0; $x < $arrlength; $x++) {
          $var = $datos[$x];
          echo $var . "<br>";
        }
      }
    }
 
     */
    /*
    while ($datos = fgetcsv($file)) {
      while (!$cabecerasEncontradas) {
        if($datos[0] == "Alumno/a") {
          $cabecerasEncontradas = TRUE;
        } 
      }
      if($cabecerasEncontradas) {
        $arrlength = count($datos);
            for ($x = 0; $x < $arrlength; $x++) {
                if ($x = 0) {
                    echo $datos[x];
                } else {
                $var = $datos[$x];
                echo $var . "<br>";
                $sql .= "$var, ";
            }
      }
      }
    }
    */
    while ($datos = fgetcsv($file)) {
      if(!$cabecerasEncontradas) {
        if($datos[0] == "Alumno/a") {
          $cabecerasEncontradas = TRUE;
          $arrlength = count($datos);
          for ($x = 1; $x < $arrlength; $x++) {
            $var = $datos[$x];
            echo $var . "<br>";
            $sql .=  "$var, ";
          }
        }
      }
      else {
        $arrlength = count($datos);
          for ($x = 0; $x < $arrlength; $x++) {
            if ($x = 0) {
              echo $datos[0];
            } else {
              $var = $datos[$x];
              echo $var . "<br>";
            }
          }
        }
    }
    /*
    while ($datos = fgetcsv($file)) {      
        if(!$cabecerasEncontradas) {
            if($datos[0] == "Alumno/a") {
                $cabecerasEncontradas = TRUE;
                $arrlength = count($datos);
                for ($x = 1; $x < $arrlength; $x++) {
                    $var = $datos[$x];
                    echo $var . "<br>";
                    $sql .=  "$var, ";
                }
            } else {
              
            }
        } else if($cabecerasEncontradas) {
          $arrlength = count($datos);
          for ($x = 0; $x < $arrlength; $x++) {
            if ($x = 0) {
              echo $datos[x];
            } else {
              $var = $datos[$x];
              echo $var . "<br>";
              $sql .= "$var, ";
            }
          }
        }
    }
    echo $sql;
*/
    ?>    
    </main>
</body>     
</html>