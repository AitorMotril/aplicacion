<?php
  // if ($_POST["login"] && $_POST["password"]) {
  if (isset($_POST['autenticar'])) { 
    include_once 'config/config.php';

    $conn = mysqli_connect($servername, $username, $password, $dbname) 
            or die("Error en la conexion" . mysqli_connect_error());
    
    $login = mysqli_real_escape_string($conn, $_POST['login']); 
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $sql = "SELECT * FROM usuarios WHERE login = '$login' "
           . "AND password = password('$password');";

    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    if (mysqli_num_rows($result) == 1) {
      // Si existe el usuario creamos la sesion y las variables de sesion
      $fila = mysqli_fetch_array($result, MYSQLI_ASSOC);
      session_start();
      $_SESSION["validar"] = TRUE;
      $_SESSION["login"] = $login;
      $_SESSION["rol"] = $fila['rol'];
      if ($fila['rol'] == "administrador") {
          header("Location: /eduGraph/admin/admin.php");
      } else if ($fila['rol'] == "jefe") {
          header("Location: /eduGraph/jefe/jefe.php");
      }
      
    } else {
      header("Location: /eduGraph/index.php?error=si");
    }
    
  } else {
    header("Location: /eduGraph/index.php?error=si&formularioerror=si");
  }
?>
