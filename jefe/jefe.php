<?php
    include_once '../config/config.php';
    include_once '../funciones.php';
    protege("jefe" || "administrador");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $siteName;?></title>
    <link rel="stylesheet" type="text/css" href="../css/style.css" />
    <script src="../script/javascript.js"></script>
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
    <header>Página de gestión del jefe de estudios</header>
    
    Página del jefe de estudios
    <br><a href='../cerrar.php'>Cerrar sesión</a> <a href='estadisticas.php'>Crear estadísticas</a>;
    </main>
    <footer><br><hr>Creado por Aitor Igartua Gutierrez, 2ºASIR 2016</footer>
</body>
</html>