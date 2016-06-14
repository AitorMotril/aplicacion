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
  <title>Gestión de asignaturas | eduGraph!</title>
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
  <h3 class="bg-3">Gestión de asignaturas</h3>
  <div class="row">
        <div class="col-md-2">
      <div class="list-group" id="sidebar">
        <a href='jefe/notas.php' class="list-group-item">Principal jefe de estudios</a>
        <a href='jefe/notas.php' class="list-group-item">Subir notas</a>
        <a href="jefe/graficos.php" class="list-group-item">Crear gráficos</a>
        <a href="jefe/asignaturas.php" class="list-group-item active">Gestión de asignaturas</a>
      </div>
    </div>
  
  <div class="col-md-10">  
  <p>
    Gestionar las asignaturas existentes para curso, añadirles nombre completo así como áreas competenciales
  </p>
    <form class="form-inline" role="form" method="post" enctype="multipart/form-data" action="jefe/asignaturas.php"  id="formularioCurso" name="formularioAsignaturas">
    <div class="form-group">        
      <label for='subircsv'>Elegir una asignatura para actualizar</label> 
  <?php
  
    $sql_asignatura = "SELECT id_asignatura FROM asignaturas" . $cursoActivo;
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    
    $arrays_a = array();
    $result_a = mysqli_query($conn, $sql_asignatura);
       
    while ($row2 = mysqli_fetch_array($result_a, MYSQLI_ASSOC)) {
      $arrays_a[] = $row2;
    }
   
   echo "<select name='asignatura2'>";
   foreach ($arrays_a as $value2) {
     echo $value2['id_asignatura'];
     echo "<option>" . $value2['id_asignatura'] . "</option>";
   }
   echo "</select>";
   
   ?>
      <input type="text" name="nombre_completo" placeholder="Nombre completo de la asignatura"/>
      <input type="text" name="area_competencial" placeholder="Area competencial de la asignatura"/>
    </div>
    <button type="submit" class="btn btn-default" name="grafico" value="entrar">Subir</button>
  </form>
        <?php
    if (isset($_POST["grafico"])) {
            $asignatura2 = $_POST['asignatura2'];
            $nombre_completo = $_POST['nombre_completo'];
            $area_competencial = $_POST['area_competencial'];
            $sql_asig = "UPDATE asignaturas" . $cursoActivo . " SET nombre_completo = " 
                    . "'$nombre_completo'" . ", area_competencial = " . "'$area_competencial'" 
                      . " WHERE asignaturas" .  $cursoActivo . ".id_asignatura = " . "'$asignatura2'" . ";";
         
            $result = mysqli_query($conn, $sql_asig);

        if (mysqli_query($conn, $sql_asig)) {
          echo "La asignatura se ha actualizado correctamente<br>";
        } else {
          echo "Error al insertar los datos de la asignatura: " . mysqli_error($conn) . "<br>";
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