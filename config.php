<?php
//Variables de conexión
$servername = "localhost";
$username = "root";
$password = "usuario";
$dbname = "nuevaBD";
//Variables específicas del sitio
$siteName = "Mi Sitio";
$foot = "<br><hr>Mi Sitio<br>" .
        "<a href='regAlumnos.php'>regAlumnos.php</a> " .
        "<a href='instala.php'>instala.php</a> " .
        "<a href='admin.php'>admin.php</a> " .
        "<a href='jefe.php'>jefe.php</a> ";
//Curso actual para las tablas
$cursoActivo = "1516";

function protege($rol) {
    //Crea la sesion o la propaga y verificar las variables de sesion
    session_start();
    if($_SESSION['validar'] != "1" || $_SESSION['rol'] != $rol) {
        session_destroy();
        header("Location: index.php");
    }
}
?>
