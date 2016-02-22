<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
</head>
<body>   
<?php
    include_once 'config.php';
    $cursoactivo = 1516;
    $file = fopen('RegAlumAitor.csv', 'r');
    $datos = fgetcsv($file, 0, ',', '"');
    $arrlength = count($datos);
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    $sql = "CREATE TABLE IF NOT EXISTS alumnos" . $cursoactivo . " (";
    for ($x = 0; $x < $arrlength; $x++) {
        $var = $datos[$x];
        $var = sanear_string($var);
        if ($x != ($arrlength - 1)) {
            $sql .= $var . " VARCHAR(40)" . ", ";
            } else {
                $sql .= $var . " VARCHAR(40)" . ") ENGINE=InnoDB DEFAULT CHARSET=utf8;";
            }
    }
    
    mysqli_query($conn, $sql)or die("error al crear la tabla alumnos" . mysqli_error($conn));
        
    $sql = "CREATE TABLE IF NOT EXISTS cabecera" . $cursoactivo . " (";
    
    for ($x = 0; $x < $arrlength; $x++) {
        $var = $datos[$x];
        $var = sanear_string($var);
        if ($x != ($arrlength - 1)) {
            $sql .= $var . " VARCHAR(40)" . ", ";
            } else {
                $sql .= $var . " VARCHAR(40)" . ") ENGINE=InnoDB DEFAULT CHARSET=utf8;";
            }
    }
    
    mysqli_query($conn, $sql)or die("error al crear la tabla cabeceras" . mysqli_error($conn));
    
    $sql = "INSERT INTO cabecera" . $cursoactivo . " VALUES (";
    for ($x = 0; $x < $arrlength; $x++) {
        $var = $datos[$x];
        if ($x != ($arrlength -1)) {
        $sql .= "'$var'" . ", ";
        } else {
            $sql .= "'$var'" . ");";
        }
    }

    mysqli_query($conn, $sql)or die("error al insertar valores en la tabla cabeceras" . mysqli_error($conn));
    
    $sql = "INSERT INTO alumnos" . $cursoactivo . " VALUES (";
    $datos = fgetcsv($file, 0, ',', '"');
        for ($x = 0; $x < $arrlength; $x++) {
            $var = $datos[$x];
            if ($x != ($arrlength -1)) {
                $sql .= "'$var'" . ", ";
            } else {
                $sql .= "'$var'" . ");";
            }
        }

    mysqli_query($conn, $sql)or die("error al insertar valores en la tabla alumnos" . mysqli_error($conn));
    
    /*
    mysqli_query($conn, "SET character_set_results = 'utf8', character_set_client = 'utf8', "
            . "character_set_connection = 'utf8', character_set_database = 'utf8', "
            . "character_set_server = 'utf8'") or die("error al probar lo de utf8" . mysqli_error($conn));
    */

?>
</body>
</html>