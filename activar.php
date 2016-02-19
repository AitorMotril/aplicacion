<?php
    include_once 'config.php';
    $cursoactivo = 1516;
    $file = fopen('RegAlumAitor.csv', 'r');
    $datos = fgetcsv($file, 0, ',', '"');
    $arrlength = count($datos);
    $conn = mysqli_connect($servername, $username, $password);
    $sql = "USE $dbname; CREATE TABLE IF NOT EXISTS alumnos" . $cursoactivo . " (";
    for ($x = 0; $x < $arrlength; $x++) {
        $var = $datos[$x];
        $var = sanear_string($var);
        if ($x != ($arrlength - 1)) {
            $sql .= $var . " VARCHAR(40)" . ", ";
            } else {
                $sql .= $var . " VARCHAR(40)" . ");";
            }
    }
    
    mysqli_query($conn, $sql)or die("error al crear la tabla curso activo" . mysqli_error($conn));
      
    $sql = "USE dbname; CREATE TABLE IF NOT EXISTS cabecera" . $cursoactivo . " (";
    
    for ($x = 0; $x < $arrlength; $x++) {
        $var = $datos[$x];
        $var = sanear_string($var);
        if ($x != ($arrlength - 1)) {
            $sql .= $var . " VARCHAR(40)" . ", ";
            } else {
                $sql .= $var . " VARCHAR(40)" . ");";
            }
    }

    mysqli_query($conn, $sql)or die("error al crear la tabla cabecera" . mysqli_error($conn)); 

    $sql = "INSERT INTO cabecera" . $cursoactivo . " VALUES(";
    for ($x = 0; $x < $arrlength; $x++) {
        $var = $datos[$x];
        if ($x != ($arrlength -1)) {
        $sql .= $var . ", ";
        } else {
            $sql .= $var . ");";
        }
    }
    
    mysqli_query($conn, $sql)or die("error al insertar valores en la tabla cabecera" . mysqli_error($conn));
       
    //Al regAlumnos.php, le quiero pedir que mande el formulario al curso
    //Creo variable
    $activo = 1;
?>