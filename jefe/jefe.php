<?php
    include_once '../config/config.php';
    include_once '../funciones.php';
    protege("jefe" || "administrador");
    echo "Página del jefe de estudios";
    echo "<a href='../cerrar.php'>Cerrar</a>";
    echo "<a href='estadisticas.php'>Crear estadísticas</a>";
?>