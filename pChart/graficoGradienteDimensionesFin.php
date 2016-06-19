<?php
include("class/pData.class.php");
include("class/pDraw.class.php");
include("class/pImage.class.php");

$g_gradient_end = $_GET['g_e'];
$g_gradient_start = $_GET['g_s'];
$anchura1 = $_GET['g_an'];
$altura1 = $_GET['g_al'];
$anchura = (int)$anchura1;
$altura = (int)$altura1;

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
$array1 = array(3,5,5);
$serie1 = "Serie numero1";
$myData->addPoints($array1,$serie1);
$myData->setSerieDescription($serie1,$serie1);
$myData->setSerieOnAxis($serie1,0);

$array2 = array(3,7,7);
$serie2 = "Prueba";
$myData->addPoints($array2,$serie2);
$myData->setSerieDescription($serie2,$serie2);
$myData->setSerieOnAxis($serie2,0);

$array3 = array(4,1,1);
$serie3 = "Biología";
$myData->addPoints($array3,$serie3);
$myData->setSerieDescription($serie3,$serie3);
$myData->setSerieOnAxis($serie3,0);

$myData->addPoints(array("1","2","3"),"Absissa");
$myData->setAbscissa("Absissa");

$myData->setAxisPosition(0,AXIS_POSITION_LEFT);
$myData->setAxisName(0,"1st axis");
$myData->setAxisUnit(0,"");

$myPicture = new pImage($anchura,$altura,$myData);
$Settings = array("R"=>170, "G"=>183, "B"=>87, "Dash"=>1, "DashR"=>190, "DashG"=>203, "DashB"=>107);
$myPicture->drawFilledRectangle(0,0,$anchura,$altura,$Settings);

list($StartR,$StartG,$StartB) = extractColors($g_gradient_start);
list($EndR,$EndG,$EndB)       = extractColors($g_gradient_end);

$Settings = array("StartR"=>$StartR, "StartG"=>$StartG, "StartB"=>$StartB, "EndR"=>$EndR, "EndG"=>$EndG, "EndB"=>$EndB, "Alpha"=>50);

//$Settings = array("StartR"=>125, "StartG"=>92, "StartB"=>231, "EndR"=>1, "EndG"=>138, "EndB"=>68, "Alpha"=>50);
$myPicture->drawGradientArea(0,0,$anchura,$altura,DIRECTION_VERTICAL,$Settings);

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