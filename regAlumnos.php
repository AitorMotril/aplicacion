<?php
    include_once 'config/config.php';
    include_once 'funciones.php';
    protege("jefe" || "administrador");
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Registro de alumnos | eduGraph!</title>
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

<!-- Cabecera de la página y texto -->
<div class="container-fluid">
  <h3 class="bg-3">Registro de Alumnos</h3>
  <p>
    Formulario para el registro de alumnos
  </p>
  <div class="container-fluid">
    <form class="form-inline" role="form" name="regAlumnos" method="POST" onsubmit="return validar();">
      <?php
      
        function leer_cabeceras() {
          
          global $servername, $username, $password, $dbname, $cursoActivo;
          
          $conn = mysqli_connect($servername, $username, $password, $dbname);
          $sql = "SELECT * FROM cabecera" . $cursoActivo;
          $result = mysqli_query($conn, $sql);
          
          $row = mysqli_fetch_array($result, MYSQLI_NUM);
          $arrlength = count($row);
          
          for ($x = 0; $x < $arrlength; $x++) {
            $var = $row[$x];
            echo 
                "<div class='form-group'>" .
                "<label class='text-left'>" . $var . "</label>" .
                "<input type='text' class='form-control' /></div>"
            ;
          }
        }
        
        leer_cabeceras();
      ?>
        </form>
      <form name="subircsv" method="POST" enctype="multipart/form-data" action="regAlumnos.php">
      <label>Subir desde un archivo csv <input type="file" name="csvalumnos" /></label><br>
      <input type="submit" value="registro" name="alumnos_csv" />
      </form>
      <?php
    if (isset($_POST["alumnos_csv"]) && isset($_FILES["csvalumnos"])) {
                
      if (!$_FILES["csvalumnos"]["tmp_name"]){
        $error = "El archivo no llegó al servidor.";
        echo $error;
      } 
        
      if (($archivo = fopen($_FILES["csvalumnos"]["tmp_name"], "r")) !== FALSE) {
        leer_alumno($archivo);      
      }
    }
  ?>
  </div>
</div>

<!-- Pie de página -->
<div class="container-fluid bg-4 text-center" id='foot01'></div>
<script src="script/javascript.js"></script>
</body>
</html>