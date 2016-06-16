<?php
  include_once '../config/config.php';
  include_once '../funciones.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>eduGraph! Instalación</title>
  <base href='<?php echo $urlbase;?>' target='_self'>
  <?php echo $header;?>
</head>
<body>
  
<!-- Cabecera con la imagen de logo y el lema de la página -->
<div class="container-fluid clearfix" id="toplogo"></div>

<!-- Menú superior de navegación fijo -->
<nav class="navbar navbar-inverse" data-spy="affix" data-offset-top="77" id="nav01"></nav>

<div class="container-fluid">
  <h3 class="bg-3">Instalación completada</h3>
    <?php
      if (!check_install()) {
        header(("Location: " . $urlbase .  "instalar/instalar.php"));
      } else {
        echo "La aplicación ya está instalada y configurada." . "<br><br>";
        if (!check_curso()) {
          echo "Ahora se recomienda <a href='admin/activar.php'>activar un curso</a> con datos reales, " .
                "o el <a href='admin/prueba.php'>curso de prueba</a>";
        } else {
          echo "Ya hay un curso activo, ahora el <a href='jefe/jefe.php'>jefe de estudios</a> "
          . "puede proceder a introducir notas y realizar gráficos y estadísticas";
        }
      } 
    ?>
</div>  

<!-- Pie de página -->
<div class="container-fluid bg-4 text-center" id='foot01'></div>
<script src="script/javascript.js"></script>
</body>
</html>