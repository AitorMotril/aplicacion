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
    <div id="cuerpo">
        <a href='activar.php'>Activar curso</a>;
        <label>Curso a activar <input type="text" /></label>
        <label>Subir el archivo csv para crear las tablas<input type="file" name="subircsv" /></label><br>
        <a href='../cerrar.php'>Cerrar</a>
    </div>
</body>
</html>