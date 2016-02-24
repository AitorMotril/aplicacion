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
    <div id="lateral">
    <form name="regAlumnos" method="POST" onsubmit="return validar();">
        <?php
            $conn = mysqli_connect($servername, $username, $password, $dbname);
            $sql = "SELECT * FROM cabecera" . $cursoActivo;
            mysqli_query($conn, $sql, MYSQLI_USE_RESULT) or die("Error al crear la tabla alumnos" . mysqli_error($conn));
        ?>
        <input type="text" />
        <label>Subir desde un archivo csv <input type="file" name="subircsv" /></label><br>
        <input type="submit" value="registro" />
    </form>
    <br>
    </div>
    <div id="cuerpo">
    </div>
    <div id="pie"><?php echo $foot;?></div>
</body>
</html>
