<?php
include_once 'config/config.php';

// Funcion protege($rol), Crea la sesion o la propaga y verificar las variables de sesion
function protege($rol) {
  
    global $urlbase;
    session_start();
    if($_SESSION['validar'] != "1" || $_SESSION['rol'] != $rol) {
        session_destroy();
        header("Location: " . $urlbase . "index.php?usererror=si");
    }
    
}


//Funcion check_install(), para ver si ya está instalada o no y mostrar en el menú
function check_install() {
  global $instalar;
  if ($instalar == 1) {
    echo "
          <script>
            $(document).ready(function() {
              $('#instalar_menu').hide();
            }); 
          </script>
        ";
  }
}


// Funcion sanear_string($string), convierte un string cualquiera en texto "sano" para entrar en la base de datos
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
  
  if ($_GET[error] == "si") {
    if ($_GET[formularioerror] == "si") {
      echo "<div class='alert alert-danger'>"
      . "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>"
      . "Rellena el formulario.</div>";
    } else {
      echo "<div class='alert alert-danger'>"
      . "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>"
      . "Verifica tus datos.</div>";
    }
  }
  if ($_GET[usererror] == "si") {
    echo "<div class='alert alert-danger'>"
    . "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>"
    . "No tienes permiso suficiente para acceder a esa página.</div>";
  }
  
} // ./ end error_form()


// Funcion activar_curso($file), a partir de leer un archivo csv, activa un curso
function activar_curso($file) {
  
  global $servername, $username, $password, $dbname, $cursoActivo;
  $datos = fgetcsv($file, 0, ',', '"');
  $arrlength = count($datos);
  $conn = mysqli_connect($servername, $username, $password, $dbname);
  
  // Variable de activación del curso, salta a cero si hay algún error
  $activar = 1;
  
  // Crear tabla de alumnos
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
    $activar = 0;
    echo "Error al crear la tabla alumnos: " . mysqli_error($conn) . "<br>";
  }
  
  // Crear tabla de cabeceras
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
    $activar = 0;
    echo "Error al crear la tabla cabecera: " . mysqli_error($conn) . "<br>";
  }

  // Crear tabla de asignaturas
  $sql = "CREATE TABLE IF NOT EXISTS asignaturas" . $cursoActivo . " ( "
          . "id_asignatura VARCHAR(10) NOT NULL PRIMARY KEY) ENGINE=InnoDB;";

  if (mysqli_query($conn, $sql)) {
    echo "La tabla asignaturas" . $cursoActivo . " se ha creado correctamente o ya existía" . "<br>";
  } else {
    $activar = 0;
    echo "Error al crear la tabla asignaturas: " . mysqli_error($conn) . "<br>";
  }

  // Crear tabla de notas
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
    $activar = 0;
    echo "Error al crear la tabla notas: " . mysqli_error($conn) . "<br>";
  }      

  // Insertar datos sin sanear en la tabla de cabeceras
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
      $activar = 0;
      echo "Error al insertar los datos de las cabeceras: " . $cursoActivo . mysqli_error($conn) . "<br>";
    }
  } // ./ end INSERT INTO cabecera
  
  if ($activar == 0) {
    echo "El curso no se ha activado correctamente" . "<br>";
  } else {
    echo "Curso activado correctamente" . "<br>";
  }

  echo "<a href='index.php'>Volver al índice</a>";
  
} // ./ end activar_curso($file)


//Funcion leer_alumnos($file), a partir de leer un archivo csv, inserta datos de alumnos
function leer_alumno($file) {
  
  global $servername, $username, $password, $dbname, $cursoActivo;    
  $conn = mysqli_connect($servername, $username, $password, $dbname);

  if (!$conn) {
    echo "Conexión fallada: " . mysqli_connect_error() . "<br>";
  } else {
    echo "Conexión realizada" . "<br>";
  }

  $sql = "INSERT IGNORE INTO alumnos" . $cursoActivo . " VALUES (";

  $cabecerasEncontradas = FALSE; //fijamos el control de encontrar la cabecera

  while ($datos = fgetcsv($file)) {  //leemos una lÃ­nea en formato csv

    if (!$cabecerasEncontradas) {

      if ($datos[0] == "Alumno/a") { // Cabecera encontrada
        $cabecerasEncontradas = TRUE;            
      }

    } else if ($datos[0] != "") {//si !cabecerasEncontradas = FALSE y no vacío?

      $arrlength = count($datos);

      for ($x = 0; $x < $arrlength; $x++) {
        $var = $datos[$x];
        $sql .= "'$var'" . ", ";
      }
    }

  } // ./ end bloque while
        
  $sql = substr($sql, 0, -2); //quitamos la coma y el espacio sobrantes
  $sql .= ");";// empezamos otro registro  

  if (mysqli_query($conn, $sql)) {
    echo "Alumno insertado correctamente o ya existía" . "<br>";
  } else {
    echo "Error al insertar el alumno " . mysqli_error($conn) . "<br>";
  }
      
} // ./ end leer_alumno($file)


//Funcion notas($file), a partir de leer un archivo csv, cargar notas
function notas($file) {

  global $servername, $username, $password, $dbname, $cursoActivo;
  $conn = mysqli_connect($servername, $username, $password, $dbname);
  
  $cabecerasEncontradas = FALSE; //fijamos el control de encontrar la cabecera
  $sql_asignaturas = "INSERT IGNORE INTO asignaturas" . $cursoActivo . " VALUES ";
  $sql_notas = "INSERT IGNORE INTO notas" . $cursoActivo . " (N_Id_Escolar, Trimestre, id_asignatura, Nota) VALUES ";
  $asignatura = array();
  $trimestre = 2;
  
  while ($datos = fgetcsv($file)) {  //lectura de lineas del csv
 
    if (!$cabecerasEncontradas) {

      if ($datos[0] == "Alumno/a") { // Cabecera encontrada
        
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
          echo "Las asignaturas se han insertado correctamente o ya existían<br>";
        } else {
          echo "Error al insertar las asignaturas: " . mysqli_error($conn) . "<br>";
        }

      } // ./ end cabecerasEncontradas
    } else { //si !cabecerasEncontradas = FALSE

      $arrlength = count($datos);
      
      for ($x = 0; $x < $arrlength; $x++) {
        
        $alumno = $datos[0];
        $sql_alumno = "SELECT N_Id_Escolar FROM alumnos" . $cursoActivo . 
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
    echo "Las notas se han insertado correctamente o ya existían<br>";
  } else {
    echo "Error al insertar las notas: " . mysqli_error($conn) . "<br>";
  }

} // ./ end notas($file)

?>