<?php
  include_once '../funciones.php';
  include_once '../config/config.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>eduGraph! Instalación</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css" />
  <link rel="stylesheet" href="../css/style.css" />
  <link rel="icon" href="../img/iconv1.png" type="image/x-icon">
  <script src="../script/jquery.min.js"></script>
  <script src="../bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
<?php
  $confi = fopen("../config/config.php", "a") or die("Unable to open file!");
  
  if (check_install_db()) {
    header(("Location: " . $urlbase .  "instalar/instalada.php"));
  } else {
  
    if (isset($_POST['crear_db'])) {
      
      $servername = $_POST['db_servidor'];
      $username = $_POST['db_usuario'];
      $password = $_POST['db_clave'];
      $dbname = $_POST['db_nombre'];
      $urlbase = "/" . $_POST['urlbase'] . "/";
      $admin_clave = $_POST['admin_clave'];
      $jefe_clave = $_POST['jefe_clave'];
      
//      echo "<script>$(document).ready(function(){" . "$('#instalacion').hide();});</script>";

      // Variable de instalación de la aplicación, salta a cero si hay algún error
      $instalar = 1;

      $conn = mysqli_connect($servername, $username, $password);

      if (!$conn) {
        $instalar = 0;
        echo "Conexión fallada: " . mysqli_connect_error() . "<br>";
      } 

      $sql = "CREATE DATABASE IF NOT EXISTS $dbname;";

      if (!mysqli_query($conn, $sql)) {
        $instalar = 0;
        echo "Error creando la base de datos: " . mysqli_error($conn) . "<br>";
      }

      $sql = "USE $dbname;";

      if (!mysqli_query($conn, $sql)) {
        $instalar = 0;
        echo "Error al seleccionar la base de datos: " . mysqli_error($conn) . "<br>";
      }

      $sql = "CREATE TABLE IF NOT EXISTS usuarios (
                login VARCHAR(25) NOT NULL PRIMARY KEY,
                password VARCHAR(100) NOT NULL,
                rol SET('administrador', 'jefe') NOT NULL,
                nombre VARCHAR(200) NOT NULL,
                apellidos VARCHAR(200) NOT NULL
              ) ENGINE = InnoDB;";

      if (!mysqli_query($conn, $sql)) {
        $instalar = 0;
        echo "Error al crear la tabla usuarios: " . mysqli_error($conn) . "<br>";
      }
        
      $sql = "CREATE TABLE IF NOT EXISTS cursos (
                id_curso VARCHAR(10) NOT NULL PRIMARY KEY,
                nombre_curso VARCHAR(200)
              ) ENGINE = InnoDB;";

      if (!mysqli_query($conn, $sql)) {
        $instalar = 0;
        echo "Error al crear la tabla de cursos: " . mysqli_error($conn) . "<br>";
      }

      $sql = "INSERT IGNORE INTO usuarios(login, password, rol, nombre, apellidos)
              VALUES('administrador', password('$admin_clave'), 'administrador', 'Aitor', 'Igartua');";

      if (!mysqli_query($conn, $sql)) {
        $instalar = 0;
        echo "Error creando el usuario administrador: " . mysqli_error($conn) . "<br>";
      }

      $sql = "INSERT IGNORE INTO usuarios(login, password, rol, nombre, apellidos)
              VALUES('jefe', password('$jefe_clave'), 'jefe', 'Aitor', 'Igartua');";

      if (!mysqli_query($conn, $sql)) {
        $instalar = 0;
        echo "Error creando el usuario jefe: " . mysqli_error($conn) . "<br>";
      }
      
      $sql = "CREATE TABLE IF NOT EXISTS conf (installed BOOLEAN NOT NULL DEFAULT FALSE," .
              " cursoActivo INT NOT NULL," .
              " nombreCursoActivo VARCHAR(20) NOT NULL," .
              " cursoPrueba BOOLEAN NOT NULL," . 
              " nombreCursoPrueba VARCHAR(20) NOT NULL," .
              " PRIMARY KEY (installed)) ENGINE = InnoDB;";
      
      if (!mysqli_query($conn, $sql)) {
        $instalar = 0;
        echo "Error creando la tabla de configuración: " . mysqli_error($conn) . "<br>";
      }
      
      
      $sql = "CREATE TABLE IF NOT EXISTS plantillas (" .
              " nombre VARCHAR(40) NOT NULL PRIMARY KEY," .
              " tipo_grafico VARCHAR(40)," .
              " paleta VARCHAR(40)," .
              " gradiente VARCHAR(10)," .
              " direccion VARCHAR(40)," .
              " color_inicio VARCHAR(7)," .
              " color_fin VARCHAR(7)," .
              " altura INT," .
              " anchura INT," .
              " valores VARCHAR(10)) ENGINE = InnoDB;";
              
      if (!mysqli_query($conn, $sql)) {
        $instalar = 0;
        echo "Error creando la tabla de plantillas de diseño: " . mysqli_error($conn) . "<br>";
      }
      

      if ($instalar == 1) {

        fwrite($confi, "\n" . "$" . "servername" . " = " . "'$servername'" . ";");
        fwrite($confi, "\n". "$" . "username" . " = " . "'$username'" . ";");
        fwrite($confi, "\n". "$" . "password" . " = " . "'$password'" . ";");
        fwrite($confi, "\n". "$" . "dbname" . " = " . "'$dbname'" . ";");
        fwrite($confi, "\n". "$" . "urlbase" . " = " . "'$urlbase'" . ";");      
        fwrite($confi, "\n". "$" . "instalar" . " = " . $instalar . ";");
        
        $sql = "INSERT INTO conf(installed) VALUES (1);";
        mysqli_query($conn, $sql);
        
        $url = $urlbase .  "instalar/instalada.php?instalacion=si";
        header("refresh: 5; url='$url'");

      } else {
        echo "La instalación no se ha producido correctamente.";

        $sql = "DROP DATABASE $dbname";
        mysqli_query($conn, $sql);
      }

      mysqli_close($conn);
      
    }
  }
?>
<script>
  $(document).ready(function(){
    $("#resultado").hide();
    $("#2").hide();
    $("#3").hide();
    $("li a").click(function(){
      id = $(this).text();
      for (i=0; i<4; i++) {
        if (i != id) {
          $("#' + i).hide();
          $("a:contains('" + i + "')").parent().removeClass("active");
        } else {
          $("a:contains('" + id + "')").parent().addClass("active");
          $('#' + id).show();
        }
      }
    });
  });
</script>
  <div class="jumbotron text-center">
    <img class='pull-left' src='../img/chart.png' alt='eduGraph' />
    <h1>Instalación de <em>edu<span class="graph">Graph!</span></em></h1>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-md-2"></div>
      <div class="col-md-8" id="resultado"></div>
      <div class="col-md-8" id="instalacion">
        <h5 class="text-center">Asegurarse de rellenar todos los campos de todas las páginas o la instalación
          fallará</h5>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
          <div id="1">
            <h3>Base de datos MySQL</h3>
            <div class="form-group">
              <label class="control-label">Direccion del servidor</label>
              <input name="db_servidor" class="form-control" type="text" required value="localhost">
            </div>
            <div class="form-group">
              <label class="control-label">Usuario</label>
              <input name="db_usuario" class="form-control" type="text" required placeholder="Usuario de la Base de Datos"> 
            </div>
            <div class="form-group">
              <label class="control-label">Contraseña</label>
              <input name="db_clave" class="form-control" type="password" required placeholder="Clave del usuario">
            </div>
            <div class="form-group">
              <label class="control-label">Nombre de la base de datos</label>
              <input name="db_nombre" class="form-control" type="text" required value="edugraph_db">
            </div>
          </div>
          <div id="2">
            <h3>Directorio y datos del instituto</h3>  
            <div class="form-group">
              <label class="control-label">Directorio raíz</label>
              <input name="urlbase" class="form-control" type="text" required value="Direccion raíz de la aplicación sin /">
            </div>
            <div class="form-group">
              <label class="control-label">Nombre del centro</label>
              <input name="centro" class="form-control" type="text" required value="Nombre del centro">
            </div>
          </div>
          <div id="3">
          <h3>Usuario Administrador de la Web</h3>
            <div class="form-group">
              <label class="control-label">Usuario</label>
              <input class="form-control" type="text" disabled value="Administrador">
            </div>
            <div class="form-group">
              <label class="control-label">Clave</label>
              <input name="admin_clave" class="form-control" type="password" required placeholder="Clave del Administrador" />
            </div>
            <h3>Usuario Jefe de estudios</h3>
            <div class="form-group">
              <label class="control-label">Usuario</label>
              <input class="form-control" type="text" disabled value="Jefe">
            </div>
            <div class="form-group">
              <label class="control-label">Clave</label>
              <input name="jefe_clave" class="form-control" type="password" required placeholder="Clave del Jefe de estudios" />
            </div>
            <div class="form-group">
              <input name="crear_db" class="btn btn-success" type="submit" value="Instalar">
            </div>
          </div>
          <ul class="pagination">
            <li><a href="#">1</a></li>
            <li><a href="#">2</a></li>
            <li><a href="#">3</a></li>
          </ul>
        </form>
      </div> <!-- end div class md-8 -->
      <div class="col-md-2"></div>
    </div> <!-- end div class row -->
  </div> <!-- end div container -->
</body>
</html>