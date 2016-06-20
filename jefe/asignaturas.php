<?php
  include_once '../config/config.php';
  include_once '../funciones.php';
  protege("jefe" || "administrador");
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Gestión de asignaturas | eduGraph!</title>
  <base href='<?php echo $urlbase;?>' target='_self'>
  <?php echo $header;?>
</head>
<body>
  <script type="text/javascript">
      function fetch_asignaturas(val)
{
   $.ajax({
     type: 'post',
     url: 'jefe/fetch_asignaturas.php',
     data: {
       get_option:val
     },
     success: function (response) {
       document.getElementById("select_asignaturas").innerHTML=response; 
     }
   });
}

  function fetch_nombre_asignaturas(val)
{
   $.ajax({
     type: 'post',
     url: 'jefe/fetch_nombre_asignaturas.php',
     data: {
       get_option:val
     },
     success: function (response) {
       document.getElementById("nombres_select").value=response; 
     }
   });
}

  function fetch_area_competencial(val)
  {
    $.ajax({
      type: 'post',
      url: 'jefe/fetch_area_competencial.php',
      data: {
        get_option:val
      },
      success: function (response) {
        document.getElementById("area_competencial").value=response;
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
  <h3 class="bg-3">Gestión de asignaturas</h3>
  <div class="row">
    <div class="col-md-2">
      <div class="list-group" id="sidebar">
        <a href='jefe/jefe.php' class="list-group-item">Principal jefe de estudios</a>
        <a href="jefe/regAlumnos.php" class="list-group-item">Registrar alumnos</a>
        <a href='jefe/notas.php' class="list-group-item">Subir notas</a>
        <a href="jefe/graficos.php" class="list-group-item">Crear gráficos</a>
        <a href="jefe/asignaturas.php" class="list-group-item active">Gestión de asignaturas</a>
        <a href='jefe/estadisticas.php' class="list-group-item">Estadísticas</a>
      </div>
    </div>
  <div class="col-md-10">  
    <div class="container-fluid well well-sm">
      <h4>Asignaturas</h4> 
      <p>
        Gestionar las asignaturas existentes para cada curso, añadirles nombre completo así como áreas competenciales.
      </p>
      <form class="form" role="form" method="post" enctype="multipart/form-data" action="jefe/asignaturas.php"  id="formularioCurso" name="formularioAsignaturas">
        <div class="form-group">  
          <label for='curso'>Seleccionar un curso</label> 
          <select name='curso' onchange='fetch_asignaturas(this.value);'>
            <?php
              listar_cursos();
            ?>
          </select>
        </div>
        <div class="form-group">        
          <label for='id_asignatura'>Elegir una asignatura para actualizar</label> 
          <select id='select_asignaturas' name='id_asignatura' onchange='fetch_nombre_asignaturas(this.value);fetch_area_competencial(this.value);'>
          </select>
          <input type="text" id="nombres_select" name="nombre_completo" placeholder="Nombre completo de la asignatura"/>
          <input type="text" id="area_competencial" name="area_competencial" placeholder="Area competencial de la asignatura"/>
        </div>
        <div class="form-group">   
          <button type="submit" class="btn btn-default" name="ac_asignaturas" value="entrar">Actualizar</button>
        </div>
      </form>
              <?php
    if (isset($_POST["ac_asignaturas"])) {
      
            $conn = mysqli_connect($servername, $username, $password, $dbname);
            $cursoActivo = $_POST['curso'];
            $asignatura2 = $_POST['id_asignatura'];
            $nombre_completo = $_POST['nombre_completo'];
            $area_competencial = $_POST['area_competencial'];
            $sql_asig = "UPDATE asignaturas" . $cursoActivo . " SET nombre_completo = " 
                    . "'$nombre_completo'" . ", area_competencial = " . "'$area_competencial'" 
                      . " WHERE id_asignatura = " . "'$asignatura2'" . ";";
         
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
</div>
  
    


  
<!-- Pie de página -->
<div class="container-fluid bg-4 text-center" id='foot01'></div>
<script src="script/javascript.js"></script>
</body>
</html>