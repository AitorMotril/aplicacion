<?php
    include_once '../config/config.php';
    include_once '../funciones.php';
    protege("administrador");

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $siteName;?></title>
    <link rel="stylesheet" type="text/css" href="../css/style.css" />
    <script src="../script/javascript.js"></script>
</head>
<body>
    <nav>
        <ul>
            <li><a href='/aplicacion/regAlumnos.php'>Registrar alumnos</a></li>
            <li><a href='/aplicacion/instalar/instala.php'>Instalador</a></li>
            <li><a href='/aplicacion/admin/admin.php'>Admin</a></li>
            <li><a href='/aplicacion/jefe/jefe.php'>Jefe de estudios</a></li>
        </ul>
    </nav>
    <main>
    <header>Página de gestión de notas y estadísticas - Pagina del administrador</header>
        <form method="post" enctype="multipart/form-data">
        <a href='activar.php'>Activar curso</a>;
        <label>Curso a activar</label>
        <select>
            <option value="1516">2015-2016</option>
            <option value="1617">2016-2017</option>
        </select> 
        
        <label>Subir el archivo csv para crear las tablas<input type="file" name="subircsv"/></label><br>
        <input type="submit" value="entrar" />
        </form>

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
        <a href='../cerrar.php'>Cerrar</a>
    </main>
    <footer><br><hr>Creado por Aitor Igartua Gutierrez, 2ºASIR 2016</footer>
</body>
</html>