<?php include_once 'config/config.php';?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $siteName;?></title>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <script type="text/javascript" src="script/javascript.js"></script>
    <script type="text/javascript" src="../scripts/jquery-2.2.0.min.js"></script>
</head>
<body>
    <div class="menu">
                <ul>
                    <li><a href='index.php'>Inicio</a></li>
                    <li><a href="cerrar.php">Cerrar sesión</a></li>
                </ul>
    </div>
  <div id="lateral">
    <form name="autenticador" method="POST" action="autenticador.php" onsubmit="return validar();">
      <label>Login <input type="text" name="login"></label>
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
  </div>
  <div id="pie"><?php echo $foot;?></div>
</body>
</html>
