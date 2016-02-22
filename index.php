<?php include_once 'config.php';?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $siteName;?></title>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <script src="script/javascript.js"></script>
</head>
<body>
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
