<?php
    include_once 'config.php';
    protege("administrador");

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $siteName;?></title>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <script src="script/javascript.js"></script>
</head>
<body>
    <div id="cuerpo">
        <a href='activar.php'>Activar curso</a>;
        <label>Curso a activar <input type="text" /></label>
        <label>Subir desde un archivo csv <input type="file" name="subircsv" /></label><br>
        

        <!-- Elegir curso actual, en un input? -->
        <!-- Luego cargar el primer archivo de seneca, y con eso se crea la base? -->
        
        Esta es la página del Administrador<br>  
        <a href='cerrar.php'>Cerrar</a>
    </div>
</body>
</html>