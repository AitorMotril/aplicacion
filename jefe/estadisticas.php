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
    
    $cabecerasEncontradas=FALSE; //fijamos el control de encontrar la cabecera
  
    $file = fopen('../1ESO.csv', 'r');
    $sql1 = "INSERT IGNORE INTO asignaturas" . $cursoActivo . " VALUES ";
    $sql2 = "INSERT INTO notas" . $cursoActivo . " (";
    while ($datos = fgetcsv($file)) {  //leemos una lÃ­nea en formato csv     
      if(!$cabecerasEncontradas) {
        
        if($datos[0] == "Alumno/a") { // Cabecera encontrada
          $cabecerasEncontradas = TRUE;
          $arrlength = count($datos);
          
          $sql2 .= "$datos[0],";
          
          for ($x = 1; $x < $arrlength; $x++) { // Cogemos todos los cÃ³digos de asignaturas
            $var = $datos[$x];
            $sql1 .=  "('$var'),";
            $sql2 .=  "$var,";
          }        
          
          $sql1 = substr($sql1, 0, -1); // quitamos la coma sobrante
          $sql1 .= ";";
          echo "<br>" . "Sql asig " . $sql1 . "<br>"; 
            

          $sql2 = substr($sql2, 0, -1); // quitamos la coma sobrante
          
          $sql2 .= ") VALUES (";
	}
      } else {
        $arrlength = count($datos);
        for ($x = 0; $x < $arrlength; $x++) {
          $var = $datos[$x];       
          $sql2 .= "'$var',"; //metemos todos los valores de un alumno
        }
      $sql2 = substr($sql2, 0, -1); //quitamos la coma sobrante
      $sql2 .= "),(";// empezamos otro registro
      }
    }
    $sql2 = substr($sql2, 0, -2); // quitamos lo sobrante del Ãºltimo registro
    $sql2 .= ";";
    echo "Sql2 " . $sql2;
    
    ?>    
    </main>
</body>     
</html>