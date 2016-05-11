<?php include_once '/eduGraph/config/config.php';?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $siteName;?></title>
  <!--<link rel="stylesheet" type="text/css" href="css/style.css" />-->
  <!--<script type="text/javascript" src="script/javascript.js"></script>-->
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.js"></script>
  <style>
    .bg-4 {
      background-color: #2f2f2f;
      color: #ffffff;
    }
    /* bootstrap 3 helpers */

    header {
      height: 100px;
    }

    #nav.affix {
      position: fixed;
      top: 0;
      width: 100%;
      z-index: 10;
    }

    .form-control:focus {
      border-color: #4d9900;
    }
    
    .carousel-inner img {
      margin: auto;
    }

    .carousel-caption h3 {
      color: #fff !important;
    }

    @media (max-width: 600px) {
      .carousel-caption {
        display: none; /* Hide the carousel text when the screen is less than 600 pixels wide */
      }
    }
    
    nav.navbar.shrink {
  min-height: 35px;
}
nav.navbar{
  background-color:#ccc;
   /* Animation */
   -webkit-transition: all 0.4s ease;
   transition: all 0.4s ease;
}

.navbar-brand {
  padding: 0px; /* firefox bug fix */
}
.navbar-brand>img {
  height: 100px;
  padding: 15px; /* firefox bug fix */
  width: auto;
}
  </style>
  <script>
    $('#nav').affix({
      offset: {
        top: $('header').height()
      }
    });
    $(window).scroll(function() {
  if ($(document).scrollTop() > 50) {
    $('nav').addClass('shrink');
  } else {
    $('nav').removeClass('shrink');
  }
});
  </script>
</head>

<body id="page-top">

         <?php
          include_once '/eduGraph/funciones.php';
          include_once '/eduGraph/autenticador.php';
          
          session_start();
           
          if  (isset($_SESSION["validar"])) {
              // Si está autenticado, muestra Cerrar Sesión y oculta
               // Iniciar Sesión
               echo    "<script>
                          $(document).ready(function () {
                               $('#inicioid').hide();
                              $('#cerrarid').show();
                           }); 
                     </script>";
         }else   {
              // Si no ha iniciado sesión, muestra Iniciar Sesión y oculta
            // Cerrar Sesión
            echo    "<script>
                         $(document).ready(function () {
                           $('#inicioid').show();
                            $('#cerrarid').hide();
                        });
                     </script>";
        }
       
        
      ?>


<!--
Cabecera con el logo
<header class="masthead">
  <div class="container">
    <div class="row">
      <a href='/eduGraph'><img src='/eduGraph/img/eduGraphv1.png' alt='eduGraph'></a>
      <div class="pull-right hidden-sm hidden-md">
        <h4>GRÁFICOS Y GESTIÓN DE NOTAS PARA INSTITUTOS</h4>
      </div>
    </div>
  </div>
</header>
-->

<!-- Barra superior de navegación -->
<div class="navbar navbar-inverse navbar-fixed-top" role="navigation" id="nav">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand page-scroll" href="#page-top"><img src="/eduGraph/img/eduGraphv2.png"></a>
    </div>
    <div class="navbar-collapse collapse">
      <ul class="nav navbar-nav">
        <li class="hidden"><a href="#page-top"></a></li>
        <li><a href="/eduGraph/instalar/instala.php">Instalador</a></li>
        <li><a href="/eduGraph/admin/admin.php">Administrador</a></li>
        <li><a href="/eduGraph/jefe/jefe.php">Jefe de estudios</a></li>
        <li><a href="/eduGraph/regAlumnos.php">Registro de alumnos</a></li>
      </ul>
                        <ul class="nav navbar-nav navbar-right" > 
                            <li class="dropdown" id="inicioid">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span><b> Iniciar sesión</b> <span class="caret"></span></a>
                                    <ul id="login-dp" class="dropdown-menu">
                                        <li>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <form name="iniciaSesion" class="form" role="form" method="post" action="autenticador.php" accept-charset="UTF-8" id="login-nav" >
                                                        <div class="form-group">
                                                            <input type="text" name="login" class="form-control" id="loginid" placeholder="Usuario" required />
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="password" name="password" class="form-control" id="passwordid" placeholder="Password" required />
                                                        </div>
                                                        <div class="form-group">
                                                            <button type="submit" name="autenticar" class="btn btn-primary btn-block">Iniciar sesión</button>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="bottom text-center">
                                                        ¿No tienes cuenta? <a href="registrar.php"><b>Regístrate aquí</b></a>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                            </li>
                            <li id="cerrarid"><span class="glyphicon glyphicon-log-in"></span><a href="cerrar.php"> Cerrar Sesión</a></li>
                        </ul>
    </div>
  </div>
</div>

<main>
<!-- Texto de presentación -->
<div class="container-fluid">
  <p>
    eduGraph! es una aplicación web para institutos y centros educativos, que permite la gestión de estadísticas y datos de los alumnos del centro.
    Permite realizar gráficos altamente visuales e informes en formato pdf para el tratamiento por los profesionales educativos. Está adaptada para funcionar tanto en ordenadores de trabajo como en teléfonos móviles y pantallas pequeñas.
  </p>
  <p>
    Loren impsum doler teler<br>Loren impsum doler teler<br>Loren impsum doler teler<br>Loren impsum doler teler<br>Loren impsum doler teler<br>Loren impsum doler teler<br>Loren impsum doler teler<br>Loren impsum doler teler<br>Loren impsum doler teler<br>Loren impsum doler teler<br>
  </p>  
</div>

<!-- Carrusel de imágenes -->
<div id="myCarousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    <div class="item active"> 
      <img src="/eduGraph/pChart/grafico1.php?Seed=0.9&dibujo=drawFilledSplineChart&leyenda1=Test4" alt="New York">
      <div class="carousel-caption">
        <h3>New York</h3>
        <p>The atmosphere in New York is lorem ipsum.</p>
      </div>
    </div>

    <div class="item">
      <img src="/eduGraph/pChart/grafico2.php?Seed=0.9" alt="Chicago">
      <div class="carousel-caption">
        <h3>Chicago</h3>
        <p>Thank you, Chicago - A night we won't forget.</p>
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
<br>

<!-- Formulario de inicio de sesión -->
<div class="container text-center" id="login">
  <form class="form-inline" role="form" name="autenticador" method="POST" action="autenticador.php" onsubmit="return validar();">
    <div class="form-group">
      <label for="login">Usuario:</label>
      <input type="text" class="form-control" name="login" id="login" placeholder="Introduce tu usuario">
    </div>
    <div class="form-group">
      <label for="password">Contraseña:</label>
      <input type="password" class="form-control" name="password" id="password" placeholder="Introduce tu contraseña">
    </div>
    <button type="submit" class="btn btn-default" value="entrar">Iniciar sesión</button>
  </form>
</div>
<br>
<div class="container text-center">
<!-- Mensaje de error -->
<?php 
  if ($_GET[error] == "si") {
    if ($_GET[formularioerror] == "si") {
      echo "<div class='alert alert-danger'>"
      . "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>"
      . "Rellena el formulario.</div>";
    } else {
      echo "<div class='alert alert-danger'>"
      . "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>"
      . "Verifica tus datos.</div>";
    }
  }
  if ($_GET[usererror] == "si") {
    echo "<div class='alert alert-danger'>"
    . "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>"
    . "No tienes permiso suficiente para acceder a esa página.</div>";
  }
?>
</div>
</main>
<div class="container-fluid bg-4 text-center" id='foot01'></div>
<script src="/eduGraph/script/javascript.js"></script>
</body>
</html>
