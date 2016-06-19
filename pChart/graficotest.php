<?php
include("class/pData.class.php");
include("class/pDraw.class.php");
include("class/pImage.class.php");
  include_once '../config/config.php';
  include '../funciones.php';
  protege("jefe" || "administrador");

 
function left($value,$NbChar) {
    return substr($value,0,$NbChar); 
    echo "left" . substr($value,0,$NbChar); 
}  
 
 function right($value,$NbChar) { 
     return substr($value,strlen($value)-$NbChar,$NbChar); 
     echo "right" . substr($value,strlen($value)-$NbChar,$NbChar); 
     
}  
 
 function mid($value,$Depart,$NbChar) { 
     return substr($value,$Depart-1,$NbChar); 
     echo "mid" . substr($value,$Depart-1,$NbChar); 
} 

 function extractColors($Hexa) {
   if ( strlen($Hexa) != 6 ) { 
       return(array(0,0,0)); 
       print_r(array(0,0,0));
   }

   $R = hexdec(left($Hexa,2));
   $G = hexdec(mid($Hexa,3,2));
   $B = hexdec(right($Hexa,2));

   return(array($R,$G,$B));
   print_r(array($R,$G,$B));
}


$temp=$_SESSION['tmp2'];
$g_gradient_end = $_GET['g_e'];
$g_gradient_start = $_GET['g_s'];
$g_enabled = $_GET['g_en'];
$g_direction = $_GET['g_d'];
$p_template = $_GET['p'];
$dibujo = $_GET['d'];
$g_width1 = $_GET['g_an'];
$g_height1 = $_GET['g_al'];
$title = $_GET['asignatura'];
$g_width = (int)$g_width1;
$g_height = (int)$g_height1;


//$leyenda1 = $_GET['asignatura'];
$asignatura = $_GET['asignatura'];
$alumnos = $_SESSION['tmp2']['alumno'];
$curso = $_GET['curso'];


$conn = mysqli_connect($servername, $username, $password, $dbname);

print_r($alumnos);
$series = array();
foreach ($alumnos as $key => $value) {
  
  echo "Llave" . $key . "Valor" . $value;
  
        $sql_alumno = "SELECT N_Id_Escolar FROM alumnos" . $curso . 
                " WHERE Alumnoa = " . "'$value'" . ";";
      $result_alumno = mysqli_query($conn, $sql_alumno);
      $row = mysqli_fetch_array($result_alumno, MYSQLI_NUM);
      $value2 = $row[0];  
  
$sql = "SELECT Nota FROM notas" . $curso . " WHERE N_Id_Escolar = '$value2' 
        AND id_asignatura = '$asignatura';";
$result = mysqli_query($conn, $sql) or die("Error en el sql");
  $series[$value]=array();
  while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
    $series[$value][] = $row[0];
    }
}

//print_r($series);
//
//if ( $g_gradient_enabled == "on" )
//  {
//   list($StartR,$StartG,$StartB) = extractColors($g_gradient_start);
//   list($EndR,$EndG,$EndB)       = extractColors($g_gradient_end);
//
//   
//   echo $StartR . " ";
//   echo $StartG . " ";
//   echo $StartB . " ";
//   echo $EndR . " ";
//   echo $EndG . " ";
//   echo gettype($EndB) . $EndB . " ";
//   $Settings = array("StartR"=>$StartR,"StartG"=>$StartG,"StartB"=>$StartB,"EndR"=>$EndR,"EndG"=>$EndG,"EndB"=>$EndB,"Alpha"=>50);
//   $Settings2 = array("StartR"=>255, "StartG"=>0, "StartB"=>0, "EndR"=>1, "EndG"=>138, "EndB"=>68, "Alpha"=>50);
//   
//   if ( $g_gradient_direction == "vertical" ) {
//     echo "Vertical";
//      //$myPicture->drawGradientArea(0,0,700,230,DIRECTION_VERTICAL,$Settings);
//     } 
//     else {
//       echo "Horizontal";
////      $myPicture->drawGradientArea(0,0,700,230,DIRECTION_HORIZONTAL,$Settings);
//     }
//  }
//  

print_r($series);
 

foreach ($series as $key => $value) {
    
echo "<br>" . gettype($key);
echo "myData->addPoints($value,'$key');";
echo "myData->setSerieDescription('$key','$key');";
echo "myData->setSerieOnAxis('$key',0);";
}
//echo "Probando";
//$myPicture = new pImage($g_width,$g_height);
//echo gettype($g_height);
//echo $myPicture->getWidth();
//echo $myPicture->getHeight();
//$myPicture2 = new pImage(700,$g_height2);
//echo gettype($g_height2);
//echo $myPicture2->getHeight();
//echo "Tipo de " . gettype($myPicture2->getWidth());

?>