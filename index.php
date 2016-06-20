<?php 
  include_once 'config/config.php';
  include_once 'funciones.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>eduGraph! | Gestión de notas y estadísticas</title>
  <base href='<?php echo $urlbase;?>' target='_self'>
  <?php echo $header;?>
</head>
<body id="page-top">
  
<!-- Cabecera con la imagen de logo y el lema de la página -->
<div class="container-fluid clearfix" id="toplogo"></div>

<!-- Menú superior de navegación fijo -->
<nav class="navbar navbar-inverse" data-spy="affix" data-offset-top="77" id="nav01"></nav>

<!-- Cabecera de la página y texto -->
<div class="container-fluid">
  <h3 class="bg-3">eduGraph - Inicio</h3>
  
  <!-- Mensaje de error de usuario -->
  <div class="container-fluid text-center">
    <?php 
      error_inicio_sesion();
    ?>
  </div>
  <p>
    eduGraph! es una aplicación web para institutos y centros educativos, que permite la gestión de estadísticas y datos de los alumnos del centro,
    a través de la lectura de datos de archivos CSV de Séneca.
  </p>
  <p>
    Permite realizar gráficos altamente visuales e informes en formato pdf para el tratamiento por los profesionales educativos. 
    Está adaptada para funcionar tanto en ordenadores de trabajo como en teléfonos móviles y pantallas pequeñas.
  </p>
</div>

<!-- Carrusel de imágenes -->
<div class="container-fluid">
<div id="myCarousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
    <li data-target="#myCarousel" data-slide-to="3"></li>
    <li data-target="#myCarousel" data-slide-to="4"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    <div class="item active"> 
      <img src="img/grafico1.png" alt="Gráficos por asignaturas">
      <div class="carousel-caption">
        <h3>Gráficos por asignaturas</h3>
        <p>Notas de varios alumnos para una misma asignatura</p>
      </div>
    </div>

    <div class="item">
      <img src="img/grafico2.png" alt="Diseño personalizable">
      <div class="carousel-caption">
        <h3>Diseño personalizable y elegante</h3>
        <p>Permite cambiar todas las opciones de diseño de los gráficos. Gradientes, dimensiones, etc.</p>
      </div>
    </div>
    <div class="item">
      <img src="img/grafico3.png" alt="Tipos de gráficos">
      <div class="carousel-caption">
        <h3>Varios tipos de gráficos</h3>
        <p>Gráficos de líneas, de puntos, de barras...</p>
      </div>
    </div>
    <div class="item">
      <img src="img/grafico6.png" alt="Gráficos por alumnos">
      <div class="carousel-caption">
        <h3>Gráficos por alumnos</h3>
        <p>Notas de un alumno para varias asignaturas diferentes</p>
      </div>
    </div>
    <div class="item">
      <img src="img/grafico5.png" alt="Diferentes Tamaños">
      <div class="carousel-caption">
        <h3>Diferentes tamaños</h3>
        <p>Permite cambiar las dimensiones de los gráficos</p>
      </div>
    </div>
  </div>

  <!-- Left and right controls -->
  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
</div>

<!-- Formulario de inicio de sesión
<div class="container text-center" id="login">
  <form class="form-inline" role="form" name="autenticador" method="POST" action="autenticador.php" onsubmit="return validar();">
    <div class="form-group">
      <label for="login">Usuario:</label>
      <input type="text" class="form-control" name="loginb" id="login" placeholder="Introduce tu usuario">
    </div>
    <div class="form-group">
      <label for="password">Contraseña:</label>
      <input type="password" class="form-control" name="passwordb" id="password" placeholder="Introduce tu contraseña">
    </div>
    <button type="submit" class="btn btn-default" name="entrar" value="entrar">Iniciar sesión</button>
  </form>
</div>
</div>
<br>
-->
  
<!-- Pie de página -->
<div class="container-fluid bg-4 text-center" id='foot01'></div>
<script src="script/javascript.js"></script>
</body>
</html>
