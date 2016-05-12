  <?php
  
  $cabecerasEncontradas=FALSE; //fijamos el control de encontrar la cabecera
  
  $file=fopen("1ESO.csv","r");
    $sql="INSERT INTO TABLA (";
    while ($datos = fgetcsv($file)) {  //leemos una línea en formato csv     
          if(!$cabecerasEncontradas){
			if($datos[0] == "Alumno/a"){ // Cabecera encontrada
                $cabecerasEncontradas = TRUE;
                $arrlength = count($datos);
                for ($x = 0; $x < $arrlength; $x++) { // Cogemos todos los códigos de asignaturas
                    $var = $datos[$x];
                    $sql .=  "$var,";
				}
				$sql= substr($sql, 0, -1); // quitamos la coma sobrante
				$sql.=") VALUES (";
			}
		}else{
			$arrlength = count($datos);
			for ($x = 0; $x < $arrlength; $x++) {
              $var = $datos[$x];       
              $sql .= "'$var',"; //metemos todos los valores de un alumno
            }
            $sql= substr($sql, 0, -1); //quitamos la coma sobrante
			$sql.="),(";// empezamos otro registro
          }
        }
		 $sql= substr($sql, 0, -2); // quitamos lo sobrante del último registro
		$sql.=";";
        echo $sql;
 ?>
    
