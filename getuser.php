<!DOCTYPE html>
<html>
<head>
</head>
<body>

<?php
$q = intval($_GET['q']);

$con = mysqli_connect('localhost','root','usuario','edugraph_db');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

$sql="SELECT id_curso, nombre_curso FROM cursos WHERE id_curso = '".$q."'";
$result = mysqli_query($con,$sql);

echo "<table>
<tr>
<th>Id curso</th>
<th>Nombre curso</th>
</tr>";
while($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $row['id_curso'] . "</td>";
    echo "<td>" . $row['nombre_curso'] . "</td>";
    echo "</tr>";
}
echo "</table>";
mysqli_close($con);
?>
</body>
</html>