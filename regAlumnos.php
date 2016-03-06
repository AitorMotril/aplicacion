<?php
    include_once 'config/config.php';
    include_once 'funciones.php';
    protege("jefe" || "administrador");
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
     <nav>
        <ul>
            <li><a href="./index.php">Indice</a></li>
            <li><a href='regAlumnos.php'>Registrar alumnos</a></li>
            <li><a href='instalar/instala.php'>Instalador</a></li>
            <li><a href='admin/admin.php'>Admin</a></li>
            <li><a href='jefe/jefe.php'>Jefe de estudios</a></li>
        </ul>
    </nav>
    <main>
        <header>Página de gestión de notas y estadísticas - Registro de Alumnos</header>
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
    </main>
    <footer><hr>Creado por Aitor Igartua Gutierrez, 2ºASIR 2016</footer>
</body>
</html>
