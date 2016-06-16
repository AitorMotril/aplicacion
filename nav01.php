<?php 
  include_once 'config/config.php';
  include_once 'funciones.php';
?>
<script type="text/javascript">
  $(document).ready(function () {
  alert($("li a[href='<?php echo substr($urlbase, 0, -1);?>" + location.href.substring(location.href.lastIndexOf("h/") + 1, 255) + "']").selector);
  $("li a[href='<?php echo substr($urlbase, 0, -1);?>" + location.href.substring(location.href.lastIndexOf("h/") + 1, 255) + "']").parent().addClass("active");
});
</script>
<div class="container-fluid">
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>                        
    </button>
    <a class="navbar-brand" href='index.php'><span class="glyphicon glyphicon-home"></span></a>
  </div>
  <div class="collapse navbar-collapse" id="myNavbar">
    <ul class="nav navbar-nav">
      <li><a href='documentacion.php'>Guía de uso</a></li>
      <?php 
        if (check_install()) {
          $curso = check_curso(true);
          $active = echoActiveClassIfRequestMatches('documentacion');
          echo $active;
          echo "<li><a><strong>Curso: '" . $curso . "'</strong></a></li>" .
               "<li" . $active . ">" . "<a><a href='documentacion.php'>Guía de uso</a></li>" .
               "<li><a href='admin/admin.php'>Administrador</a></li>" .
               "<li><a href='jefe/jefe.php'>Jefe de estudios</a></li>" .
               "<li><a href='regAlumnos.php'>Registro de alumnos</a></li>";
        } else {
          echo "<li><a href='instalar/instalar.php'>Instalador</a></li>";
        }
      ?>
    </ul>

    <!-- Menú de iniciar o cerrar sesión -->
    <ul class="nav navbar-nav navbar-right" > 
      <li class="dropdown" id="iniciarSesion">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <span class="glyphicon glyphicon-user"></span><b> Iniciar sesión</b> <span class="caret"></span>
        </a>
        <ul id="login-dp" class="dropdown-menu">
          <li>
            <div class="row">
              <div class="col-md-12">
                <form name="iniciarSesionForm" class="form" role="form" method="post" action="autenticador.php" accept-charset="UTF-8" id="login-nav" >
                  <div class="form-group">
                    <input type="text" name="login" class="form-control" id="loginid" placeholder="Usuario" required />
                  </div>
                  <div class="form-group">
                    <input type="password" name="password" class="form-control" id="passwordid" placeholder="Contraseña" required />
                  </div>
                  <div class="form-group">
                    <button type="submit" name="autenticar" class="btn btn-success btn-block">Iniciar sesión</button>
                  </div>
                </form>
              </div>
            </div>
          </li>
        </ul>
      </li>
      <li id="cerrarSesion"><a href="cerrar.php"><span class="glyphicon glyphicon-log-in"></span> Cerrar Sesión</a></li>
    </ul>
  </div>
</div>
<?php 
  check_sesion();
?>