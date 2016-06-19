<?php
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Fecha en el pasado
    $cursoP = array(
        'nombreCursoActivo' => '2015-2016',
        'cursoActivo' => 1718,
     );
    echo json_encode($cursoP);
?>