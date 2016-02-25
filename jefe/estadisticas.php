<html>
    <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../css/style.css" />
</head>
<body>
    <main>
    <header>Página de gestión de notas y estadísticas - Indice</header>      
    <?php
    include_once '../config/config.php';
    include_once '../funciones.php';
    protege("jefe" || "administrador");
    $file = fopen('../1ESO.csv', 'r');
    $cabecerasEncontradas=FALSE;
    while ($datos = fgetcsv($file)) {      
        if(!$cabecerasEncontradas) {
            if($datos[0] == "Alumno/a") {
                $cabecerasEncontradas = TRUE;
                $arrlength = count($datos);
                for ($x = 0; $x < $arrlength; $x++) {
                    $var = $datos[$x];
                    echo $var . "<br>";
                }
        }
        } else if($cabecerasEncontradas) {
        $arrlength = count($datos);
        for ($x = 0; $x < $arrlength; $x++) {
            $var = $datos[$x];
            echo $var . "<br>";
        }
        }
    }
     
    /*
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
    mysqli_query($conn, $sql)or die("Error al crear la tabla alumnos" . mysqli_error($conn));
            
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
    
    mysqli_query($conn, $sql)or die("Error al crear la tabla cabecera" . mysqli_error($conn)); 
    
    $sql = "INSERT INTO cabecera" . $cursoActivo . " VALUES(";
    
    for ($x = 0; $x < $arrlength; $x++) {
        $var = $datos[$x];
        if ($x != ($arrlength -1)) {
        $sql .= "'$var'" . ", ";
        } else {
            $sql .= "'$var'" . ");";
        }
    }
       
    mysqli_query($conn, $sql)or die("Error al insertar datos en la tabla cabecera" . mysqli_error($conn));     
     */
    ?>    
    <!-- <img src="../pChart/grafico1.php?Seed=0.75"/> -->
    </main>
    </body>    
    
</html>