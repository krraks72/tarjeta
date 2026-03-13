<?php

require_once "conexion.php";

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=rsvp.xls");

$sql="SELECT * FROM rsvp";
$result=$mysqli->query($sql);

echo "<table border='1'>";

echo "<tr>
<th>ID</th>
<th>Nombre</th>
<th>Telefono</th>
<th>Invitados</th>
<th>Preferencia</th>
<th>Asistencia</th>
</tr>";

while($fila=$result->fetch_assoc()){

echo "<tr>";

echo "<td>".$fila['Id']."</td>";
echo "<td>".$fila['Name']."</td>";
echo "<td>".$fila['Phone']."</td>";
echo "<td>".$fila['NumberOfGuests']."</td>";
echo "<td>".$fila['MealPreferences']."</td>";
echo "<td>".$fila['Attendance']."</td>";

echo "</tr>";

}

echo "</table>";

?>