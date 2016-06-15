<?php
  include_once '../config/config.php';
  include_once '../funciones.php';
  check_install();
  protege("jefe" || "administrador");
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Gestión de notas | eduGraph!</title>
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
    <div class="row">
    <div class="col-md-2">
      <div class="list-group" id="sidebar">
        <a href='jefe/jefe.php' class="list-group-item">Principal jefe de estudios</a>
        <a href='jefe/notas.php' class="list-group-item active">Subir notas</a>
        <a href="jefe/graficos.php" class="list-group-item">Crear gráficos</a>
        <a href="jefe/asignaturas.php" class="list-group-item">Gestión de asignaturas</a>
      </div>
    </div>
    <div class="col-md-10">  
                        <div class="container-fluid well well-sm">
    <h4>Subir notas</h4> 
    <p>
      Lee un archivo CSV de notas de Séneca. Crea automáticamente las asignaturas que 
      no existan todavía en la base de datos, en la forma abreviada en que Séneca las provee.
      Posteriormente el jefe de estudios podrá añadirle un nombre completo y un área competencial.<br>
      Los alumnos cuyas notas se están subiendo deben estar previamente en la base de datos, 
      mediante el <a href='regAlumnos.php'>formulario de registro</a> de alumnos.
    </p>
    <form role="form" method="post" enctype="multipart/form-data" action="jefe/notas.php"  name="formularioCurso">
      <div class="form-group">
                      <?php
              listar_cursos();
              ?>
      </div>
      <div class="form-group">
        <input list="evaluaciones" placeholder="Evaluación"/>

        <datalist id="evaluaciones">
          <option value="1">Primer Trimestre</option>
          <option value="2">Segundo Trimestre</option>
          <option value="3">Tercer Trimestre</option>
        </datalist>
      </div>
      <div class="form-group">        
        <label for='notascsv'>Subir el archivo csv para cargar las notas</label>   
        <input type="file" name="notascsv"/>
      </div>
      <div class='form-group'>
      <button type="submit" class="btn btn-default" name="notas_csv" value="entrar">Subir</button>
      </div>
    </form>
  <?php
    if (isset($_POST["notas_csv"]) && isset($_FILES["notascsv"])) {
                
      if (!$_FILES["notascsv"]["tmp_name"]){
        $error = "El archivo no llegó al servidor.";
        echo $error;
      } 
        
      if (($archivo = fopen($_FILES["notascsv"]["tmp_name"], "r")) !== FALSE) {
        notas($archivo);      
      }
    }
  ?>
    </div>
</div>
</div>


<!-- Pie de página -->
<div class="container-fluid bg-4 text-center" id='foot01'></div>
<script src="script/javascript.js"></script>
</body>     
</html>
