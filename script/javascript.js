var miformulario = document.regAlumnos;
    
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
        if (elem[i].type = "text") {
            check(elem[i].name);
        }
    } 
    return true;
};
