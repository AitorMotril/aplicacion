<?php
    include_once '../config/config.php';
    include_once '../funciones.php';
    protege("administrador");

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $siteName;?></title>
    <!--<link rel="stylesheet" type="text/css" href="css/style.css" />-->
    <script type="text/javascript" src="script/javascript.js"></script>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <style>
.bg-4 {
    background-color: #2f2f2f;
    color: #ffffff;
}
</style>
</head>
<body>
        <div class="w3-top">
  <div class="w3-row w3-white w3-padding">
    <div class="w3-half" style="margin:4px 0 6px 0"><a href='/eduGraph'><img src='/eduGraph/img/eduGraphv1.png' alt='eduGraph'></a></div>
    <div class="w3-half w3-margin-top w3-wide w3-hide-medium w3-hide-small"><div class="w3-right">GRÁFICOS Y GESTIÓN DE NOTAS PARA INSTITUTOS</div></div>
  </div>
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
            <li class="active"><a href="/eduGraph/admin/admin.php">Administrador</a></li>
            <li><a href="/eduGraph/jefe/jefe.php">Jefe de estudios</a></li>
            <li><a href="/eduGraph/regAlumnos.php">Registro de alumnos</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
      <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Iniciar sesión</a></li>
        </ul>
        </div>
        </div>
</nav>
       <div class="container">
<header class="w3-container w3-light-green"><h4>Administrador</h4></header>   
</div>
            
            <div class='container'>
        <form class="form-inline" role="form" method="post" enctype="multipart/form-data">
        <div class="form-group">
            
        <label for='curso'>Curso a activar:</label>
        <select id='curso'>
            <option value="1516">2015-2016</option>
            <option value="1617">2016-2017</option>
        </select> 
        <a href='activar.php'>Activar curso</a>
        
        <label for='subircsv'>Subir el archivo csv para crear las tablas</label>
            
            <input type="file" class="form-control" id='subircsv' name="subircsv"/>
        </div>
        <button type="submit" class="btn btn-default" value="entrar">Subir</button>
        </form>
</div>

        <?php
           if(isset($_POST["entrar"])) {     
            if(!file_exists("/uploads/")){
                mkdir("/uploads/");
                echo "dir maked";
            }
        $target_dir = "/uploads/";
        $target_file = $target_dir . basename($_FILES["subircsv"]["name"]);
        $uploadOk = 1;
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
        $uploadOk = 0;
        }
        if (move_uploaded_file($_FILES["subircsv"]["name"], $target_file)) {
        echo "The file ". basename($_FILES["subircsv"]["name"]). " has been uploaded.";
            } else {
        echo "Sorry, there was an error uploading your file.";
        }
        }
        ?>
        <br><br>
        <a href='../cerrar.php'>Cerrar sesión</a>
    </main>
    <div class="container-fluid bg-4 text-center">
  <p>Creado por Aitor Igartua Gutiérrez, 2016</p>
</div>
</body>
</html>