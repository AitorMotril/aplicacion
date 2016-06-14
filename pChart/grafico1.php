<?php
include("class/pData.class.php");
include("class/pDraw.class.php");
include("class/pImage.class.php");
  include_once '../config/config.php';
  include '../funciones.php';
 protege("jefe" || "administrador");
 
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

//$asignaturas_length = count($asignaturas);
//$notas_length = count($notas);
//$alumnos_length = count($alumnos);
//
//$myData = new pData();
//
//
//for ($x = 0; $x < $asignaturas_length; $x++) {
//  $leyenda[$x] = $asignaturas[$x];
//  $array[$x] = $notas[$x];
//  $myData->addPoints($array[$x],$leyenda[$x]);
//  $myData->setSerieDescription($leyenda[$x],$leyenda[$x]);
//  $myData->setSerieOnAxis($leyenda[$x],0);
//}
//
//$trimestres_length = count($trimestres);
//
//for ($x = 0; $x < $trimestres_length; $x++) {
//  $myData->addPoints(array("$x"),"Absissa");
//}

$temp=$_SESSION['tmp'];
//$leyenda1 = $_GET['asignatura'];
$alumnof = $_GET['alumno'];
$asignaturas = $temp['asignatura'];
$title = $temp['alumno'];
$dibujo = $_GET['dibujo'];
$p_template = $_GET['paleta'];
//$g_gradient_enabled = $_GET['g_gradient_enabled'];
//$g_gradient_end = $_GET['g_gradient_end'];
//$g_gradient_start = $_GET['g_gradient_start'];
//$g_gradient_direction = $_GET['g_gradient_direction'];
//$g_width = $_GET['g_width'];
//$g_height = $_GET['g_height'];
   
$conn = mysqli_connect($servername, $username, $password, $dbname);

$series=array();
foreach ($asignaturas as $key => $value) {
$cursoActivo = 0;    

$sql = "SELECT Nota FROM notas" . $cursoActivo . " WHERE N_Id_Escolar = $alumnof 
        AND id_asignatura = '$value';";
$result = mysqli_query($conn, $sql) or die("Error en el sql");
  $series[$value]=array();
  while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
    $series[$value][] = $row[0];
    }
}


$myData = new pData();

if ($p_template != "default" ) {
  $myData->loadPalette("palettes/".$p_template.".color",TRUE);
}

 
//  if ( $g_gradient_enabled == "on" )
//  {
//   str_replace("#","",$g_gradient_start);
//   str_replace("#","",$g_gradient_end);
//   list($StartR,$StartG,$StartB) = extractColors($g_gradient_start);
//   list($EndR,$EndG,$EndB)       = extractColors($g_gradient_end);
//
//   $Settings = array("StartR"=>$StartR,"StartG"=>$StartG,"StartB"=>$StartB,"EndR"=>$EndR,"EndG"=>$EndG,"EndB"=>$EndB,"Alpha"=>50);
//
//     if ( $g_gradient_direction == "vertical" ) {
//      $myPicture->drawGradientArea(0,0,$g_width,$g_height,DIRECTION_VERTICAL,$Settings);
//     } 
//     else {
//      $myPicture->drawGradientArea(0,0,$g_width,$g_height,DIRECTION_HORIZONTAL,$Settings);
//     }
//
//  }
foreach ($series as $key => $value) {
    

$myData->addPoints($value,$key);
$myData->setSerieDescription($key,$key);
$myData->setSerieOnAxis($key,0);
}
//$array2 = array(-24,10,16);
//$leyenda2 = "Serie2";
//
//$myData->addPoints($array2,$leyenda2);
//$myData->setSerieDescription($leyenda2,$leyenda2);
//$myData->setSerieOnAxis($leyenda2,0);
//
//$array3 = array(-8,22,-45);
//$leyenda3 = "Serie3";
//        
//$myData->addPoints($array3,$leyenda3);
//$myData->setSerieDescription($leyenda3,$leyenda3);
//$myData->setSerieOnAxis($leyenda3,0);

$myData->addPoints(array("1","2","3"),"Absissa");
$myData->setAbscissa("Absissa");

$myData->setAxisPosition(0,AXIS_POSITION_LEFT);
$myData->setAxisName(0,"1st axis");
$myData->setAxisUnit(0,"");

$myPicture = new pImage(700,230,$myData,TRUE);
$Settings = array("R"=>170, "G"=>183, "B"=>87, "Dash"=>1, "DashR"=>190, "DashG"=>203, "DashB"=>107);
$myPicture->drawFilledRectangle(0,0,700,230,$Settings);

$Settings = array("StartR"=>219, "StartG"=>231, "StartB"=>139, "EndR"=>1, "EndG"=>138, "EndB"=>68, "Alpha"=>50);
$myPicture->drawGradientArea(0,0,700,230,DIRECTION_VERTICAL,$Settings);

$myPicture->drawRectangle(0,0,699,229,array("R"=>0,"G"=>0,"B"=>0));

$myPicture->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>50,"G"=>50,"B"=>50,"Alpha"=>20));

$myPicture->setFontProperties(array("FontName"=>"fonts/Forgotte.ttf","FontSize"=>14));
$TextSettings = array("Align"=>TEXT_ALIGN_MIDDLEMIDDLE
, "R"=>255, "G"=>255, "B"=>255);
$myPicture->drawText(350,25,$title,$TextSettings);

$myPicture->setShadow(FALSE);
$myPicture->setGraphArea(50,50,675,190);
$myPicture->setFontProperties(array("R"=>0,"G"=>0,"B"=>0,"FontName"=>"fonts/pf_arma_five.ttf","FontSize"=>6));

$Settings = array("Pos"=>SCALE_POS_LEFTRIGHT
, "Mode"=>SCALE_MODE_FLOATING
, "LabelingMethod"=>LABELING_ALL
, "GridR"=>255, "GridG"=>255, "GridB"=>255, "GridAlpha"=>50, "TickR"=>0, "TickG"=>0, "TickB"=>0, "TickAlpha"=>50, "LabelRotation"=>0, "CycleBackground"=>1, "DrawXLines"=>1, "DrawSubTicks"=>1, "SubTickR"=>255, "SubTickG"=>0, "SubTickB"=>0, "SubTickAlpha"=>50, "DrawYLines"=>ALL);
$myPicture->drawScale($Settings);

$myPicture->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>50,"G"=>50,"B"=>50,"Alpha"=>10));


$Config = array("AroundZero"=>1);
$myPicture->$dibujo($Config);

$Config = array("FontR"=>0, "FontG"=>0, "FontB"=>0, "FontName"=>"fonts/pf_arma_five.ttf", "FontSize"=>6, "Margin"=>6, "Alpha"=>30, "BoxSize"=>5, "Style"=>LEGEND_NOBORDER
, "Mode"=>LEGEND_VERTICAL
, "Family"=>LEGEND_FAMILY_LINE
);
$myPicture->drawLegend(500,10,$Config);

$myPicture->stroke();
?>