<?php
  include_once 'config/config.php';
  include_once 'funciones.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Guía de uso | eduGraph!</title>
  <base href='<?php echo $urlbase; ?>' target='_self'>
  <?php echo $header; ?>
</head>

<body id="page-top">

  <!-- Cabecera con la imagen de logo y el lema de la página -->
  <div class="container-fluid clearfix" id="toplogo"></div>

  <!-- Menú superior de navegación fijo -->
  <nav class="navbar navbar-inverse" data-spy="affix" data-offset-top="77" id="nav01"></nav>

  <!-- Cabecera de la página y texto -->
  <div class="container-fluid">
    <h3 class="bg-3">Guía de uso</h3>
    <p>
      Texto.
    </p>
  </div>

  <!-- Pie de página -->
  <div class="container-fluid bg-4 text-center" id='foot01'></div>
  <script src="script/javascript.js"></script>
</body>
</html>
