<?php
    session_start();
    session_destroy();
    header("Location: /aplicacion/index.php");
?>

