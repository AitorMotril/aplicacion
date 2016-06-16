<?php
    include_once 'config/config.php';
    include_once 'funciones.php';
    protege("jefe" || "administrador");
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Registro de alumnos | eduGraph!</title>
  <base href='<?php echo $urlbase;?>' target='_self'>
  <?php echo $header;?>
</head>
<body>
  
<script>
  $(document).ready(function(){
    $("#formRegAlumnos").hide();
    //checkForm($("#formRegAlumnos"));
  });
</script>
  
<!-- Cabecera con la imagen de logo y el lema de la página -->
<div class="container-fluid clearfix" id="toplogo"></div>

<!-- Menú superior de navegación fijo -->
<nav class="navbar navbar-inverse" data-spy="affix" data-offset-top="77" id="nav01"></nav>

<!-- Cabecera de la página y texto -->
<div class="container-fluid">
  <h3 class="bg-3">Registro de Alumnos <?php $curso = check_curso(true); echo "curso: " . $curso;?></h3>
  <p>
    Formulario para el registro de alumnos, asegurarse de que los datos de los alumnos
    que se van a subir corresponden al curso activo.
    Los campos del formulario manual y de actualización también dependen del curso activo actual.
  </p>


<div class="container-fluid well well-sm">
  <h4>Mediante lectura de un archivo csv Séneca <small><em>Recomendado</em></small></h4>  
    <form class="form" role="form" name="subircsv" method="POST" enctype="multipart/form-data" action="regAlumnos.php">
      <div class="form-group">
      <input type="file" name="csvalumnos" />
      </div>
      <div class="form-group">
      <button type="submit" class="btn btn-default" value="registro" name="alumnos_csv">Subir</button>
      </div>
    </form>
    <?php
      if (isset($_POST["alumnos_csv"]) && isset($_FILES["csvalumnos"])) {
                
        if (!$_FILES["csvalumnos"]["tmp_name"]){
          $error = "El archivo no llegó al servidor.";
          echo $error;
        } 
        
        if (($archivo = fopen($_FILES["csvalumnos"]["tmp_name"], "r")) !== FALSE) {
          leer_alumno($archivo, $cursoActivo);      
        }
        
      }
    ?>
</div>

<div class="container-fluid well well-sm">
  <h4>Subir manualmente o actualizar un registro</h4>  
  <button onclick="hideShow(this, document.formRegAlumnos);">Mostrar</button>
    <?php
      listar_alumnos($cursoActivo);
    ?>
    <form class="form-inline" id="formRegAlumnos" role="form" name="formRegAlumnos" method="POST" onsubmit="return checkForm(this);">
      <?php
                
        function leer_cabeceras() {
          
          global $servername, $username, $password, $dbname, $cursoActivo;
          $alumnoid = 361237;
          
          $conn = mysqli_connect($servername, $username, $password, $dbname);
          $sql = "SELECT * FROM cabecera" . $cursoActivo;
          $sql_alu = "SELECT * FROM alumnos" . $cursoActivo . " WHERE N_Id_Escolar = " . $alumnoid;
          $result = mysqli_query($conn, $sql);
          $result2 = mysqli_query($conn, $sql_alu);
          
          $row = mysqli_fetch_array($result, MYSQLI_NUM);
          $row2 = mysqli_fetch_array($result2, MYSQLI_NUM);
          $arrlength = count($row);
          
          for ($x = 0; $x < $arrlength; $x++) {
            $var = $row[$x];
            $var2 = $row2[$x];
            echo 
                "<div class='form-group form-alumnos col-sm-6'>" .
                "<label class='text-left pull-left'>" . $var . "</label>" .
                "<input type='text' class='form-control pull-right' value= " . "'$var2'" . " /></div>"
            ;
          }
        }
        
        leer_cabeceras();
        
      ?>
        </form>
  </div>
</div>

<!-- Pie de página -->
<div class="container-fluid bg-4 text-center" id='foot01'></div>
<script src="script/javascript.js"></script>
</body>
</html>