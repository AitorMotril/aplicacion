<?php
include_once 'config/config.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="expires" content="Sun, 01 Jan 2014 00:00:00 GMT"/>
    <meta http-equiv="pragma" content="no-cache" />
    <meta charset="UTF-8">
    <title><?php echo $nombreSitio;?> </title>
    <script src="script/javascript.js"></script>
    <link rel="stylesheet" type="text/css" href="css/basico.css" />
</head>
<body>
    <div id="lateral">
    <form name="regAlumnos" method="POST" onsubmit="return validar();">
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
    <br>
    </div>
    <div id="cuerpo">
    </div>
    <!-- <div id="pie"><?php echo $foot;?></div> -->
</body>
</html>
