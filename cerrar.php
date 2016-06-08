<?php
    include_once 'config/config.php';
    session_start();
    session_destroy();
    header(("Location: " . $urlbase . "index.php"));
?>

