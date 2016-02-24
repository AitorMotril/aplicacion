<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
</head>
<body>   
<?php
    include_once '../config/config.php';
    include_once '../funciones.php';
    $file = fopen('../RegAlumAitor.csv', 'r');
    $datos = fgetcsv($file, 0, ',', '"');
    $arrlength = count($datos);
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    
    $sql = "CREATE TABLE IF NOT EXISTS alumnos" . $cursoActivo . " (";
    
    for ($x = 0; $x < $arrlength; $x++) {
        $var = $datos[$x];
        $var = sanear_string($var);
        if ($x != ($arrlength - 1)) {
            $sql .= $var . " VARCHAR(40)" . ", ";
            } else {
                $sql .= $var . " VARCHAR(40)" . ") ENGINE=InnoDB DEFAULT CHARSET=utf8;";
            }
    }

    if (mysqli_query($conn, $sql)) {
        echo "La tabla alumnos" . $cursoActivo . " se ha creado correctamente o ya existía" . "<br>";
    } else {
        echo "Error al crear la tabla alumnos: " . mysqli_error($conn) . "<br>";
    }
        
    $sql = "CREATE TABLE IF NOT EXISTS cabecera" . $cursoActivo . " (";
    
    for ($x = 0; $x < $arrlength; $x++) {
        $var = $datos[$x];
        $var = sanear_string($var);
        if ($x != ($arrlength - 1)) {
            $sql .= $var . " VARCHAR(40)" . ", ";
            } else {
                $sql .= $var . " VARCHAR(40)" . ") ENGINE=InnoDB DEFAULT CHARSET=utf8;";
            }
    }
    
    if (mysqli_query($conn, $sql)) {
        echo "La tabla cabecera" . $cursoActivo . " se ha creado correctamente o ya existía" . "<br>";
    } else {
        echo "Error al crear la tabla cabecera: " . mysqli_error($conn) . "<br>";
    }
    
    $sql = "SELECT COUNT(*) FROM cabecera" . $cursoActivo . ";";
    $result = mysqli_query($conn, $sql);
    $fila = mysqli_fetch_array($result, MYSQLI_NUM);
    if ($fila[0] == 1) {
        echo "Los datos de la cabecera" . $cursoActivo . " ya están insertados";
    } else {
        $sql = "INSERT INTO cabecera" . $cursoActivo . " VALUES(";
    
        for ($x = 0; $x < $arrlength; $x++) {
            $var = $datos[$x];
            if ($x != ($arrlength -1)) {
            $sql .= "'$var'" . ", ";
            } else {
            $sql .= "'$var'" . ");";
            }
        }
    
        if (mysqli_query($conn, $sql)) {
            echo "Se han insertado correctamente los datos de las cabecera" . $cursoActivo . "<br>";
        } else {
            echo "Error al insertar los datos de las cabeceras: " . $cursoActivo . mysqli_error($conn) . "<br>";
        }
    }
?>
</body>
</html>