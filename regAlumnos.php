<?php
    include_once 'config/config.php';
    include_once 'funciones.php';
    protege("jefe" || "administrador");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $nombreSitio;?> </title>
    <script src="script/javascript.js"></script>
    <!--<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">-->
    <link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>-->
    <!--<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>-->
    <!-- <link rel="stylesheet" type="text/css" href="css/style.css" /> -->
</head>
<body>
    <!--
    <div class="container">
    <nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
        </div>
            <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav">
            <li class="w3-large"><a href="#"><i class="fa fa-home"></i></a></li>
            <li><a href="/eduGraph/instalar/instala.php">Instalador</a></li>
            <li><a href="/eduGraph/admin/admin.php">Administrador</a></li>
            <li><a href="/eduGraph/jefe/jefe.php">Jefe de estudios</a></li>
            <li  class="active"><a href="/eduGraphregAlumnos.php">Registro de alumnos</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
      <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Iniciar sesión</a></li>
        </ul>
        </div>
        </div>
</nav>
    </div>
    -->
    <div class="w3-top">
  <div class="w3-row w3-white w3-padding">
    <div class="w3-half" style="margin:4px 0 6px 0"><a href='/eduGraph'><img src='/eduGraph/img/eduGraphv1.png' alt='eduGraph'></a></div>
    <div class="w3-half w3-margin-top w3-wide w3-hide-medium w3-hide-small"><div class="w3-right">GRÁFICOS Y GESTIÓN DE NOTAS PARA INSTITUTOS</div></div>
  </div>
        <ul class="w3-navbar w3-light-grey w3-border w3-large">
            <li><a class="w3-green" href="#"><i class="fa fa-home w3-large"></i></a></li>
                        <li><a href="/eduGraph/instalar/instala.php">Instalador</a></li>
            <li><a href="/eduGraph/admin/admin.php">Administrador</a></li>
            <li><a href="/eduGraph/jefe/jefe.php">Jefe de estudios</a></li>
        </ul>
    </div>
    
    <main>

<h4>Registro de Alumnos</h4>
    <div class="container">
    <form class="form-inline" role="form" name="regAlumnos" method="POST" onsubmit="return validar();">
        <?php
            $conn = mysqli_connect($servername, $username, $password, $dbname);
            $sql = "SELECT * FROM cabecera" . $cursoActivo;
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($result, MYSQLI_NUM);
            $arrlength = count($row);
            for ($x = 0; $x < $arrlength; $x++) {
                $var = $row[$x];
                echo "<label>" . $var . "<input type='text' /></label><br>";
            }
        ?>
        <form name="subircsv" method="POST" enctype="multipart/form-data" action="readcsv.php">
        <label>Subir desde un archivo csv <input type="file" name="subircsv" /></label><br>
        <input type="submit" value="registro" />
        <?php echo $_POST["subircsv"];?>
    </form>
    </div>
    </main>
    <footer><hr>Creado por Aitor Igartua Gutierrez, 2ºASIR 2016</footer>
</body>
</html>
