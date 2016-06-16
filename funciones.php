<?php
include_once 'config/config.php';

// Funcion protege($rol), Crea la sesion o la propaga y verificar las variables de sesion
function protege($rol) {
  
    global $urlbase;
    session_start();
    if($_SESSION['validar'] != "1" || $_SESSION['rol'] != $rol) {
        header("Location: " . $urlbase . "index.php?usererror=si");
    }
    
}

function check_install() {
  global $instalar;
  $result = true;
  if (!$instalar) {
    $result = false;   
  }
  return $result;
}

function check_curso($display) {
  global $cursoActivo, $nombreCursoActivo, $cursoPrueba, $nombreCursoPrueba;
  
  if ($cursoActivo && $nombreCursoActivo) {
    if ($display) {
      $result = $nombreCursoActivo;
    } else {
      $result = true;
    }
  } elseif ($cursoPrueba && $nombreCursoPrueba) {
    if ($display) {
      $result = $nombreCursoPrueba;
    } else {
      $result = true;
    }
  } else {
    if ($display) {
      $result = "Sin curso activado";
    } else {
      $result = false;
    }
  }
  
  return $result;
}

function echoActiveClassIfRequestMatches($requestUri)
{
    $current_file_name = basename($_SERVER['REQUEST_URI'], ".php");
    echo $current_file_name;

    if ($current_file_name == $requestUri) {
        $result = "class='active'";
    }
    return $result;
}

////Funcion hide_install(), para ver si ya está instalada o no y mostrar en el menú
//function hide_install() {
//  global $instalar;
//  if ($instalar === 1) {
//    echo "
//          <script>
//            $(document).ready(function() {
//              $('#instalar_menu').hide();
//            }); 
//          </script>
//        ";
//  } 
//}


// Funcion sanear_string($string), convierte un string cualquiera en texto "sano" 
// para entrar en la base de datos
// args: $string, return: $string
function sanear_string($string) {
  
    $string = trim($string);
 
    $string = str_replace(
        array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
        array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
        $string
    );
 
    $string = str_replace(
        array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
        array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
        $string
    );
 
    $string = str_replace(
        array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
        array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
        $string
    );
 
    $string = str_replace(
        array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
        array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
        $string
    );
 
    $string = str_replace(
        array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
        array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
        $string
    );
 
    $string = str_replace(
        array('ñ', 'Ñ', 'ç', 'Ç'),
        array('n', 'N', 'c', 'C',),
        $string
    );

    $string = str_replace(
        array('\\', "¨", "º", "-", "~", "#", "@", "|", "!", "\"",
             "·", "$", "%", "&", "/", '(', ')', "?", "'", "¡",
             "¿", "[", "^", "<code>", "]", "+", "}", "{", "¨", "´",
             ">", "< ", ";", ",", ":", "."),
        '',
        $string
    );
    
    $string = str_replace(" ", "_", $string);
    return $string;
    
} // ./ end sanear_string($string)


//Funcion check_sesion(), comprobar si está iniciada o no la sesión
function check_sesion() {
  
  session_start();

  if (isset($_SESSION["validar"])) {
    // Si está autenticado, muestra Cerrar Sesión y oculta Iniciar Sesión
    echo "
          <script>
            $(document).ready(function() {
              $('#iniciarSesion').hide();
              $('#cerrarSesion').show();
            }); 
          </script>
         ";
  } else {
    // Si no ha iniciado sesión, muestra Iniciar Sesión y oculta Cerrar Sesión
    echo "
          <script>
            $(document).ready(function() {
              $('#iniciarSesion').show();
              $('#cerrarSesion').hide();
            });
          </script>
         ";
  }
  
} // ./ end check_sesion()


//Funcion error_form(), comprobar si el formulario de inicio de sesión está relleno y correcto
function error_form() {
  
  if ($_GET[error] === "si") {
    if ($_GET[formularioerror] === "si") {
      echo "<div class='alert alert-danger'>"
      . "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>"
      . "Rellena el formulario.</div>";
    } else {
      echo "<div class='alert alert-danger'>"
      . "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>"
      . "Verifica tus datos.</div>";
    }
  }
  if ($_GET[usererror] === "si") {
    echo "<div class='alert alert-danger'>"
    . "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>"
    . "No tienes permiso suficiente para acceder a esa página.</div>";
  }
  
} // ./ end error_form()


// Funcion activar_curso($file), a partir de leer un archivo csv, activa un curso
// arg: $file string con ruta de archivo
// return: escribe $cursoActivo en config.php
function activar_curso($file, $cursoActivar, $nombreCursoActivar) {
  
//  $confi = fopen('../config/config.php', 'a+');
  
  global $servername, $username, $password, $dbname;
  $datos = fgetcsv($file, 0, ',', '"');
  $arrlength = count($datos);
  $conn = mysqli_connect($servername, $username, $password, $dbname);
  
  // Variable de activación del curso, salta a cero si hay algún error
  $activar = 1;
  
  $sql = "INSERT IGNORE INTO cursos VALUES(" . "'$cursoActivar'" . ", " . "'$nombreCursoActivar'" . ");";
  
    if (mysqli_query($conn, $sql)) {
//    echo "La tabla alumnos" . $cursoActivo . " se ha creado correctamente o ya existía" . "<br>";
  } else {
    $activar = 0;
    echo "Error al insertar el curso: " . mysqli_error($conn) . "<br>";
  }
  
  // Crear tabla de alumnos
  $sql = "CREATE TABLE IF NOT EXISTS alumnos" . $cursoActivar . " (";

  for ($x = 0; $x < $arrlength; $x++) {
    
    $var = $datos[$x];
    $var = sanear_string($var);
    if ($x != ($arrlength - 1)) {
      if ($var === "N_Id_Escolar") {
        $sql .= $var . " VARCHAR(40)" . " PRIMARY KEY, ";
      } else {
        $sql .= $var . " VARCHAR(40)" . ", ";
      }
    } else {
      $sql .= $var . " VARCHAR(40)" . ") ENGINE=InnoDB DEFAULT CHARSET=utf8;";
    }
  }
  
  if (mysqli_query($conn, $sql)) {
//    echo "La tabla alumnos" . $cursoActivo . " se ha creado correctamente o ya existía" . "<br>";
  } else {
    $activar = 0;
    echo "Error al crear la tabla alumnos: " . mysqli_error($conn) . "<br>";
  }
  
  // Crear tabla de cabeceras
  $sql = "CREATE TABLE IF NOT EXISTS cabecera" . $cursoActivar . " (";

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
//    echo "La tabla cabecera" . $cursoActivo . " se ha creado correctamente o ya existía" . "<br>";
  } else {
    $activar = 0;
    echo "Error al crear la tabla cabecera: " . mysqli_error($conn) . "<br>";
  }

  // Crear tabla de asignaturas
  $sql = "CREATE TABLE IF NOT EXISTS asignaturas" . $cursoActivar . " ( "
          . "id_asignatura VARCHAR(10) NOT NULL PRIMARY KEY, "
          . "nombre_completo VARCHAR(255), "
          . "area_competencial VARCHAR(255)) ENGINE=InnoDB;";

  if (mysqli_query($conn, $sql)) {
//    echo "La tabla asignaturas" . $cursoActivo . " se ha creado correctamente o ya existía" . "<br>";
  } else {
    $activar = 0;
    echo "Error al crear la tabla asignaturas: " . mysqli_error($conn) . "<br>";
  }

  // Crear tabla de notas
  $sql = "CREATE TABLE IF NOT EXISTS notas" . $cursoActivar . " ( " .
         "N_Id_Escolar VARCHAR(40) NOT NULL,
         Trimestre VARCHAR(10) NOT NULL,
         id_asignatura VARCHAR(10) NOT NULL,
         Nota INT,
         FOREIGN KEY (N_Id_Escolar) REFERENCES alumnos" . $cursoActivar . "(N_Id_Escolar), " .
         "FOREIGN KEY (id_asignatura) REFERENCES asignaturas" . $cursoActivar . "(id_asignatura), " .
         "PRIMARY KEY (N_Id_Escolar, Trimestre, id_asignatura, Nota) ) ENGINE=InnoDB;";

  if (mysqli_query($conn, $sql)) {
//    echo "La tabla notas" . $cursoActivo . " se ha creado correctamente o ya existía" . "<br>";
  } else {
    $activar = 0;
    echo "Error al crear la tabla notas: " . mysqli_error($conn) . "<br>";
  }      

  // Insertar datos sin sanear en la tabla de cabeceras
  $sql = "SELECT COUNT(*) FROM cabecera" . $cursoActivar . ";";
  $result = mysqli_query($conn, $sql);
  $fila = mysqli_fetch_array($result, MYSQLI_NUM);
  
  if ($fila[0] === 1) {
//    echo "Los datos de la cabecera" . $cursoActivo . " ya están insertados" . "<br>";
  } else {
    $sql = "INSERT INTO cabecera" . $cursoActivar . " VALUES(";

    for ($x = 0; $x < $arrlength; $x++) {
      $var = $datos[$x];
      if ($x != ($arrlength -1)) {
        $sql .= "'$var'" . ", ";
      } else {
        $sql .= "'$var'" . ");";
      }
    }

    if (mysqli_query($conn, $sql)) {
//      echo "Se han insertado correctamente los datos de las cabecera" . $cursoActivo . "<br>";
    } else {
      $activar = 0;
      echo "Error al insertar los datos de las cabeceras: " . $cursoActivar . mysqli_error($conn) . "<br>";
    }
  } // ./ end INSERT INTO cabecera
  
  if ($activar === 0) {
    echo "El curso " . $nombreCursoActivar . " no se ha activado correctamente" . "<br>";
  } else {
    echo "Curso " . $nombreCursoActivar . " activado correctamente" . "<br>";
    if ($cursoActivar != 1) {
      $conf = fopen('../config/cursoActivo.php', 'w+');
      fwrite($conf, "<?php\n");
      fwrite($conf, "\n". "$" . "cursoActivo" . " = " . $cursoActivar . ";");
      fwrite($conf, "\n" . "$" . "nombreCursoActivo" . " = " . "'$nombreCursoActivar'" . ";");
      fclose($conf);
    } else {
      $conf = fopen('../config/cursoPrueba.php', 'w+');
      fwrite($conf, "<?php\n");
      fwrite($conf, "\n". "$" . "cursoPrueba" . " = " . $cursoActivar . ";");
      fwrite($conf, "\n" . "$" . "nombreCursoPrueba" . " = " . "'$nombreCursoActivar'" . ";"); 
      fclose($conf);
    }
    
  }
  
  
} // ./ end activar_curso($file)


//Funcion leer_alumnos($file), a partir de leer un archivo csv, inserta datos de alumnos
function leer_alumno($file, $curso) {
  
  global $servername, $username, $password, $dbname;    
  $conn = mysqli_connect($servername, $username, $password, $dbname);

  if (!$conn) {
    echo "Conexión fallada: " . mysqli_connect_error() . "<br>";
  } 

  $sql = "INSERT IGNORE INTO alumnos" . $curso . " VALUES ";
  $cabecerasEncontradas = FALSE; //fijamos el control de encontrar la cabecera

  while ($datos_alumno = fgetcsv($file, 0, ',', '"')) {  //leemos una lÃ­nea en formato csv

    if (!$cabecerasEncontradas) {
      
      if ($datos_alumno[0] == "Alumno/a") { // Cabecera encontrada
        $cabecerasEncontradas = TRUE;            
      }

    } elseif ($datos_alumno[0] != "") {//si !cabecerasEncontradas = FALSE y no vacío?
            
      $arrlength = count($datos_alumno);
      $sql .= "(";
      
      for ($x = 0; $x < $arrlength; $x++) {
        $var = $datos_alumno[$x];
        $sql .= "'$var'" . ", ";
      }
      
      $sql = substr($sql, 0, -2); //quitamos la coma y el espacio sobrantes
      $sql .= "),";// empezamos otro registro  
    }
  } // ./ end bucle while
  
  $sql = substr($sql, 0, -1);
  $sql .= ";";
  
  if (mysqli_query($conn, $sql)) {
    echo "Alumno insertado correctamente o ya existía" . "<br>";
  } else {
    echo "Error al insertar el alumno " . mysqli_error($conn) . "<br>";
  }
      
} // ./ end leer_alumno($file)

function listar_cursos() {
  
  global $servername, $username, $password, $dbname;
  $conn = mysqli_connect($servername, $username, $password, $dbname);
  
  $sql_cursos = "SELECT * FROM cursos";
  $cursos = array();
  $result_cursos = mysqli_query($conn, $sql_cursos);
  
  while ($row = mysqli_fetch_array($result_cursos, MYSQLI_ASSOC)) {
    $cursos[] = $row;
  }
  
  $html_cursos = "<select name='curso'>";
  
  
  foreach ($cursos as $value) {
    $curso = $value['id_curso'];
    $nombreCurso = $value['nombre_curso'];
  
    $html_cursos .= "<option value='$curso'>" . $nombreCurso . "</option>";
  }
  
  $html_cursos .= "</select>";
  echo $html_cursos;
          
}

function listar_asignaturas($curso, $multiple) {
  
   global $servername, $username, $password, $dbname;
  $conn = mysqli_connect($servername, $username, $password, $dbname);
  
        $sql_asignaturas = "SELECT id_asignatura FROM asignaturas" . $curso .
                " WHERE nombre_completo = '' OR nombre_completo IS NULL" .
                " UNION SELECT nombre_completo FROM asignaturas" . $curso .
                " WHERE nombre_completo IS NOT NULL AND nombre_completo <> ''";
        
        $asignaturas = array();
        
        $result_asignaturas = mysqli_query($conn, $sql_asignaturas);
        
                while ($row = mysqli_fetch_array($result_asignaturas, MYSQLI_ASSOC)) {
          $asignaturas[] = $row;
        }
         
        if ($multiple) {
                echo "<select name='asignatura[]' multiple>";
        } else {
          echo "<select name='asignatura[]'>";
        }
        foreach ($asignaturas as $value) {
          echo $value['id_asignatura'];
          echo "<option>" . $value['id_asignatura'] . "</option>";
        }
        echo "</select>";
        
}

function listar_graficos() {
  
  $graficos = array(
      "Spline Chart"=>"drawSplineChart", "Grafico de Barras"=>"drawBarChart",
      "Grafico de Área"=>"drawAreaChart", "Gráfico de líneas"=>"drawLineChart", 
      "Gráfico Spline relleno"=>"drawFilledSplineChart", "Gráfico de Puntos"=>"drawPlotChart",
      "Gráfido de Saltos relleno"=>"drawFilledStepChart", "Gráfido de barras Stacked"=>"drawStackedBarChart",
      "Gráfido de área stacked"=>"drawStackedAreaChart"
  );
  
  $html_graficos = "<select name='tipo'>";
  
  foreach ($graficos as $key => $value) {
    $html_graficos .= "<option value='$value'>" . $key . "</option>";
  }
  
  $html_graficos .= "</select>";
  
  echo $html_graficos;
      
      
}

function listar_paletas() {
  
  $paletas = array(
      "Defecto"=>"default", "Otoño"=>"autumn", "Ciega"=>"blind", 
      "Anochecer"=>"evening", "Cocina"=>"kitchen", "Armada"=>"navy", 
      "Sombras"=>"shade", "Primavera"=>"spring", "Verano"=>"summer", "Luminosa"=>"light"
  );
  
  $html_paletas = "<select name='paleta'>";
  
  foreach ($paletas as $key => $value) {
    $html_paletas .= "<option value='$value'>" . $key . "</option>";
  }
  
  $html_paletas .= "</select>";
  
  echo $html_paletas;
  
}

function listar_alumnos($curso, $multiple) {
  
  global $servername, $username, $password, $dbname;
  $conn = mysqli_connect($servername, $username, $password, $dbname);
  
          $sql_alumnos = "SELECT Alumnoa FROM alumnos" . $curso;

          $alumnos = array();
          
          $result_alumnos = mysqli_query($conn, $sql_alumnos);
          
                  while ($row = mysqli_fetch_array($result_alumnos, MYSQLI_ASSOC)) {
           $alumnos[] = $row;
        }
        if ($multiple) {
          echo "<select name='alumno' multiple>";
        } else {
          echo "<select name='alumno'>";
        }
  
        foreach($alumnos as $value) {
          echo "<option value='" . sanear_string($value['Alumnoa']) . "'>" . $value['Alumnoa'] . "</option>";
        }
        echo "</select>";
}


//Funcion notas($file), a partir de leer un archivo csv, cargar notas
function notas($file, $trimestre, $curso) {
  
  //echo "fopen('$file', 'r')";
  
  global $servername, $username, $password, $dbname;
  $conn = mysqli_connect($servername, $username, $password, $dbname);
  
  $sql_asignaturas = "INSERT IGNORE INTO asignaturas" . $curso . " (id_asignatura) VALUES ";
  
  $sql_notas = "INSERT IGNORE INTO notas" . $curso . " (N_Id_Escolar, Trimestre, id_asignatura, Nota) VALUES ";
  
  $asignatura = array();
  $cabecerasEncontradas = FALSE; //fijamos el control de encontrar la cabecera
  
  while ($datos = fgetcsv($file)) {  //lectura de lineas del csv
 
    if (!$cabecerasEncontradas) {

      if ($datos[0] === "Alumno/a") { // Cabecera encontrada
        
        $cabecerasEncontradas = TRUE;
        $arrlength = count($datos);

        for ($x = 1; $x < $arrlength; $x++) { // Coger los codigos de las asignaturas
          $var = $datos[$x];
          $asignatura[$x - 1] = $var;
          $sql_asignaturas .=  "('$var'),";
        }

        $sql_asignaturas = substr($sql_asignaturas, 0, -1); // quitamos la coma sobrante
        $sql_asignaturas .= ";";
        
        if (mysqli_query($conn, $sql_asignaturas)) {
          //echo "Las asignaturas se han insertado correctamente o ya existían<br>";
        } else {
          echo "Error al insertar las asignaturas: " . mysqli_error($conn) . "<br>";
        }

      } // ./ end cabecerasEncontradas
    } else { //si !cabecerasEncontradas = FALSE

      $arrlength = count($datos);
      
      for ($x = 0; $x < $arrlength; $x++) {
        
        $alumno = $datos[0];
        $sql_alumno = "SELECT N_Id_Escolar FROM alumnos" . $curso . 
                      " WHERE Alumnoa = " . "'$alumno'" . ";";
        
        $result = mysqli_query($conn, $sql_alumno);
        $row = mysqli_fetch_array($result, MYSQLI_NUM);
        $alumno = $row[0];  
        
        if ($x > 0) {
          $var = $datos[$x];
          $as = $asignatura[$x-1];
          if ($var) {
            $sql_notas .= "('$alumno', '$trimestre', '$as', '$var'),";
          }
        }
        
      } // ./ end bucle for
    } // ./ end else 
  } // ./ end bucle while
  
  $sql_notas = substr($sql_notas, 0, -1); // quitamos la coma sobrante
  $sql_notas .= ";";

  if (mysqli_query($conn, $sql_notas)) {
    //echo "Las notas se han insertado correctamente o ya existían<br>";
  } else {
    echo "Error al insertar las notas: " . mysqli_error($conn) . "<br>";
  }

} // ./ end notas($file)

?>