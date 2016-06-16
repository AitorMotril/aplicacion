<?php
  include_once '../config/config.php';
  include_once '../funciones.php';
  protege("administrador");
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Administrador | eduGraph!</title>
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
  <h3 class="bg-3">Administrador</h3>
  <div class="row">
    <div class="col-md-2">
      <div class="list-group" id="sidebar">
        <a href='admin/admin.php' class="list-group-item active">Principal administrador</a>
        <a href='admin/prueba.php' class="list-group-item">Activar curso de prueba</a>
        <a href="admin/activar.php" class="list-group-item">Activar un curso</a>
      </div>
    </div>
    <div class="col-md-10">
      <div class="container-fluid well well-sm">
        <h4>Página de gestión del administrador</h4> 
        <ul>
          <li>Activar un curso de prueba para probar el funcionamiento de la aplicación 
            con datos fitcios.</li>
          <li>Activar un curso con datos reales leídos de Séneca.</li>
        </ul>
      </div>
    </div>
  </div> <!-- /. end div row -->
</div> <!-- /. end div container-fluid -->

<!-- Pie de página -->
<div class="container-fluid bg-4 text-center" id='foot01'></div>
<script src="script/javascript.js"></script>
</body>
</html>