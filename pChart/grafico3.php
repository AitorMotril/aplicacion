<?php
include("class/pData.class.php");
include("class/pDraw.class.php");
include("class/pImage.class.php");

   /* Build the query that will returns the data to graph */
 $conn = mysqli_connect("localhost", "root", "usuario", "nuevabd");
 $sql = "SELECT * FROM usuarios";
 $result  = mysqli_query($sql, $conn);
 $login=""; $nombre=""; $apellidos="";
 while($row = mysqli_fetch_array($result))
  {
   /* Push the results of the query in an array */
   $login[] = $row["login"];
   $nombre[] = $row["nombre"];
   $apellidos[] = $row["apellidos"];
  }
 /* Save the data in the pData array */
 $myData->addPoints($login, "Login");
 $myData->addPoints($nombre, "Nombre");
 $myData->addPoints($apellidos, "Apellidos");

 
  /* Put the timestamp column on the abscissa axis */
 $myData->setAbscissa("Login");
 
  /* Associate the "Humidity" data serie to the second axis */
 $myData->setSerieOnAxis("Nombre", 1);
 /* Name this axis "Time" */
 $myData->setXAxisName("Nombre");
 /* Specify that this axis will display time values */
 // $myData->setXAxisDisplay(AXIS_FORMAT_TIME,"H:i");

  /* First Y axis will be dedicated to the temperatures */
 $myData->setAxisName(0,"Nombre");
 // $myData->setAxisUnit(0,"°C");
 /* Second Y axis will be dedicated to humidity */
 $myData->setAxisName(1,"Apellidos");
 //$myData->setAxisUnit(0,"%");

$myPicture = new pImage(700,230,$myData,TRUE);
$Settings = array("R"=>170, "G"=>183, "B"=>87, "Dash"=>1, "DashR"=>190, "DashG"=>203, "DashB"=>107);
$myPicture->drawFilledRectangle(0,0,700,230,$Settings);

$Settings = array("StartR"=>219, "StartG"=>231, "StartB"=>139, "EndR"=>1, "EndG"=>138, "EndB"=>68, "Alpha"=>50);
$myPicture->drawGradientArea(0,0,700,230,DIRECTION_VERTICAL,$Settings);

$myPicture->drawRectangle(0,0,699,229,array("R"=>0,"G"=>0,"B"=>0));

$myPicture->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>50,"G"=>50,"B"=>50,"Alpha"=>20));

$title = notasalumnox;
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

$dibujo = $_GET['dibujo'];

$Config = array("AroundZero"=>1);
$myPicture->$dibujo($Config);

$Config = array("FontR"=>0, "FontG"=>0, "FontB"=>0, "FontName"=>"fonts/pf_arma_five.ttf", "FontSize"=>6, "Margin"=>6, "Alpha"=>30, "BoxSize"=>5, "Style"=>LEGEND_NOBORDER
, "Mode"=>LEGEND_HORIZONTAL
);
$myPicture->drawLegend(563,16,$Config);

$myPicture->stroke();
?>