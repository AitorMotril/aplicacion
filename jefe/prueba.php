<?php
  include_once '../config/config.php';
  include_once '../funciones.php';
  protege("jefe" || "administrador");
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Jefe de estudios | eduGraph!</title>
  <base href='<?php echo $urlbase;?>' target='_self'>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <link rel="stylesheet" href="css/style.css" />
  <link rel="icon" href="img/iconv1.png" type="image/x-icon">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>
  
<!-- Cabecera con la imagen de logo y el lema de la página -->
<div class="container-fluid clearfix" id="toplogo"></div>

<!-- Menú superior de navegación fijo -->
<nav class="navbar navbar-inverse" data-spy="affix" data-offset-top="77" id="nav01"></nav>

<!-- Cabecera de la página y texto -->
<div class="container-fluid">
  <h3 class="bg-3">Jefe de estudios</h3>
  <div class="row">
    <div class="col-md-2">
      <div class="list-group" id="sidebar">
        <a href='jefe/notas.php' class="list-group-item active">Principal jefe de estudios</a>
        <a href='jefe/notas.php' class="list-group-item">Subir notas</a>
        <a href="jefe/graficos.php" class="list-group-item">Crear gráficos</a>
        <a href="jefe/asignaturas.php" class="list-group-item">Gestión de asignaturas</a>
      </div>
    </div>
    <div class="col-md-10">
      <p>
        Activar curso de prueba
      </p>
      
<?php
  
  global $servername, $username, $password, $dbname;
  $cursoPrueba = 000;
  $conn = mysqli_connect($servername, $username, $password, $dbname);
  
  // Crear tabla de alumnos
  $sql_crear = "CREATE TABLE IF NOT EXISTS alumnos" . $cursoPrueba . " (N_Id_Escolar VARCHAR(40) PRIMARY KEY," .
          " Alumnoa VARCHAR(40)) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
  echo $sql_crear;
  
  if (mysqli_query($conn, $sql_crear)) {
    echo "La tabla alumnos" . $cursoPrueba . " se ha creado correctamente o ya existía" . "<br>";
  } else {
    echo "Error al crear la tabla alumnos: " . mysqli_error($conn) . "<br>";
  }
  
  $sql_insert = "INSERT INTO alumnos" . $cursoPrueba. " (N_Id_Escolar, Alumnoa) VALUES (2, 'Ficticio2 Ficticio2, Ficticio2')," .
    "(1, 'Ficticio1 Ficticio1, Ficticio1'),(3, 'Ficticio3 Ficticio3, Ficticio3');";
  echo $sql_insert;
  
    if (mysqli_query($conn, $sql_insert)) {
    echo "La tabla alumnos" . $cursoPrueba . " se ha creado correctamente o ya existía" . "<br>";
  } else {
    echo "Error al crear la tabla alumnos: " . mysqli_error($conn) . "<br>";
  }
          
  $sql_crear_asignatura = "CREATE TABLE IF NOT EXISTS asignaturas" . $cursoPrueba . " ( "
          . "id_asignatura VARCHAR(10) NOT NULL PRIMARY KEY) ENGINE=InnoDB;";
  echo $sql_crear_asignatura;
   
     if (mysqli_query($conn, $sql_crear_asignatura)) {
    echo "La tabla asignaturas" . $cursoPrueba . " se ha creado correctamente o ya existía" . "<br>";
  } else {
    echo "Error al crear la tabla asignaturas: " . mysqli_error($conn) . "<br>";
  }
  
    $sql_crear_notas = "CREATE TABLE IF NOT EXISTS notas" . $cursoPrueba . " ( " .
         "N_Id_Escolar VARCHAR(40) NOT NULL,
         Trimestre VARCHAR(10) NOT NULL,
         id_asignatura VARCHAR(10) NOT NULL,
         Nota INT,
         FOREIGN KEY (N_Id_Escolar) REFERENCES alumnos" . $cursoPrueba . "(N_Id_Escolar), " .
         "FOREIGN KEY (id_asignatura) REFERENCES asignaturas" . $cursoPrueba . "(id_asignatura), " .
         "PRIMARY KEY (N_Id_Escolar, Trimestre, id_asignatura, Nota) ) ENGINE=InnoDB;";

  if (mysqli_query($conn, $sql_crear_notas)) {
    echo "La tabla notas" . $cursoPrueba . " se ha creado correctamente o ya existía" . "<br>";
  } else {
    echo "Error al crear la tabla notas: " . mysqli_error($conn) . "<br>";
  }      
  
  $trim1 = fopen('../prueba_notas_1trimestre.csv', 'r');
  notas($trim1, "1");
  $trim2 = fopen('../prueba_notas_2trimestre.csv', 'r');
  notas($trim2, "2");
  $trim3 = fopen('../prueba_notas_3trimestre.csv', 'r');
  notas($trim3, "3");

?>
      <pre>INSERT INTO alumnos (N_Id_Escolar, Alumnoa) VALUES (2, 'Ficticio2 Ficticio2, Ficticio2'),(1, 'Ficticio1 Ficticio1, Ficticio1'),(3, 'Ficticio3 Ficticio3 Ficticio3')</pre>
      <pre>ALTER TABLE `asignaturas` ADD `nombre_completo` VARCHAR(255) NULL DEFAULT NULL AFTER `id_asignatura`;</pre>
      <pre>ALTER TABLE `asignaturas` ADD `area_completa` VARCHAR(255) NULL DEFAULT NULL AFTER `nombre_completo`;</pre>
    </div>  
  </div>
</div>
    
<!-- Pie de página -->
<div class="container-fluid bg-4 text-center" id='foot01'></div>
<script src="script/javascript.js"></script>
</body>
</html>



