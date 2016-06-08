<?php
  include_once '../config/config.php';
  include_once '../funciones.php';
  protege("jefe" || "administrador");
  


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

<!-- Cabecera de la página y texto -->
<div class="container-fluid">
  <h3 class="bg-3">Gestión de notas y estadísticas</h3>
</div>

<div class='container-fluid'>
  <form class="form-inline" role="form" method="post" enctype="multipart/form-data" action="jefe/estadisticas.php"  id="formularioCurso" name="formularioCurso">
    <div class="form-group">        
      <label for='subircsv'>Subir el archivo csv para crear las estadísticas</label>   
      <input type="file" class="form-control" name="notascsv"/>
    </div>
    <button type="submit" class="btn btn-default" name="notas_csv" value="entrar">Subir</button>
  </form>
  <?php
    if (isset($_POST["notas_csv"]) && isset($_FILES["notascsv"])) {
                
      if (!$_FILES["notascsv"]["tmp_name"]){
        $error = "El archivo no llegó al servidor.";
        echo $error;
      } 
        
      if (($archivo = fopen($_FILES["notascsv"]["tmp_name"], "r")) !== FALSE) {
        estadisticas($archivo);      
      }
    }
  ?>
</div>

<!-- Pie de página -->
<div class="container-fluid bg-4 text-center" id='foot01'></div>
<script src="script/javascript.js"></script>
</body>     
</html>