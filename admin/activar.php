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
  <?php echo $header;?>
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
      <h4>Activar un curso <small><em>Actualmente activo: <?php $curso = check_curso_db(true); echo $curso;?></em></small></h4> 
        <p>
          Este formulario permite definir un curso como activo a partir de la lectura de un archivo CSV. 
          El archivo CSV de Séneca debe contener al menos los datos de un alumno, ya que se utilizan esos 
          datos para la creación de las tablas en la base de datos y los formularios de registro de alumnos.
          <strong>Sólo se puede activar el curso leyendo datos de al menos un alumno.</strong>
        </p>
        <p>
          En cada momento sólo puede haber un curso definido como activo, pero se puede subir cualquier curso
          aunque luego no sea el activo, para seleccionar los datos para consultas y realizar históricos de gráficos.
        </p>
        <form class="form" role="form" method="post" enctype="multipart/form-data" action="admin/activar.php"  id="formularioCurso" name="formularioCurso">
          <div class="form-group">        
            <label for='curso'>Curso a activar:</label>
            <select id='curso' name='curso'>
              <option value="1314|2013-2014">2013-2014</option>
              <option value="1415|2014-2015">2014-2015</option>
              <option value="1516|2015-2016" selected>2015-2016</option>
              <option value="1617|2016-2017">2016-2017</option>
            </select> 
          </div>
          <div class="form-group">
            <label for='subircsv'>Subir el archivo csv</label>   
            <input type="file" name="subircsv"/>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-default" name="curso_csv" value="entrar">Subir</button>
          </div>
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
              
              $conn = mysqli_connect($servername, $username, $password, $dbname);
              $sql = "SELECT cursoActivo FROM conf WHERE installed = 1";
              $result = mysqli_query($conn, $sql);
              $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
              if ($row['cursoActivo'] == $cursoActivar) {
                echo "Ese curso ya está activado.";
              } else {
                $nombreCursoActivar = $cursos[1];
                activar_curso($archivo, $cursoActivar, $nombreCursoActivar);
              }
            }           
            
          }
        ?>
      </div> <!-- /. end div container-fluid with the form -->
    </div>
  </div> <!-- /. end div row -->
</div> <!-- /. end div container-fluid -->
  
<!-- Pie de página -->
<div class="container-fluid bg-4 text-center" id='foot01'></div>
<script src="script/script.js"></script>
</body>
</html>