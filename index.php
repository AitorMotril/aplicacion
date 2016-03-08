<?php include_once 'config/config.php';?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $siteName;?></title>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <script type="text/javascript" src="script/javascript.js"></script>
    <script type="text/javascript" src="script/jquery-2.2.1.js"></script>
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
    <form name="autenticador" method="POST" action="autenticador.php" onsubmit="return validar();">
        Login <input type="text" name="login"><br>
        Password<input type="password" name="password"><br>
      <input type="submit" value="entrar"><br>
      <br>
    </form>
        <?php 
            if ($_GET[error] == "si") {
                if ($_GET[formularioerror] == "si") {
                    echo "Rellena el formulario";
                } else {
                    echo "Verifica tus datos";
                }
            }
            if ($_GET[usererror] == "si") {
                echo "No tienes permiso suficiente";
            }
 
        ?>
    <p>
      Página de gestión de alumnos, notas, estadísticas, gráficos... Permite ver estadísticas y gráficos de 
Autenticación con permisos de administrador para poder gestionar los cursos activos y 
          registrar alumnos nuevas, manualmente o mediante la lectura de un formulario csv.
          Autentación como jefe de estudios para poder gestionar las notas de alumnos y realizar gráficos
          con las notas del curso activo o de anteriores.
    </p>
    </main>
    <footer><br><hr>Creado por Aitor Igartua Gutierrez, 2ºASIR 2016</footer>
</body>
</html>
