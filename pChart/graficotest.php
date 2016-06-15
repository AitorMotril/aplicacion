<?php
include("class/pData.class.php");
include("class/pDraw.class.php");
include("class/pImage.class.php");
  include_once '../config/config.php';
  include '../funciones.php';

 
function left($value,$NbChar) {
    return substr($value,0,$NbChar); 
}  
 
 function right($value,$NbChar) { 
     return substr($value,strlen($value)-$NbChar,$NbChar); 
     
}  
 
 function mid($value,$Depart,$NbChar) { 
     return substr($value,$Depart-1,$NbChar); 
} 

 function extractColors($Hexa) {
   if ( strlen($Hexa) != 6 ) { 
       return(array(0,0,0)); 
   }

   $R = hexdec(left($Hexa,2));
   $G = hexdec(mid($Hexa,3,2));
   $B = hexdec(right($Hexa,2));

   return(array($R,$G,$B));
}


$temp=$_SESSION['tmp'];
//$leyenda1 = $_GET['asignatura'];
$alumnof = $_GET['alumno'];
$asignaturas = $temp['asignatura'];
$title = $temp['alumno'];
$dibujo = $_GET['dibujo'];
$p_template = $_GET['paleta'];
$g_gradient_enabled = $_GET['g_gradient_enabled'];
$g_gradient_end = $_GET['g_gradient_end'];
$g_gradient_start = $_GET['g_gradient_start'];
$g_gradient_direction = $_GET['g_gradient_direction'];
$g_width = $_GET['g_width'];
$g_height = $_GET['g_height'];

echo "Prueba" . $g_gradient_enabled . $g_gradient_end . $g_gradient_start . $g_gradient_direction;
   

?>