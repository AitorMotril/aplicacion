<?php
include_once 'config.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="expires" content="Sun, 01 Jan 2014 00:00:00 GMT"/>
    <meta http-equiv="pragma" content="no-cache" />
    <meta charset="UTF-8">
    <title><?php echo $nombreSitio;?> </title>
    <script src="script/javascript.js"></script>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
</head>
<body>
    <form name="regAlumnos" method="POST" onsubmit="return validar();">
        <label>Login <input type="text" name="login" /></label>
        <label>Password <input type="password" name="password" /></label>
        <label>Nombre <input type="text" name="nombre" /></label>
        <label>Apellidos <input type="text" name="apellidos" /></label>
        <label>Subir desde un archivo csv <input type="file" name="subircsv" /></label>
        <input type="submit" value="registro" />
    </form>
    <br>
    <br>
    <?php
    $file = fopen('RegAlumAitor.csv', 'r');
    $datos = fgetcsv($file, 0, ',', '"');
    $arrlength = count($datos);
    $datos2 = fgetcsv($file, 0, ',', '"');
    for ($x = 0; $x < $arrlength; $x++) {
        echo "<label>" . $datos[$x] . " <input type='text' " . "name=" . 
            "'$datos[$x]' " . "value=" . "'$datos2[$x]' " . "/>";
    }
    fclose($file);
    ?>
    <div id="pie"><?php echo $foot;?></div>
</body>
</html>
