<?php 
  include_once 'config/config.php';
  include_once 'funciones.php';
?>
<script type="text/javascript">
  $(document).ready(function () {
  $("li a[href='/eduGraph" + location.href.substring(location.href.lastIndexOf("h/") + 1, 255) + "']").parent().addClass("active");
});
</script>
<div class="container-fluid">
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>                        
    </button>
  <a class="navbar-brand" href='/eduGraph/index.php'><span class="glyphicon glyphicon-home"></span></a>
  </div>
  <div class="collapse navbar-collapse" id="myNavbar">
    <ul class="nav navbar-nav">
      <li><a href='/eduGraph/instalar/instala.php'>Instalador</a></li>
      <li><a href='/eduGraph/admin/admin.php'>Administrador</a></li>
      <li><a href='/eduGraph/jefe/jefe.php'>Jefe de estudios</a></li>
      <li><a href='/eduGraph/regAlumnos.php'>Registro de alumnos</a></li>
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
                <form name="iniciarSesionForm" class="form" role="form" method="post" action="/eduGraph/autenticador.php" accept-charset="UTF-8" id="login-nav" >
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
              <div class="bottom text-center">
                ¿No tienes cuenta? <a href="registrar.php"><b>Regístrate aquí</b></a>
              </div>
            </div>
          </li>
        </ul>
      </li>
      <li id="cerrarSesion"><a href="/eduGraph/cerrar.php"><span class="glyphicon glyphicon-log-in"></span> Cerrar Sesión</a></li>
    </ul>
  </div>
</div>
<?php 
  check_sesion();
?>