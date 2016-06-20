<?php
include_once '../config/config.php';
include_once '../funciones.php';
   
           
   if(isset($_POST['get_option']))
   {
     $curso_id = $_POST['get_option'];
     
     listar_alumnos($curso_id);
//     $sql = "SELECT id_asignatura FROM asignaturas" . $curso_id;
//     $result = mysqli_query($conn, $sql);
//
//     while($row=mysqli_fetch_array($result))
//     {
//       echo $row['id_asignatura'];
//       echo "<option>".$row['id_asignatura']."</option>";
//     }
   
     exit;
   }

?>