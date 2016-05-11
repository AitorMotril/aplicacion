var miformulario = document.forms[0];
    
function check(campo) {
    valor = miformulario.campo.value;
      if (valor === null || valor.length === 0 || /^\s+$/.test(valor) ) {
          alert("Error en campo de formulario: " + campo);
          miformulario.campo.focus();
          return false;
      }
      
    return true;  
}

function validar() {
    elem = miformulario.elements;
    for (var i = 0; i < elem.length; i++) {
        if (elem[i].type === "text") {
            check(elem[i].name);
        }
    } 
    return true;
};


document.getElementById("foot01").innerHTML =
"<p><em>" + new Date().getFullYear() + " eduGraph! creado por Aitor Igartua Gutiérrez</em></p>";

document.getElementById("nav01").innerHTML = 
    "<div class='container-fluid'>" +
    "<div class='navbar-header'>" +
    "<button type='button' class='navbar-toggle' data-toggle='collapse' data-target='#myNavbar'>" +
    "<span class='icon-bar'></span>" +
    "<span class='icon-bar'></span>" +
    "<span class='icon-bar'></span>" +
    "</button></div>" +
    "<div class='collapse navbar-collapse' id='myNavbar'>" +
    "<ul class='nav navbar-nav'>" +
    "<li class='w3-large'><a href='/eduGraph'><i class='fa fa-home'></i></a></li>" +
    "<li><a href='/eduGraph/instalar/instala.php'>Instalador</a></li>" +
    "<li><a href='/eduGraph/admin/admin.php'>Administrador</a></li>" +
    "<li><a href='/eduGraph/jefe/jefe.php'>Jefe de estudios</a></li>" +
    "<li><a href='/eduGraph/regAlumnos.php'>Registro de alumnos</a></li></ul>" +
    "<ul class='nav navbar-nav navbar-right'>" +
    "<li><a href='/eduGraph'><span class='glyphicon glyphicon-log-in'></span> Iniciar sesión</a></li>" +
    "</ul></div></div>";
    
document.getElementById("toplogo").innerHTML =
    "<div class='w3-row w3-white w3-padding'>" +
    "<div class='w3-half' style='margin:4px 0 6px 0'>" +
    "<a href='/eduGraph'><img src='/eduGraph/img/eduGraphv1.png' alt='eduGraph'></a></div>" +
    "<div class='w3-half w3-wide w3-hide-medium w3-hide-small' style='margin-top:40px;'>" +
    "<div class='w3-right'>GRÁFICOS Y GESTIÓN DE NOTAS PARA INSTITUTOS</div></div>";