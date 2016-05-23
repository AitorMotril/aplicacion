<?php
function protege($rol) {
    //Crea la sesion o la propaga y verificar las variables de sesion
    session_start();
    if($_SESSION['validar'] != "1" || $_SESSION['rol'] != $rol) {
        session_destroy();
        header("Location: /eduGraph/index.php?usererror=si");
    }
}

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
}

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
}

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
}
?>