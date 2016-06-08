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
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    
    $arrays = array();
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
      array_push($arrays, $row);
    }

    ?>

    <?php
     echo "<select>";
  // Use simple foreach to generate the options
  foreach($arrays as $key => $value) {
    echo "<option value=' $key '> $value </option>";
   }
   echo "</select>";
   ?>
      <input type="text" name="alumno" class="form-control" id="loginid" placeholder="Usuario" required />
<input type="text" name="asignatura" class="form-control" id="asignaturaid" placeholder="Usuario" required />
<input type="text" name="tipo" class="form-control" id="tipograficoid" placeholder="Usuario" required />    
    </div>
    <button type="submit" class="btn btn-default" name="grafico" value="entrar">Subir</button>
  </form>
        <?php
    if (isset($_POST["grafico"])) {
            $alumno = $_POST['alumno'];
            $tipo = $_POST['tipo'];
            echo $alumno;
            $asignatura = $_POST['asignatura'];
            $sql = "SELECT * FROM notas" . $cursoActivo . " WHERE N_Id_Escolar = $alumno 
              AND id_asignatura = '$asignatura';";
            echo $sql;
            $result = mysqli_query($conn, $sql);
         while ($notas = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            print_r($notas);
            print_r($notas['Trimestre']);

         }
         echo $alumno;
         echo "<img src='pChart/grafico1.php?Seed=0.9&dibujo=$tipo&leyenda1=$asignatura&title=$alumno'>";
            
      }
  ?>
  
</div>
<!-- Pie de página -->
<div class="container-fluid bg-4 text-center" id='foot01'></div>
<script src="script/javascript.js"></script>
</body>
</html>