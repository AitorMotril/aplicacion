<?php
include_once '../config/config.php';
include_once '../funciones.php';
include("../pChart/class/pData.class.php");
include("../pChart/class/pDraw.class.php");
include("../pChart/class/pImage.class.php");
protege("jefe" || "administrador");
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>Título aplicación</title>
    <base href='<?php echo $urlbase; ?>' target='_self'>
    <?php echo $header; ?>
    <style>
      th, td {
    padding: 2px;
}
    </style>
  </head>
  <body id="page-top">
    <script type="text/javascript">
function fetch_asignaturas2(val)
{
   $.ajax({
     type: 'post',
     url: 'jefe/fetch_asignaturas.php',
     data: {
       get_option:val
     },
     success: function (response) {
       document.getElementById("asignaturas_select2").innerHTML+=response; 
     }
   });
}
function fetch_alumnos2(val)
{
   $.ajax({
     type: 'post',
     url: 'jefe/fetch_alumnos.php',
     data: {
       get_option:val
     },
     success: function (response) {
       document.getElementById("alumnos_select2").innerHTML+=response; 
     }
   });
}
</script>

    <!-- Cabecera con la imagen de logo y el lema de la página -->
    <div class="container-fluid clearfix" id="toplogo"></div>

    <!-- Menú superior de navegación fijo -->
    <nav class="navbar navbar-inverse" data-spy="affix" data-offset-top="77" id="nav01"></nav>

    <!-- Cabecera de la página y texto -->
    <div class="container-fluid">
      <h3 class="bg-3">Estadísticas <small><em>En construcción</em></small></h3>
        <div class="row">
    <div class="col-md-2">
      <div class="list-group" id="sidebar">
        <a href='jefe/jefe.php' class="list-group-item">Principal jefe de estudios</a>
        <a href="jefe/regAlumnos.php" class="list-group-item">Registrar alumnos</a>
        <a href='jefe/notas.php' class="list-group-item">Subir notas</a>
        <a href="jefe/graficos.php" class="list-group-item">Crear gráficos</a>
        <a href="jefe/asignaturas.php" class="list-group-item">Gestión de asignaturas</a>
        <a href='jefe/estadisticas.php' class="list-group-item active">Estadísticas</a>
      </div>
    </div>
              <div class="col-md-10">
      <div class="container-fluid well well-sm">
              <h4>Estadísticas</h4> 
      <p>
        Ver Estadísticas sobre las notas de los alumnos. Por el momento muestra
        la media, desviación típica, mediana y nota máxima.
      </p>
              <form class="form" role="form" method="post" enctype="multipart/form-data" action="jefe/estadisticas.php" id="estadisticas">
          <div class="form-group">        
            <label>Elegir la asignatura y los alumnos</label> 
            <select name='curso3' onchange='fetch_asignaturas2(this.value);fetch_alumnos2(this.value);'>
              <?php
                listar_cursos();
              ?>
            </select>

            <select id='asignaturas_select2' name='asignatura3'> 
              <option>Elegir la asignatura</option>
            </select>
                        <select id='alumnos_select2' name='alumnos3[]' multiple size='2'>
              <option>Elegir los alumnos</option>
            </select>
            <button type="submit" class="btn btn-default" name="estadisticas" value="entrar">Subir</button>
          </div>  
                        </form>
      <div id="resultado">
        
      </div>
              <?php
          if (isset($_POST["estadisticas"])) {
       
          $_SESSION['tmp3']=array();
          $_SESSION['tmp3']['asignatura3'] = $_POST['asignatura3'];
          $_SESSION['tmp3']['curso3'] = $_POST['curso3'];
          $_SESSION['tmp3']['alumnos3']=$_POST['alumnos3'];
              $asignatura = $_SESSION['tmp3']['asignatura3'];
    $alumnos = $_SESSION['tmp3']['alumnos3'];
    $curso = $_SESSION['tmp3']['curso3'];
          
          $conn = mysqli_connect($servername, $username, $password, $dbname);

    $series = array();
    foreach ($alumnos as $key => $value) {

            $sql_alumno = "SELECT N_Id_Escolar FROM alumnos" . $curso . 
                    " WHERE Alumnoa = " . "'$value'" . ";";
          $result_alumno = mysqli_query($conn, $sql_alumno);
          $row = mysqli_fetch_array($result_alumno, MYSQLI_NUM);
          $value2 = $row[0];  

    $sql = "SELECT Nota FROM notas" . $curso . " WHERE N_Id_Escolar = '$value2' 
            AND id_asignatura = '$asignatura';";
    $result = mysqli_query($conn, $sql) or die("Error en el sql");
      $series[$value]=array();
      while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
        $series[$value][] = $row[0];
        }
    }

    $myData = new pData(); 

    $html = "<table border='1'>
      <tr>
        <th>Alumno</th>
        <th>Nota media</th>
        <th>Desviación estándar</th>
        <th>Mediana</th>
        <th>Nota más alta</th>
      </tr>";


    foreach ($series as $key => $value) {


    $myData->addPoints($value,$key);

    $media = round($myData->getSerieAverage($key), 2);
    $maxima = $myData->getMax($key);
    $mediana = $myData->getSerieMedian($key);
    $desviacion = round($myData->getStandardDeviation($key), 2);


    $html .= "<tr><td>$key</td><td>$media</td>"
            . "<td>$desviacion</td><td>$mediana</td>" .
            "<td>$maxima</td></tr>";

    }

    $html .= "</table>";
    echo $html;
                    
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
