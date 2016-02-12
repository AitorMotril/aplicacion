<?php
if($_POST["login"] && $_POST["password"]) {
    include_once 'config.php';
 // Verificamos la existencia del usuario en la BD
    $conn = mysqli_connect($servername, $username, $password, $dbname) or die("Error en la conexion");
    $sql = "Select * from usuarios where login='$_POST[login]' and password=password('$_POST[password]'); ";
    
   
    $result = mysqli_query($conn, $sql)or die(mysqli_error($conn));

    if(mysqli_num_rows($result) == 1) {
        // Si existe el usuario Creamos la sesion y las variables de sesion
	$fila = mysqli_fetch_array($result,MYSQLI_ASSOC);
        //session_name("gmail");
        session_start();
        $_SESSION["validar"] = "1";
        $_SESSION["login"] = $_POST["login"];
        $_SESSION["rol"] = $fila['rol'];
        if($fila['rol'] == "administrador") {
            header("Location: admin.php");
        } else if($fila['rol'] == "jefe") {
            header("Location: jefe.php");
        }
    } else {
        //echo mysqli_num_rows($result);
        header("Location:index.php?error=si");
    }
} else {
	header("Location:index.php?error=si&formularioerror=si");
}
?>
