<?php
    session_start();
    session_destroy();
    header("Location: /eduGraph/index.php");
?>

