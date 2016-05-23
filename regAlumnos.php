<?php
    include_once 'config/config.php';
    include_once 'funciones.php';
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
  <h3 class="bg-3">Registro de Alumnos</h3>
  <p>
    Formulario para el registro de alumnos
  </p>
</div>

<div class="container-fluid">
  <form class="form-horizontal" role="form" name="regAlumnos" method="POST" onsubmit="return validar();">
      <?php
          $conn = mysqli_connect($servername, $username, $password, $dbname);
          $sql = "SELECT * FROM cabecera" . $cursoActivo;
          $result = mysqli_query($conn, $sql);
          $row = mysqli_fetch_array($result, MYSQLI_NUM);
          $arrlength = count($row);
          for ($x = 0; $x < $arrlength; $x++) {
              $var = $row[$x];
              echo "<div class='form-group'>" .
                   "<label class='control-label col-sm-2 text-left'>" . $var . "</label>" .
                   "<div class='col-sm-10'>" .
                   "<input type='text' class='form-control' /></div></div>";
          }
      ?>
      <form name="subircsv" method="POST" enctype="multipart/form-data" action="readcsv.php">
      <label>Subir desde un archivo csv <input type="file" name="subircsv" /></label><br>
      <input type="submit" value="registro" />
      <?php echo $_POST["subircsv"];?>
  </form>
</div>

<!-- Pie de página -->
<div class="container-fluid bg-4 text-center" id='foot01'></div>
<script src="/eduGraph/script/javascript.js"></script>
</body>
</html>
