<?php
  include_once '../config/config.php';
  include_once '../funciones.php';
  check_install();
  protege("administrador");
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Gestión de cursos | eduGraph!</title>
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
  <h3 class="bg-3">Gestión de cursos</h3>
  <div class="row">
    <div class="col-md-2">
      <div class="list-group" id="sidebar">
        <a href='admin/admin.php' class="list-group-item">Principal administrador</a>
        <a href='admin/prueba.php' class="list-group-item">Activar curso de prueba</a>
        <a href="admin/activar.php" class="list-group-item active">Activar un curso</a>
      </div>
    </div>
    <div class="col-md-10">
      <div class="container-fluid well well-sm">
      <h4>Activar un curso</h4> 
        <form class="form-inline" role="form" method="post" enctype="multipart/form-data" action="admin/activar.php"  id="formularioCurso" name="formularioCurso">
          <div class="form-group">        
            <label for='curso'>Curso a activar:</label>
            <select id='curso' name='curso'>
              <option value="1516|2015-2016">2015-2016</option>
              <option value="1617|2016-2017">2016-2017</option>
            </select> 
            <label for='subircsv'>Subir el archivo csv para crear las tablas</label>   
            <input type="file" class="form-control" name="subircsv"/>
          </div>
          <button type="submit" class="btn btn-default" name="curso_csv" value="entrar">Subir</button>
        </form> <!-- /.end form, php call to activar_curso -->
        <?php
          if (isset($_POST["curso_csv"]) && isset($_FILES["subircsv"])) {
            
            if (!$_FILES["subircsv"]["tmp_name"]) {
              $error = "El archivo no llegó al servidor.";
              echo $error;
            } 
        
            if ($archivo = fopen($_FILES["subircsv"]["tmp_name"], "r")) {
              $cursos = explode('|', $_POST['curso']);
              $cursoActivar = $cursos[0];
              $nombreCursoActivar = $cursos[1];
              activar_curso($archivo, $cursoActivar, $nombreCursoActivar);      
            }           
            
          }
        ?>
      </div> <!-- /. end div container-fluid with the form -->
    </div>
  </div> <!-- /. end div row -->
</div> <!-- /. end div container-fluid -->
  
<!-- Pie de página -->
<div class="container-fluid bg-4 text-center" id='foot01'></div>
<script src="script/javascript.js"></script>
</body>
</html>