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

    check("login");
    check("password");
    check("nombre");
    check("apellidos");

    return true;
};
