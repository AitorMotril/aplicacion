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
            
// Cabeceras y pies de página 

document.getElementById("foot01").innerHTML =
  "<p><em>" + new Date().getFullYear() + " eduGraph! creado por Aitor Igartua" +
  "Gutiérrez usando la librería <a href='http://www.pchart.net/' target='_blank'>" +
  "pChart</a></em></p>";
    
$(document).ready(function(){
  $("#toplogo").load("toplogo.php"); 
});        

//$active = "li a[href='" + location.href.substring(location.href.lastIndexOf("h/") + 1, 255) + "']";
$(document).ready(function(){
  $("#nav01").load("nav01.php");
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
