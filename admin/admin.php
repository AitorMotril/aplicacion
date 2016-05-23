<?php
    include_once '../config/config.php';
    include_once '../funciones.php';
    protege("administrador");
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <title><?php echo $siteName;?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <link rel="stylesheet" href="/eduGraph/css/style.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <link rel="icon" href="../img/iconv1.png" type="image/x-icon">
</head>
<body>
  
<!-- Cabecera con la imagen de logo y el lema de la página -->
<div class="container-fluid clearfix" id="toplogo"></div>

<!-- Menú superior de navegación fijo -->
<nav class="navbar navbar-inverse" data-spy="affix" data-offset-top="77" id="nav01"></nav>

<div class="container-fluid">
  <h3 class="bg-3">Administrador</h3>
  <p>
    Página de gestión del administrador.
  </p>
</div>
            
            <div class='container-fluid'>
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
        
<!-- Pie de página -->
<div class="container-fluid bg-4 text-center" id='foot01'></div>
<script src="/eduGraph/script/javascript.js"></script>
</body>
</html>