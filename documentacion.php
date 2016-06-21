<?php
  include_once 'config/config.php';
  include_once 'funciones.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Guía de uso | eduGraph!</title>
  <base href='<?php echo $urlbase; ?>' target='_self'>
  <?php echo $header; ?>
</head>

<body id="page-top">

  <!-- Cabecera con la imagen de logo y el lema de la página -->
  <div class="container-fluid clearfix" id="toplogo"></div>

  <!-- Menú superior de navegación fijo -->
  <nav class="navbar navbar-inverse" data-spy="affix" data-offset-top="77" id="nav01"></nav>

  <!-- Cabecera de la página y texto -->
  <div class="container-fluid">
    <h3 class="bg-3">Guía de uso</h3>
<div class="row">
    <div class="col-md-2">
      <div class="list-group" id="sidebar">
        <a class="list-group-item">Instalación</a>
        <a class="list-group-item">Activacion de cursos</a>
        <a class="list-group-item">Guia jefe de estudios</a>
      </div>
    </div>
    <div class="col-md-10">
      <div class="container-fluid well well-sm">
      <h4>Guía de instalación</h4> 
        <p>
          La instalacion es sencilla, aparece un formulario dividido en tres páginas en las que
          nos solicitará los datos de nuestra base de datos: el servidor en el que está alojada,
          un usuario con permisos de acceso y su contraseña, y el nombre de la base, se creará de cero
          si no existe, lo que se recomienda.
        </p>
        <p>
          Luego nos pide el directorio raíz donde estará la aplicación, es muy importante que esté correcto
          ya que los enlaces no funcionarán si no, no debe llevar ninguna /
        </p>
        <p>
          Por último necesitamos darles claves al usuario de administración, login 'administrador', y
          al usuario para el jefe de estudios, login 'jefe'
        </p>
      </div> <!-- /. end div container-fluid with the form -->
            <div class="container-fluid well well-sm">
      <h4>Guía de activación</h4> 
        <p>
          Una vez la aplicación esté instalada, nos redirige a una página informándonos de la instalación,
          y de que el próximo paso a a seguir es activar un curso. Para ello debe conectarse el administrador,
          y tiene dos opciones: activar un curso de prueba con datos predefinidos, o activar un curso real
          con datos en un CSV de Séneca.
        </p>
      </div> <!-- /. end div container-fluid with the form -->
                  <div class="container-fluid well well-sm">
      <h4>Jefe de estudios</h4> 
        <p>
          El jefe de estudios es el que tiene más opciones de uso, realización de gráficos, subida de notas,
          registro de alumnos... <strong>Importante destacar que el administrador puede también acceder 
          a las funciones del jefe de estudios.</strong>
        </p>
        <p>
          El primer paso del jefe de estudios, si el administrador ya ha activado un curso, debería ser 
          registrar alumnos y subir notas. Para ello dentro de la página del jefe de estudios, hay un apartado registro de
          alumnos, en el que se recomienda cargar por medio de un fichero CSV de Séneca datos de alumnos.
        </p>
        <p>
          Una vez los alumnos estén en la base de datos, se pueden subir sus notas, usando el formulario de notas
          y también con un archivo CSV de Séneca, y luego se puede proceder a realizar gráficos de esos alumnos: gráficos
          con las notas en varias asignaturas de un alumno, o las notas de varios alumnos para una misma asignatura.
        </p>
      </div> <!-- /. end div container-fluid with the form -->
      
    </div>
  </div> <!-- /. end div row -->
  </div>

  <!-- Pie de página -->
  <div class="container-fluid bg-4 text-center" id='foot01'></div>
  <script src="script/script.js"></script>
</body>
</html>
