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
  <?php echo $header;?>
</head>
<body>
<script type="text/javascript">
$(document).ready(function(){
  $("#nombreplantilla").hide();
  $("#nombreplantilla2").hide();
});
function fetch_asignaturas(val)
{
   $.ajax({
     type: 'post',
     url: 'jefe/fetch_asignaturas_o_nombre.php',
     data: {
       get_option:val
     },
     success: function (response) {
       document.getElementById("asignaturas_select").innerHTML+=response; 
     }
   });
}
function fetch_asignaturas2(val)
{
   $.ajax({
     type: 'post',
     url: 'jefe/fetch_asignaturas_o_nombre.php',
     data: {
       get_option:val
     },
     success: function (response) {
       document.getElementById("asignaturas_select2").innerHTML+=response; 
     }
   });
}
function fetch_alumnos(val)
{
   $.ajax({
     type: 'post',
     url: 'jefe/fetch_alumnos.php',
     data: {
       get_option:val
     },
     success: function (response) {
       document.getElementById("alumnos_select").innerHTML+=response; 
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
  <h3 class="bg-3">Gráficos y estadísticas</h3>
  <div class="row">
    <div class="col-md-2">
      <div class="list-group" id="sidebar">
        <a href='jefe/jefe.php' class="list-group-item">Principal jefe de estudios</a>
        <a href='jefe/notas.php' class="list-group-item">Subir notas</a>
        <a href="jefe/graficos.php" class="list-group-item active">Crear gráficos</a>
        <a href="jefe/asignaturas.php" class="list-group-item">Gestión de asignaturas</a>
        <a href="jefe/regAlumnos.php" class="list-group-item">Registrar alumnos</a>
      </div>
    </div>
    <div class="col-md-10">  
      <div class="container-fluid well well-sm">
        <h4>Notas para una asignatura de varios alumnos o grupos</h4> 
        <form class="form" role="form" method="post" enctype="multipart/form-data" action="jefe/graficos.php"  id="formularioPorAlumnos" name="formularioPorAlumnos">
          <div class="form-group">        
            <label>Elegir la asignatura y los alumnos</label> 
            <select name='curso2' onchange='fetch_asignaturas2(this.value);fetch_alumnos2(this.value);'>
              <?php
                listar_cursos();
              ?>
            </select>

            <select id='asignaturas_select2' name='asignatura2'> 
              <option>Elegir la asignatura</option>
            </select>

            <select id='alumnos_select2' name='alumnos2[]' multiple size='2'>
              <option>Elegir los alumnos</option>
            </select>
          </div>  
          
          <div class="form-group">        
            <label>Opciones de diseño</label> 
            <select name='tipo2'>
              <?php 
                listar_graficos();
              ?>
            </select>
            <select name='paleta2'>
              <?php 
                listar_paletas();
              ?>
            </select>
            <select name='g_gradient_direction2'><option value='vertical'>Vertical</option><option value='horizontal'>Horizontal</option></select>
            Gradiente de colores <input type='checkbox' name='g_gradient_enabled2' checked='checked' />
            Color 1 <input name='g_gradient_start2' type="color" value="#ff0000"/>
            Color 2 <input name='g_gradient_end2' type="color" value="#ff0000"/>
            Anchura <input type='text' name='g_width2' value='700'/>
            Altura <input type='text' name='g_height2' value='230'/>
            Mostrar valores en el gráfico <input type='checkbox' name='valores2' checked='checked' />
          </div>
          <div class="form-group">
            Guardar estas opciones como plantilla de diseño <input type="checkbox" name="plantilla2" id="plantilla2" onclick="if (this.checked){ $('#nombreplantilla2').show();}" />
            <input type="text" id="nombreplantilla2" name="nombreplantilla2" placeholder="Nombre de la plantilla"/>
          </div>
          <div class='form-group'>
            <button type="submit" class="btn btn-default" name="grafico2" value="entrar">Subir</button>
          </div>
        </form>
        <?php
          if (isset($_POST["grafico2"])) {
       
          $_SESSION['tmp2']=array();
          $_SESSION['tmp2']['altura']=$_POST['g_height2'];
          $_SESSION['tmp2']['anchura']=$_POST['g_width2'];
          $asignatura2 = $_POST['asignatura2'];
          $t2 = $_POST['tipo2'];
          $curso2 = $_POST['curso2'];
          $_SESSION['tmp2']['alumnos']=$_POST['alumnos2'];
          $alumno2 = $_SESSION['tmp2']['alumnos2'];
          $p2 = $_POST['paleta2'];
          $val2 = $_POST['valores2'];
          $g_en2 = $_POST['g_gradient_enabled2'];
          $g_e2 = $_POST['g_gradient_end2'];
          $g_e2 = str_replace("#","",$g_e2);
          $g_s2 = $_POST['g_gradient_start2'];
          $g_s2 = str_replace("#","",$g_s2);
          $g_d2 = $_POST['g_gradient_direction2'];
          $g_al2 = $_POST['g_height2'];
          $g_an2 = $_POST['g_width2'];
          
                      echo "<a href='pChart/graficotest.php?Seed=0.9&curso=$curso2&d=$t2&asignatura=$asignatura2&p=$p2"
              . "&g_en=$g_en2&g_e=$g_e2&g_s=$g_s2"
              . "&g_d=$g_d2&g_an=$g_an2&g_al=$g_al2&test=test'>Test</a>";
          
                      echo "<br>" . "Grafico1" . "<img src='pChart/graficoAlumnos.php?Seed=0.9&curso=$curso2&d=$t2&asignatura=$asignatura2&p=$p2"
              . "&g_en=$g_en2&g_e=$g_e2&g_s=$g_s2"
              . "&g_d=$g_d2&g_an=$g_an2&g_al=$g_al2&val=$val2&test=test'>";
        }

        ?>
      </div>
          
      <div class="container-fluid well well-sm">
        <h4>Notas de un alumno para una o varias asignaturas</h4> 
        <form class="form" role="form" method="post" enctype="multipart/form-data" action="jefe/graficos.php"  id="formularioPorAsignaturas" name="formularioPorAsignaturas">
          <div class="form-group">
            <label>Elegir una plantilla para el diseño del gráfico</label> 
            <select name="plantillacargada">
              <?php listar_plantillas();?>
            </select>
          </div>
          <div class="form-group">        
            <label>Elegir el alumno y las asignaturas</label> 
            <select name='curso' onchange='fetch_asignaturas(this.value);fetch_alumnos(this.value);'>
              <?php
                listar_cursos();
              ?>
            </select>
            <select id='asignaturas_select' name='asignaturas[]' multiple size='2'>
              <option>Elegir las asignaturas</option>
            </select>
            <select id='alumnos_select' name='alumno'>
              <option>Elegir el alumno</option>
            </select>
          </div>
          <div class="form-group">        
            <label>Opciones de diseño</label> 
            <select name='tipo'>
            <?php
              listar_graficos();
            ?>
            </select>
            <select name='paleta'>
            <?php 
              listar_paletas();
            ?>
            </select>
            <select name='g_gradient_direction'>
              <option value='vertical'>Vertical</option>
              <option value='horizontal'>Horizontal</option>
            </select>
            Gradiente de colores <input type='checkbox' name='g_gradient_enabled' checked='checked' />
            Color 1 <input name='g_gradient_start' type="color" value="#ff0000"/>
            Color 2 <input name='g_gradient_end' type="color" value="#ff0000"/>
  <!--      <input type="checkbox" name="trimestre1" value="trimestre1"/>Primer Trimestre
            <input type="checkbox" name="trimestre2" value="trimestre2"/>Segundo Trimestre
            <input type="checkbox" name="trimestre3" value="trimestre3"/>Tercer Trimestre-->
            Anchura <input type='text' name='g_width' value='700'/>
            Altura <input type='text' name='g_height' value='230'/>
            Mostrar valores en el gráfico <input type='checkbox' name='valores' checked='checked' />
          </div>
          <div class="form-group">
            Guardar estas opciones como plantilla de diseño <input type="checkbox" name="plantilla" id="plantilla" onclick="if (this.checked){ $('#nombreplantilla').show();}" />
            <input type="text" id="nombreplantilla" name="nombreplantilla" placeholder="Nombre de la plantilla"/>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-default" name="grafico" value="entrar">Subir</button>
          </div>
        </form>
  
        <?php
          if (isset($_POST["grafico"])) {

            $_SESSION['tmp']=array();
            $_SESSION['tmp']['alumno']=$_POST['alumno'];
            $_SESSION['tmp']['altura']=$_POST['g_height'];
            $_SESSION['tmp']['anchura']=$_POST['g_width'];
            $alumno = $_POST['alumno'];
            $t = $_POST['tipo'];
            $curso = $_POST['curso'];
            $_SESSION['tmp']['asignaturas']=$_POST['asignaturas'];
            $asignaturas = $_SESSION['tmp']['asignaturas'];
            $p = $_POST['paleta'];
            $g_en = $_POST['g_gradient_enabled'];
            $g_e = $_POST['g_gradient_end'];
            $g_e = str_replace("#","",$g_e);
            $g_s = $_POST['g_gradient_start'];
            $g_s = str_replace("#","",$g_s);
            $val = $_POST['valores'];
            $g_d = $_POST['g_gradient_direction'];
            $g_al = $_POST['g_height'];
            $g_an = $_POST['g_width'];
            
            $conn = mysqli_connect($servername, $username, $password, $dbname);
            
            if ($_POST['plantilla']) {
              $nombreplantilla = $_POST['nombreplantilla'];
              $sql = "INSERT IGNORE INTO plantillas VALUES (" .
                     "'$nombreplantilla', '$t', '$p', '$g_en', '$g_d', '$g_s', '$g_e', '$g_al', '$g_an');";
              if (!mysqli_query($conn, $sql)) {
                echo "Error guardando la plantilla " . $nombreplantilla . ": " . mysqli_error($conn) . "<br>";
              } else {
                echo "La plantilla con nombre " . $nombreplantilla . " se ha guardado correctamente." . "<br>";
              }
            }
            
            
            

            $sql_alumno = "SELECT N_Id_Escolar FROM alumnos" . $curso . 
                      " WHERE Alumnoa = " . "'$alumno'" . ";";
            $result_alumno = mysqli_query($conn, $sql_alumno);
            $row = mysqli_fetch_array($result_alumno, MYSQLI_NUM);
            $alumnof = $row[0];  
            echo $alumnof; 
  
//            echo "<a href='pChart/graficotest.php?Seed=0.9&curso=$curso&d=$t&alumno=$alumnof&p=$p"
//              . "&g_en=$g_en&g_e=$g_e&g_s=$g_s"
//              . "&g_d=$g_d&g_an=$g_an&g_al=$g_al&test=test'>Test</a>";
      
          //  echo "<img src='pChart/grafico5.php?Seed=0.9&dibujo=$tipo&asignatura=$asignatura&alumno=$alumno&paleta=$paleta'>";
    
//            echo "<br>" . "Grafico1" . "<img src='pChart/grafico1.php?Seed=0.9&curso=$curso&d=$t&alumno=$alumnof&p=$p"
//              . "&g_en=$g_en&g_e=$g_e&g_s=$g_s"
//              . "&g_d=$g_d&g_an=$g_an&g_al=$g_al&test=test'>";
//            
//                        echo "<br>" . "Grafico series" . "<img src='pChart/graficoSeries.php?Seed=0.9&curso=$curso&d=$t&alumno=$alumnof&p=$p"
//              . "&g_en=$g_en&g_e=$g_e&g_s=$g_s"
//              . "&g_d=$g_d&g_an=$g_an&g_al=$g_al&test=test'>";
//            
//                 echo "<br>" . "GradienteDimensiones" . "<img src='pChart/graficoGradienteDimensiones.php?Seed=0.9&curso=$curso&d=$t&alumno=$alumnof&p=$p"
//              . "&g_en=$g_en&g_e=$g_e&g_s=$g_s"
//              . "&g_d=$g_d&g_an=$g_an&g_al=$g_al&test=test'>";
//                 
//                 
//                                  echo "<br>" . "GradienteDimensionesFin" . "<img src='pChart/graficoGradienteDimensionesFin.php?Seed=0.9&curso=$curso&d=$t&alumno=$alumnof&p=$p"
//              . "&g_en=$g_en&g_e=$g_e&g_s=$g_s"
//              . "&g_d=$g_d&g_an=$g_an&g_al=$g_al&test=test'>";
//                                  
//                                                                    echo "<br>" . "GradienteDimensionesFin2" . "<img src='pChart/graficoGradienteDimensionesFin2.php?Seed=0.9&curso=$curso&d=$t&alumno=$alumnof&p=$p"
//              . "&g_en=$g_en&g_e=$g_e&g_s=$g_s"
//              . "&g_d=$g_d&g_an=$g_an&g_al=$g_al&test=test'>";
                                                                    
                                                                                                                                        echo "<img src='pChart/graficoAsignaturas.php?Seed=0.9&curso=$curso&d=$t&alumno=$alumnof&p=$p"
              . "&g_en=$g_en&g_e=$g_e&g_s=$g_s"
              . "&g_d=$g_d&g_an=$g_an&g_al=$g_al&val=$val&test=test'>";
      
      
//      echo "<br>" . "GradienteEnabledDimensiones_1" . "<img src='pChart/graficoGradienteEnabledDimensiones_1.php?Seed=0.9&curso=$curso&d=$t&alumno=$alumnof&p=$p"
//              . "&g_en=$g_en&g_e=$g_e&g_s=$g_s"
//              . "&g_d=$g_d&g_an=$g_an&g_al=$g_al&test=test'>";
//      
//            echo "<br>" . "GradienteEnabledDimensiones_1_1" . "<img src='pChart/graficoGradienteEnabledDimensiones_1_1.php?Seed=0.9&curso=$curso&d=$t&alumno=$alumnof&p=$p"
//              . "&g_en=$g_en&g_e=$g_e&g_s=$g_s"
//              . "&g_d=$g_d&g_an=$g_an&g_al=$g_al&test=test'>";
//            
//                        echo "<br>" . "GradienteEnabledDimensiones_1_2" . "<img src='pChart/graficoGradienteEnabledDimensiones_1_2.php?Seed=0.9&curso=$curso&d=$t&alumno=$alumnof&p=$p"
//              . "&g_en=$g_en&g_e=$g_e&g_s=$g_s"
//              . "&g_d=$g_d&g_an=$g_an&g_al=$g_al&test=test'>";
//                        
//                                                echo "<br>" . "GradienteEnabledDimensiones_1_3" . "<img src='pChart/graficoGradienteEnabledDimensiones_1_3.php?Seed=0.9&curso=$curso&d=$t&alumno=$alumnof&p=$p"
//              . "&g_en=$g_en&g_e=$g_e&g_s=$g_s"
//              . "&g_d=$g_d&g_an=$g_an&g_al=$g_al&test=test'>";
//                                                
//                                                                                                echo "<br>" . "GradienteEnabled_1" . "<img src='pChart/graficoGradienteEnabled_1.php?Seed=0.9&curso=$curso&d=$t&alumno=$alumnof&p=$p"
//              . "&g_en=$g_en&g_e=$g_e&g_s=$g_s"
//              . "&g_d=$g_d&g_an=$g_an&g_al=$g_al&test=test'>";
                                                                                                
                                                                                                

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