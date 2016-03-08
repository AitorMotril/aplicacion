<?php
    include_once '../config/config.php';
    include_once '../funciones.php';
    protege("jefe" || "administrador");
?>
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
    <header>Página de gestión de notas y estadísticas - Indice</header>      
    <?php
    include_once '../config/config.php';
    include_once '../funciones.php';
    protege("jefe" || "administrador");
    $file = fopen('../1ESO.csv', 'r');
    $cabecerasEncontradas=FALSE;
    $sql = "INSERT INTO notas" . $cursoActivo . " VALUES(";
    while ($datos = fgetcsv($file)) {      
        if(!$cabecerasEncontradas) {
            if($datos[0] == "Alumno/a") {
                $cabecerasEncontradas = TRUE;
                $arrlength = count($datos);
                for ($x = 1; $x < $arrlength; $x++) {
                    $var = $datos[$x];
                    echo $var . "<br>";
                    $sql .=  "$var, ";
                }
            }
        } else if($cabecerasEncontradas) {
            $arrlength = count($datos);
            for ($x = 0; $x < $arrlength; $x++) {
                if ($x = 0) {
                    echo $datos[x];
                } else {
                $var = $datos[$x];
                echo $var . "<br>";
                $sql .= "$var, ";
            }
            }
        }
    }
    echo $sql;
    ?>    
    <img src="/aplicacion/pChart/grafico1.php?Seed=0.75"/>
    </main>
</body>     
</html>