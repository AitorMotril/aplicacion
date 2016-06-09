<?php
  include_once '../config/config.php';
  include_once '../funciones.php';
  protege("jefe" || "administrador");
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Jefe de estudios | eduGraph!</title>
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
  <h3 class="bg-3">Jefe de estudios</h3>
  <p>
    Realizar gráficos.
  </p>
</div>
    
<div class='container-fluid'>
  <form class="form-inline" role="form" method="post" enctype="multipart/form-data" action="jefe/graficos.php"  id="formularioCurso" name="formularioCurso">
    <div class="form-group">        
      <label for='subircsv'>Elegir el alumno para crear el gráfico</label> 
  <?php
  
    $sql = "SELECT Alumnoa FROM alumnos" . $cursoActivo;
    $sql_asignatura = "SELECT id_asignatura FROM asignaturas" . $cursoActivo;
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    
    $arrays = array();
    $arrays_a = array();
    $result = mysqli_query($conn, $sql);
    $result_a = mysqli_query($conn, $sql_asignatura);
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
       $arrays[] = $row;
    }
       
    while ($row2 = mysqli_fetch_array($result_a, MYSQLI_ASSOC)) {
      $arrays_a[] = $row2;
    }
     echo "<select name='alumno'>";
  // Use simple foreach to generate the options
  foreach($arrays as $value) {
    echo $value['Alumnoa'];
    echo "<option>" . $value['Alumnoa'] . "</option>";
   }
   echo "</select>";
   
   echo "<select name='asignatura'>";
   foreach ($arrays_a as $value2) {
     echo $value2['id_asignatura'];
     echo "<option>" . $value2['id_asignatura'] . "</option>";
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
            $result = mysqli_query($conn, $sql_alumno);
            $row = mysqli_fetch_array($result, MYSQLI_NUM);
            $alumnof = $row[0];  
            
            $sql = "SELECT * FROM notas" . $cursoActivo . " WHERE N_Id_Escolar = $alumnof 
              AND id_asignatura = '$asignatura';";
            $result2 = mysqli_query($conn, $sql);
            
            $arrays_n[] = array();
         while ($notas = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
           $arrays_n[] = $notas;
        }
            
         echo "<img src='pChart/grafico1.php?Seed=0.9&dibujo=$tipo&asignatura=$asignatura&alumno=$alumno&notas=$arrays_n[Notas]'>";
            
      }
  ?>
  
</div>
<!-- Pie de página -->
<div class="container-fluid bg-4 text-center" id='foot01'></div>
<script src="script/javascript.js"></script>
</body>
</html>