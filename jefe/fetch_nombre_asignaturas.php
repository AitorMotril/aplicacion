<?php
include_once '../config/config.php';
   
           
   if(isset($_POST['get_option']))
   {
           
     $conn = mysqli_connect($servername, $username, $password, $dbname);

     $asignatura_id = $_POST['get_option'];
     $sql = "select nombre_completo from asignaturas1 where id_asignatura='$asignatura_id'";
     $result = mysqli_query($conn, $sql);

     while($row=mysqli_fetch_array($result))
     {
       echo $row['nombre_completo'];
     }
   
     exit;
   }

?>