<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../css/style.css" />
</head>
<body>   
    <nav>
        <ul>
            <li><a href='/aplicacion/index.php'>Indice</a></li>
            <li><a href='/aplicacion/regAlumnos.php'>Registrar alumnos</a></li>
            <li><a href='/aplicacion/instalar/instala.php'>Instalador</a></li>
            <li><a href='/aplicacion/admin/admin.php'>Admin</a></li>
            <li><a href='/aplicacion/jefe/jefe.php'>Jefe de estudios</a></li>
        </ul>
    </nav>
    <main>
    <header>Página de gestión de notas y estadísticas - Activacion de cursos</header>    
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
    
    $sql = "CREATE TABLE IF NOT EXISTS asignaturas" . $cursoActivo . " ( "
            . "id_asignatura VARCHAR(10) NOT NULL PRIMARY KEY) ENGINE=InnoDB;";
            
    if (mysqli_query($conn, $sql)) {
        echo "La tabla asignaturas" . $cursoActivo . " se ha creado correctamente o ya existía" . "<br>";
    } else {
        echo "Error al crear la tabla asignaturas: " . mysqli_error($conn) . "<br>";
    }
    
    $sql = "CREATE TABLE IF NOT EXISTS notas" . $cursoActivo . " ( " .
           "Alumnoa VARCHAR(40) NOT NULL,
           Trimestre VARCHAR(10) NOT NULL,
           id_asignatura VARCHAR(10) NOT NULL,
           Nota INT) ENGINE=InnoDB;";
              
    if (mysqli_query($conn, $sql)) {
        echo "La tabla notas" . $cursoActivo . " se ha creado correctamente o ya existía" . "<br>";
    } else {
        echo "Error al crear la tabla notas: " . mysqli_error($conn) . "<br>";
    }      
  
    $sql = "SELECT COUNT(*) FROM cabecera" . $cursoActivo . ";";
    $result = mysqli_query($conn, $sql);
    $fila = mysqli_fetch_array($result, MYSQLI_NUM);
    if ($fila[0] == 1) {
        echo "Los datos de la cabecera" . $cursoActivo . " ya están insertados" . "<br>";
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

echo "<a href='../index.php'>Volver al índice</a>";
?>
</main>
    <footer><br><hr>Creado por Aitor Igartua Gutierrez, 2ºASIR 2016</footer>
</body>
</html>