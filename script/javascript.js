function checkForm(formulario) {
  $labels = $(formulario).find("label");
  $inputs = $(formulario).find("input");
  $long = $inputs.length;
  
  for (var i = 0 ; i < $long; i++) {
    $valor = $inputs.eq(i).val();
    $label = $labels.eq(i).text();
    
    if ($valor === null || $valor.length === 0 || /^\s+$/.test($valor) ) {
          alert("Error en campo de formulario: " + $label);
          $inputs.eq(i).css({"color": "red", "border": "2px solid red"});
          $inputs.eq(i).focus();
          return false;
    }
  }
  
  return true;
}

            function rellenaFormulario(arrayDatos)
            {
                // alert(arrayDatos['id']);
                var formulario = document.getElementById("formularioAlumnos");
                var x; $i = 0;
                var elemento;
                for (x in arrayDatos) {
                    elemento = document.getElementsByName(x)[0];
                    elemento.value = arrayDatos[x];
                    if ($i === 2) {   // Le damos el foco al primer elemento
                        elemento.focus();
                        $i = 1;
                    }
                }
            }
            
            
//              $query = "SELECT id, alumno, unidad, fecha_nacimiento "
//                                                . "FROM alumnos_".CURSO_ACTUAL." "
//                                                . "WHERE unidad='$unidad[unidad]' "
//                                                . "ORDER BY alumno;";
//                                        $resul = mysqli_query($GLOBALS['DB_LINK'], $query) or die("Error en la consulta".  mysqli_error($GLOBALS['DB_LINK']));
//
//
//                                        while ($row = mysqli_fetch_array($resul,MYSQLI_ASSOC)) {
//                                            echo "<tr>";
//
//                                            foreach ($row as $valor) {
//                                                echo"<td>$valor</td>"; 
//                                            }
//
//                                            $consultaAlumno="Select * from alumnos" . $cursoActivo . " where id=$id;";
//
//
//                                            $datosConsultaAlumno=mysqli_query($conn, $consultaAlumno);
//                                            $datosAlumno= mysqli_fetch_array($datosConsultaAlumno,MYSQLI_ASSOC);
//                                            echo "<script type='text/javascript'> var array_js_$row[id]=[];";
//
//                                            // Creo el array JS con los datos para cada alumno
//                                            foreach($datosAlumno as $indice => $valor){
//                                                echo "array_js_$row[id]['$indice'] = '$valor';";
//                                            }
//
//                                            echo "</script>";
//                                            echo "<td onclick='$(\"#formularioAlumnos\").show();rellenaFormulario(array_js_$row[id]);'> Actualiza</td>";
//                                            echo "</tr>";

// Cabeceras y pies de página 

document.getElementById("foot01").innerHTML =
"<p><em>" + new Date().getFullYear() + " eduGraph! creado por Aitor Igartua" +
"Gutiérrez usando la librería <a href='http://www.pchart.net/' target='_blank'>" +
"pChart</a></em></p>";
    
$(document).ready(function(){
  $("#toplogo").load("toplogo.php"); 
});        
    
$("#nav01").load("nav01.php", function() {
    $("li a[href='" + location.href.substring(location.href.lastIndexOf("h/") + 1, 255) + "']").parent().addClass("active");
}); 

$(document).ready(function(){
$("#sidebar_jefe").load("jefe/menu_jefe.php");
});
      
function hideShow(boton, elemento) {
  if (boton.innerHTML ===  "Mostrar") {
    boton.innerHTML = "Ocultar";
    $(elemento).show();
  } else {
      boton.innerHTML = "Mostrar";
      $(elemento).hide();
  }
}
