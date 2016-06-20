<?php
include("class/pData.class.php");
include("class/pDraw.class.php");
include("class/pImage.class.php");
include_once '../config/config.php';
include '../funciones.php';
protege("jefe" || "administrador");
 
    $temp=$_SESSION['tmp3'];
    $asignatura = $_SESSION['tmp3']['asignatura3'];
    $alumnos = $_SESSION['tmp3']['alumnos3'];
    $curso = $_SESSION['tmp3']['curso3'];

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

    $myData = new pData(); 

    $html = "<table>
      <tr>
        <th>Alumno</th>
        <th>Nota media</th>
        <th>Desviación estándar</th>
        <th>Mediana</th>
        <th>Nota más alta</th>
      </tr>";


    foreach ($series as $key => $value) {


    $myData->addPoints($value,$key);

    $media = round($myData->getSerieAverage($key), 2);
    $maxima = $myData->getMax($key);
    $mediana = $myData->getSerieMedian($key);
    $desviacion = round($myData->getStandardDeviation($key), 2);


    $html .= "<tr><td>$key</td><td>$media</td>"
            . "<td>$desviacion</td><td>$mediana</td>" .
            "<td>$maxima</td></tr>";
    //echo "Nota media de " . $key . ": " . round($myData->getSerieAverage($key), 2) . "<br>";
    //echo "Nota más alta de " . $key . ": " . $myData->getMax($key) . "<br>";
    //echo "Mediana de " . $key . ": " . $myData->getSerieMedian($key) . "<br>";
    //echo "Desviación Estándar " . $key . ": " . round($myData->getStandardDeviation($key), 2) . "<br>";
    //echo "<br>";
    }

    $html .= "</table>";
    echo $html;

exit;

?>
 
 
 