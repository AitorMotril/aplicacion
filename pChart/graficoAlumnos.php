<?php
include("class/pData.class.php");
include("class/pDraw.class.php");
include("class/pImage.class.php");
  include_once '../config/config.php';
include '../funciones.php';
protege("jefe" || "administrador");

$temp=$_SESSION['tmp2'];
$g_gradient_end = $_GET['g_e'];
$g_gradient_start = $_GET['g_s'];
$g_enabled = $_GET['g_en'];
$g_direction = $_GET['g_d'];
$p_template = $_GET['p'];
$dibujo = $_GET['d'];
$anchura1 = $_GET['g_an'];
$altura1 = $_GET['g_al'];
$title = $_GET['asignatura'];
$valores = $_GET['val'];
$anchura = (int)$anchura1;
$altura = (int)$altura1;


//$leyenda1 = $_GET['asignatura'];
$asignatura = $_GET['asignatura'];
$alumnos = $_SESSION['tmp2']['alumnos'];
$curso = $_GET['curso'];

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

$myData = new pData();
if ($p_template != "default" ) {
  $myData->loadPalette("palettes/".$p_template.".color",TRUE);
}

$conn = mysqli_connect($servername, $username, $password, $dbname);

$series = array();
foreach ($alumnos as $key => $value) {
  
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

foreach ($series as $key => $value) {
    

$myData->addPoints($value,$key);
$myData->setSerieDescription($key,$key);
$myData->setSerieOnAxis($key,0);
}

//$myData->addPoints(array(28,-19,18,4,-2,-31,17,48),"Serie1");
//$myData->setSerieDescription("Serie1","Serie 1");
//$myData->setSerieOnAxis("Serie1",0);
//
//$myData->addPoints(array(-37,37,-38,16,-4,39,29,6),"Serie2");
//$myData->setSerieDescription("Serie2","Serie 2");
//$myData->setSerieOnAxis("Serie2",0);
//
//$myData->addPoints(array(16,46,-32,35,32,-15,40,29),"Serie3");
//$myData->setSerieDescription("Serie3","Serie 3");
//$myData->setSerieOnAxis("Serie3",0);

$myData->addPoints(array("1er Trimestre","2ndo Trimestre","3er Trimestre"),"Absissa");
$myData->setAbscissa("Absissa");

$myData->setAxisPosition(0,AXIS_POSITION_LEFT);
$myData->setAxisName(0,"Notas");
$myData->setAxisUnit(0,"");

$myPicture = new pImage($anchura,$altura,$myData);
$Settings = array("R"=>170, "G"=>183, "B"=>87, "Dash"=>1, "DashR"=>190, "DashG"=>203, "DashB"=>107);
$myPicture->drawFilledRectangle(0,0,$anchura,$altura,$Settings);

if ($g_enabled == "on") {

list($StartR,$StartG,$StartB) = extractColors($g_gradient_start);
list($EndR,$EndG,$EndB)       = extractColors($g_gradient_end);

$Settings = array("StartR"=>$StartR, "StartG"=>$StartG, "StartB"=>$StartB, "EndR"=>$EndR, "EndG"=>$EndG, "EndB"=>$EndB, "Alpha"=>50);

//$Settings = array("StartR"=>125, "StartG"=>92, "StartB"=>231, "EndR"=>1, "EndG"=>138, "EndB"=>68, "Alpha"=>50);

if ($g_direction == "vertical") {
$myPicture->drawGradientArea(0,0,$anchura,$altura,DIRECTION_VERTICAL,$Settings);
} else {
  $myPicture->drawGradientArea(0,0,$anchura,$altura,DIRECTION_HORIZONTAL,$Settings);
}

} else {
  $Settings = array("StartR"=>219, "StartG"=>231, "StartB"=>139, "EndR"=>1, "EndG"=>138, "EndB"=>68, "Alpha"=>50);
  $myPicture->drawGradientArea(0,0,$anchura,$altura,DIRECTION_VERTICAL,$Settings);
}

$myPicture->drawRectangle(0,0,$anchura-1,$altura-1,array("R"=>0,"G"=>0,"B"=>0));

$myPicture->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>50,"G"=>50,"B"=>50,"Alpha"=>20));

$myPicture->setFontProperties(array("FontName"=>"fonts/Forgotte.ttf","FontSize"=>14));
$TextSettings = array("Align"=>TEXT_ALIGN_MIDDLEMIDDLE
, "R"=>255, "G"=>255, "B"=>255);
$myPicture->drawText($anchura/2,25,$title,$TextSettings);

$myPicture->setFontProperties(array("FontName"=>"fonts/Forgotte.ttf","FontSize"=>10));
$TextSettings = array("Align"=>TEXT_ALIGN_MIDDLEMIDDLE
, "R"=>0, "G"=>0, "B"=>0);
$myPicture->drawText($anchura/2,$altura-20,"Evaluaciones",$TextSettings);

$myPicture->setShadow(FALSE);
$myPicture->setGraphArea(50,50,$anchura-25,$altura-40);
$myPicture->setFontProperties(array("R"=>0,"G"=>0,"B"=>0,"FontName"=>"fonts/pf_arma_five.ttf","FontSize"=>6));

//$Settings = array("Pos"=>SCALE_POS_LEFTRIGHT
//, "Mode"=>SCALE_MODE_FLOATING
//, "LabelingMethod"=>LABELING_ALL
//, "GridR"=>255, "GridG"=>255, "GridB"=>255, "GridAlpha"=>50, "TickR"=>0, "TickG"=>0, "TickB"=>0, "TickAlpha"=>50, "LabelRotation"=>0, "CycleBackground"=>1, "DrawXLines"=>1, "DrawSubTicks"=>1, "SubTickR"=>255, "SubTickG"=>0, "SubTickB"=>0, "SubTickAlpha"=>50, "DrawYLines"=>ALL);
//$myPicture->drawScale($Settings);

$AxisBoundaries = array(0=>array("Min"=>0,"Max"=>10));
$ScaleSettings  = array("Mode"=>SCALE_MODE_MANUAL,"ManualScale"=>$AxisBoundaries,"DrawSubTicks"=>TRUE,"DrawArrows"=>TRUE,"ArrowSize"=>6);
$myPicture->drawScale($ScaleSettings);

$myPicture->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>50,"G"=>50,"B"=>50,"Alpha"=>10));

if ($valores == "on") {
$Config = array("DisplayValues"=>1);
} else {
  $Config = "";
}
$myPicture->$dibujo($Config);

//$Config = array("FontR"=>0, "FontG"=>0, "FontB"=>0, "FontName"=>"fonts/pf_arma_five.ttf", "FontSize"=>6, "Margin"=>6, "Alpha"=>30, "BoxSize"=>5, "Style"=>LEGEND_NOBORDER
//, "Mode"=>LEGEND_HORIZONTAL
//);
$Config = array("FontR"=>0, "FontG"=>0, "FontB"=>0, "FontName"=>"fonts/pf_arma_five.ttf", "FontSize"=>6, "Margin"=>6, "Alpha"=>30, "BoxSize"=>5, "Style"=>LEGEND_NOBORDER
, "Mode"=>LEGEND_VERTICAL
, "Family"=>LEGEND_FAMILY_LINE
);
$myPicture->drawLegend($anchura-200,6,$Config);

$myPicture->stroke();
?>