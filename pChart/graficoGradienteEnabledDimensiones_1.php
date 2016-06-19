<?php
include("class/pData.class.php");
include("class/pDraw.class.php");
include("class/pImage.class.php");
protege("jefe" || "administrador");

$g_gradient_end = $_GET['g_e'];
$g_gradient_start = $_GET['g_s'];
$g_enabled = $_GET['g_en'];
$g_direction = $_GET['g_d'];
$anchura = $_SESSION['tmp']['anchura'];
$altura = $_SESSION['tmp']['altura'];
$anchura = (int)$anchura;
$altura = (int)$altura;

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
$myData->addPoints(array(28,-19,18,4,-2,-31,17,48),"Serie1");
$myData->setSerieDescription("Serie1","Serie 1");
$myData->setSerieOnAxis("Serie1",0);

$myData->addPoints(array(-37,37,-38,16,-4,39,29,6),"Serie2");
$myData->setSerieDescription("Serie2","Serie 2");
$myData->setSerieOnAxis("Serie2",0);

$myData->addPoints(array(16,46,-32,35,32,-15,40,29),"Serie3");
$myData->setSerieDescription("Serie3","Serie 3");
$myData->setSerieOnAxis("Serie3",0);

$myData->addPoints(array("January","February","March","April","May","June","July","August"),"Absissa");
$myData->setAbscissa("Absissa");

$myData->setAxisPosition(0,AXIS_POSITION_LEFT);
$myData->setAxisName(0,"1st axis");
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
$myPicture->drawText($anchura/2,25,"My first pChart project",$TextSettings);

$myPicture->setShadow(FALSE);
$myPicture->setGraphArea(50,50,$anchura-25,$altura-40);
$myPicture->setFontProperties(array("R"=>0,"G"=>0,"B"=>0,"FontName"=>"fonts/pf_arma_five.ttf","FontSize"=>6));

$Settings = array("Pos"=>SCALE_POS_LEFTRIGHT
, "Mode"=>SCALE_MODE_FLOATING
, "LabelingMethod"=>LABELING_ALL
, "GridR"=>255, "GridG"=>255, "GridB"=>255, "GridAlpha"=>50, "TickR"=>0, "TickG"=>0, "TickB"=>0, "TickAlpha"=>50, "LabelRotation"=>0, "CycleBackground"=>1, "DrawXLines"=>1, "DrawSubTicks"=>1, "SubTickR"=>255, "SubTickG"=>0, "SubTickB"=>0, "SubTickAlpha"=>50, "DrawYLines"=>ALL);
$myPicture->drawScale($Settings);

$myPicture->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>50,"G"=>50,"B"=>50,"Alpha"=>10));

$Config = "";
$myPicture->drawSplineChart($Config);

$Config = array("FontR"=>0, "FontG"=>0, "FontB"=>0, "FontName"=>"fonts/pf_arma_five.ttf", "FontSize"=>6, "Margin"=>6, "Alpha"=>30, "BoxSize"=>5, "Style"=>LEGEND_NOBORDER
, "Mode"=>LEGEND_HORIZONTAL
);
$myPicture->drawLegend($anchura-137,16,$Config);

$myPicture->stroke();
?>