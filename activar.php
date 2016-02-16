<?php
    include_once 'config.php';
    $cursoactivo = 1516;
    $file = fopen('RegAlumAitor.csv', 'r');
    $datos = fgetcsv($file, 0, ',', '"');
    $arrlength = count($datos);
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
    echo $sql;
    
    
    
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
    echo "<br><br>" . $sql;

    $sql = "INSERT INTO cabecera" . $cursoactivo . " VALUES(";
    for ($x = 0; $x < $arrlength; $x++) {
        $var = $datos[$x];
        if ($x != ($arrlength -1)) {
        $sql .= $var . ", ";
        } else {
            $sql .= $var . ");";
        }
    }
    echo "<br><br>" . $sql;
       
    //Al regAlumnos.php, le quiero pedir que mande el formulario al curso
    //Creo variable
    $activo = 1;
?>