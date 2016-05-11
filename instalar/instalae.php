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
  </style>
  <script>
    $('#nav').affix({
      offset: {
        top: $('header').height()
      }
    });
  </script>
</head>

<body>
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

<div class="navbar navbar-inverse navbar-static" role="navigation" id="nav">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
        <a href="/eduGraph/index.php"><span class="glyphicon glyphicon-home"></span></a>
    </div>
    <div class="navbar-collapse collapse">
      <ul class="nav navbar-nav">
        <li><a href="/eduGraph/instalar/instala.php">Instalador</a></li>
        <li><a href="/eduGraph/admin/admin.php">Administrador</a></li>
        <li><a href="/eduGraph/jefe/jefe.php">Jefe de estudios</a></li>
        <li><a href="/eduGraph/regAlumnos.php">Registro de alumnos</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="/eduGraph/index.php#login"><span class="glyphicon glyphicon-log-in"></span> Iniciar sesión</a></li>
      </ul>
    </div>
  </div>
</div>
  
<div class="container-fluid">
  <form class="form-inline" role="form" name="autenticador" method="POST" action="autenticador.php" onsubmit="return validar();">
    <div class="form-group">
      <label for="login">Servidor:</label>
      <input type="text" class="form-control" name="login" id="login" placeholder="Introduce el servidor">
    </div>
    <div class="form-group">
      <label for="password">Base de datos:</label>
      <input type="password" class="form-control" name="password" id="password" placeholder="Introduce tu contraseña">
    </div>
    <button type="submit" class="btn btn-default" value="entrar">Iniciar sesión</button>
  </form>
</div>

<div class="container-fluid bg-4 text-center" id='foot01'></div>
<script src="/eduGraph/script/javascript.js"></script>
</body>
</html>
