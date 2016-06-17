<?php
  include_once '../config/config.php';
  include_once '../funciones.php';
  protege("jefe" || "administrador");
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Activación curso de prueba | eduGraph!</title>
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
  <h3 class="bg-3">Activación curso de prueba</h3>
  <div class="row">
    <div class="col-md-2">
      <div class="list-group" id="sidebar">
        <a href='admin/admin.php' class="list-group-item">Principal administrador</a>
        <a href='admin/prueba.php' class="list-group-item active">Activar curso de prueba</a>
        <a href="admin/activar.php" class="list-group-item">Activar un curso</a>
      </div>
    </div>
    <div class="col-md-10">
      <div class="container-fluid well well-sm">
        <h4>Activar curso de prueba</h4> 
        <p>
          Procede a la activación de un curso de prueba, con alumnos y notas ficticios, para probar 
          y familiarizarse con el funcionamiento de la aplicación y sus funcionalidades. El curso de prueba es
          independiente de cualquier otro curso real que se quiera añadir o exista, y se puede desactivar en cualquier 
          momento.
        </p>
        <form class="form-inline" role="form" method="post" enctype="multipart/form-data" action="admin/prueba.php"  id="formularioCursoPrueba" name="formularioCursoPrueba">
          <?php
            $html_boton = "<button type='submit' class='btn btn-default'";
            if ($cursoPrueba != 1) {
              $html_boton .= " name='activarCursoPrueba'>" . "Activar el curso de prueba";
            } else {
              $html_boton .= " name='desactivarCursoPrueba'>" . "Desactivar el curso de prueba";
            }
            
            $html_boton .= "</button>";
            echo $html_boton;
          ?>            
        </form>
      
        <?php
          if (isset($_POST["activarCursoPrueba"])) {
            
            $cursoPrueba = 1;
            $datos_prueba = fopen('datosPrueba/prueba_alumnos.csv', 'r');
            
            activar_curso($datos_prueba, $cursoPrueba, "Prueba");
            
            $datos_prueba2 = fopen('datosPrueba/prueba_alumnos.csv', 'r');
            leer_alumno($datos_prueba2, $cursoPrueba);
  
            $trim1 = fopen('datosPrueba/prueba_notas_1trimestre.csv', 'r');
            notas($trim1, "1", $cursoPrueba);
            
            $trim2 = fopen('datosPrueba/prueba_notas_2trimestre.csv', 'r');
            notas($trim2, "2", $cursoPrueba);
            
            $trim3 = fopen('datosPrueba/prueba_notas_3trimestre.csv', 'r');
            notas($trim3, "3", $cursoPrueba);
          }
          
          if (isset($_POST["desactivarCursoPrueba"])) {
                       
            $sql = "DROP table notas1; DROP table asignaturas1; DROP table alumnos1; DROP table cursos1;";
            $conn = mysqli_connect($servername, $username, $password, $dbname); 
            mysqli_query($sql, $conn);
            
            $cursoPrueba = 0;
            $confi = fopen('../config/config.php', 'a+');
            fwrite($confi, "\n". "$" . "cursoPrueba" . " = " . $cursoPrueba . ";");
            
          }
        ?>
        
      </div> <!-- ./ end div well -->
    </div>  
  </div> <!-- ./ end div row -->
</div>  <!-- ./ end div container fluid -->
    
<!-- Pie de página -->
<div class="container-fluid bg-4 text-center" id='foot01'></div>
<script src="script/javascript.js"></script>
</body>
</html>



