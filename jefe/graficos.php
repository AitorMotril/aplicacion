<?php
  include_once '../config/config.php';
  include_once '../funciones.php';
  protege("jefe" || "administrador");
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Gráficos | eduGraph!</title>
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
  <h3 class="bg-3">Jefe de estudios - Gráficos</h3>
      <div class="row">
    <div class="col-md-2">
      <div class="list-group" id="sidebar">
        <a href='jefe/jefe.php' class="list-group-item">Principal jefe de estudios</a>
        <a href='jefe/notas.php' class="list-group-item">Subir notas</a>
        <a href="jefe/graficos.php" class="list-group-item active">Crear gráficos</a>
        <a href="jefe/asignaturas.php" class="list-group-item">Gestión de asignaturas</a>
      </div>
    </div>
        <div class="col-md-10">  
                  <div class="container-fluid well well-sm">
    <h4>Notas de un alumno para una o varias asignaturas</h4> 
    <form class="form-inline" role="form" method="post" enctype="multipart/form-data" action="jefe/graficos.php"  id="formularioPorAlumnos" name="formularioPorAlumnos">
    <div class="form-group">        
      <label for='subircsv'>Elegir el alumno para crear el gráfico</label> 
      <?php
        $sql_alumnos = "SELECT Alumnoa FROM alumnos" . $cursoActivo;
        $sql_asignaturas = "SELECT id_asignatura FROM asignaturas" . $cursoActivo .
                " WHERE nombre_completo = '' OR nombre_completo IS NULL" .
                " UNION SELECT nombre_completo FROM asignaturas" . $cursoActivo .
                " WHERE nombre_completo IS NOT NULL AND nombre_completo <> ''";
                
        $conn = mysqli_connect($servername, $username, $password, $dbname);

        $alumnos = array();
        $asignaturas = array();
        $result_alumnos = mysqli_query($conn, $sql_alumnos);
        $result_asignaturas = mysqli_query($conn, $sql_asignaturas);

        while ($row = mysqli_fetch_array($result_alumnos, MYSQLI_ASSOC)) {
           $alumnos[] = $row;
        }

        while ($row = mysqli_fetch_array($result_asignaturas, MYSQLI_ASSOC)) {
          $asignaturas[] = $row;
        }

        echo "<select name='alumno'>";
        foreach($alumnos as $value) {
          echo $value['Alumnoa'];
          echo "<option>" . $value['Alumnoa'] . "</option>";
        }
        echo "</select>";

        echo "<select name='asignatura'>";
        foreach ($asignaturas as $value) {
          echo $value['id_asignatura'];
          echo "<option>" . $value['id_asignatura'] . "</option>";
        }
        echo "</select>";

     ?>
     <select name="tipo">
     <option value="drawSplineChart">drawSplineChart</option>
      <option value="drawBarChart">drawBarChart</option>
      <option value="drawAreaChart">drawAreaChart</option>
      <option value="drawLineChart">drawLineChart</option>
     </select>
    </div>
    <input type="checkbox" name="trimestre1" value="trimestre1"/>Primer Trimestre
    <input type="checkbox" name="trimestre2" value="trimestre2"/>Segundo Trimestre
    <input type="checkbox" name="trimestre3" value="trimestre3"/>Tercer Trimestre
    <button type="submit" class="btn btn-default" name="grafico" value="entrar">Subir</button>
  </form>
  
  <?php
    if (isset($_POST["grafico"])) {
      
      $alumno = $_POST['alumno'];
      $tipo = $_POST['tipo'];
      $asignatura = $_POST['asignatura'];

      $sql_alumno = "SELECT N_Id_Escolar FROM alumnos" . $cursoActivo . 
                " WHERE Alumnoa = " . "'$alumno'" . ";";
      $result_alumno = mysqli_query($conn, $sql_alumno);
      $row = mysqli_fetch_array($result_alumno, MYSQLI_NUM);
      $alumnof = $row[0];  

      $sql = "SELECT * FROM notas" . $cursoActivo . " WHERE N_Id_Escolar = $alumnof 
        AND id_asignatura = '$asignatura';";
      $result = mysqli_query($conn, $sql);

      $notas[] = array();
      while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $notas[] = $row;
      }
      
      print_r($notas);

      echo "<img src='pChart/grafico1.php?Seed=0.9&dibujo=$tipo&asignatura=$asignatura&alumno=$alumnof'>";

    }
  ?>
</div>
          <div class="container-fluid well well-sm">
            <h4>Notas para una asignatura de varios alumnos o grupos</h4> 
            <form class="form-inline" role="form" method="post" enctype="multipart/form-data" action="jefe/graficos.php"  id="formularioPorAsignaturas" name="formularioPorAsignaturas">
    <div class="form-group">        
      <label>Seleccionar la asignatura y los alumnos</label> 
      <?php
        $sql_asignaturas = "SELECT id_asignatura FROM asignaturas" . $cursoActivo .
                " WHERE nombre_completo = '' OR nombre_completo IS NULL" .
                " UNION SELECT nombre_completo FROM asignaturas" . $cursoActivo .
                " WHERE nombre_completo IS NOT NULL AND nombre_completo <> ''";
        $sql_alumnos = "SELECT Alumnoa FROM alumnos" . $cursoActivo;
        $conn = mysqli_connect($servername, $username, $password, $dbname);

        $asignaturas = array();
        $alumnos = array();
        $result_asignaturas = mysqli_query($conn, $sql_asignaturas);
        $result_alumnos = mysqli_query($conn, $sql_alumnos);
        
        while ($row = mysqli_fetch_array($result_asignaturas, MYSQLI_ASSOC)) {
          $asignaturas[] = $row;
        }

        while ($row = mysqli_fetch_array($result_alumnos, MYSQLI_ASSOC)) {
           $alumnos[] = $row;
        }

        echo "<select name='asignatura[]' multiple>";
        foreach ($asignaturas as $value) {
          echo $value['id_asignatura'];
          echo "<option>" . $value['id_asignatura'] . "</option>";
        }
        echo "</select>";

        echo "<select name='alumno'>";
        foreach($alumnos as $value) {
          echo $value['Alumnoa'];
          echo "<option>" . $value['Alumnoa'] . "</option>";
        }
        echo "</select>";
     ?>
     <select name="tipo">
     <option value="drawSplineChart">drawSplineChart</option>
      <option value="drawBarChart">drawBarChart</option>
      <option value="drawAreaChart">drawAreaChart</option>
      <option value="drawLineChart">drawLineChart</option>
      <option value="drawFilledSplineChart">drawFilledSplineChart</option>
      <option value="drawPlotChart">drawPlotChart</option>
      <option value="drawFilledStepChart">drawFilledStepChart</option>
      <option value="drawStackedBarChart">drawStackedBarChart</option>
      <option value="drawStackedAreaChart">drawStackedAreaChart</option>
      <option value="drawPlotChart">drawPlotChart</option>
     </select>
      <select name="paleta">
        <option value="default">default</option>
        <option value="autumn">autumn</option>
        <option value="blind">blind</option>
        <option value="evening">evening</option>
        <option value="kitchen">Kitchen</option>
        <option value="navy">Navy</option>
        <option value="shade">Shade</option>
        <option value="spring">Spring</option>
        <option value="summer">Summer</option>
        <option value="light">Light</option>
      </select>
      <select name='g_gradient_direction'><option value='vertical'>Vertical</option><option value='horizontal'>Horizontal</option></select>
    </div>
    Gradiente sí o no <input type='checkbox' name='g_gradient_enabled' checked='checked' /></td>
    Gradiente 1 <input name='g_gradient_start' type="color" value="#ff0000"/>
    Gradiente 2 <input name='g_gradient_end' type="color" value="#ff0000"/>
              
    <input type="checkbox" name="trimestre1" value="trimestre1"/>Primer Trimestre
    <input type="checkbox" name="trimestre2" value="trimestre2"/>Segundo Trimestre
    <input type="checkbox" name="trimestre3" value="trimestre3"/>Tercer Trimestre
    <input type='text' name='g_width' value='700'/>
    <input type='text' name='g_height' value='230' >
    <button type="submit" class="btn btn-default" name="grafico2" value="entrar">Subir</button>
  </form>
  
  <?php
    if (isset($_POST["grafico2"])) {
       
      $_SESSION['tmp']=array();
      $_SESSION['tmp']['alumno']=$_POST['alumno'];
      $alumno = $_POST['alumno'];
      $tipo = $_POST['tipo'];
      //$asignatura = $_POST['asignatura'];
      $_SESSION['tmp']['asignatura']=$_POST['asignatura'];
      $paleta = $_POST['paleta'];
      $g_gradient_enabled = $_POST['g_gradient_enabled'];
      $g_gradient_end = $_POST['g_gradient_end'];
      $g_gradient_start = $_POST['g_gradient_start'];
      $g_gradient_direction = $_POST['g_gradient_direction'];
      $g_height = $_POST['g_height'];
      $g_width = $_POST['g_width'];
      $g_horizontal = $_POST['g_horizontal']; 
      
            $sql_alumno = "SELECT N_Id_Escolar FROM alumnos" . $cursoActivo . 
                " WHERE Alumnoa = " . "'$alumno'" . ";";
      $result_alumno = mysqli_query($conn, $sql_alumno);
      $row = mysqli_fetch_array($result_alumno, MYSQLI_NUM);
      $alumnof = $row[0];  
  

//$sql = "SELECT Nota FROM notas" . $cursoActivo . " WHERE N_Id_Escolar = $alumnof 
//        AND id_asignatura = '$asignatura';";
//$result = mysqli_query($conn, $sql) or die("Error en el sql");
//echo $sql;

//$notas = mysqli_fetch_all($result, MYSQL_ASSOC);
// while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
//    $notas[] = $row[0];
//}

//$array1 = $notas;
  
      echo "<a href='pChart/grafico1.php?Seed=0.9&dibujo=$tipo&alumno=$alumnof&paleta=$paleta"
              . "&g_gradient_enabled=$g_gradient_enabled&g_gradient_end=$g_gradient_end&g_gradient_start=$g_gradient_start"
              . "&g_gradient_direction=$g_gradient_direction&g_width=$g_width&g_height=$g_height'>Grafico1</a>";
      
          //  echo "<img src='pChart/grafico5.php?Seed=0.9&dibujo=$tipo&asignatura=$asignatura&alumno=$alumno&paleta=$paleta'>";
      
      echo "<img src='pChart/grafico1.php?Seed=0.9&dibujo=$tipo&alumno=$alumnof&paleta=$paleta"
              . "&g_gradient_enabled=$g_gradient_enabled&g_gradient_end=$g_gradient_end&g_gradient_start=$g_gradient_start"
              . "&g_gradient_direction=$g_gradient_direction&g_width=$g_width&g_height=$g_height'>";

    }
  ?>
          </div>
      </div>
</div>
</div>

    




<!-- Pie de página -->
<div class="container-fluid bg-4 text-center" id='foot01'></div>
<script src="script/javascript.js"></script>
</body>
</html>