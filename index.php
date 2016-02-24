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
            <li><a href='regAlumnos.php'>Registrar alumnos</a></li>
            <li><a href='instalar/instala.php'>Instalador</a></li>
            <li><a href='admin/admin.php'>Admin</a></li>
            <li><a href='jefe/jefe.php'>Jefe de estudios</a></li>
        </ul>
    </nav>
    <main>
    <header>Página de gestión de notas y estadísticas - Indice</header>
    <form name="autenticador" method="POST" action="autenticador.php" onsubmit="return validar();">
      <label>Login <input type="text" name="login"></label><br>
      <label>Password <input type="password" name="password"></label>
      <input type="submit" value="entrar">
      <br>
      <p>
        <?php 
            if($_GET[error] == "si") {
                if($_GET[formularioerror] == "si") {
                    echo "Rellena el formulario";
                } else {
                    echo "Verifica tus datos";
                }
            }
        ?>
      </p>
    </form>   
    </main>
    <footer><br><hr>Creado por Aitor Igartua Gutierrez, 2ºASIR 2016</footer>
</body>
</html>
