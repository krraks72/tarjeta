<?php
require_once "conexion.php";

$sql = "SELECT * FROM rsvp ORDER BY Id DESC";
$result = $mysqli->query($sql);

$totales = $mysqli->query("SELECT COUNT(*) total_registros,
SUM(NumberOfGuests) total_invitados
FROM rsvp")->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">
<title>Panel RSVP</title>

<script src="https://cdn.tailwindcss.com"></script>

<link rel="stylesheet"
href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

</head>

<body class="bg-gray-100">

<div class="max-w-6xl mx-auto mt-10">

<h1 class="text-3xl font-bold mb-6">
Panel Confirmaciones RSVP
</h1>

<div class="grid grid-cols-2 gap-6 mb-6">

<div class="bg-white p-5 rounded shadow">
<h2 class="text-gray-500">Total registros</h2>
<p class="text-3xl font-bold">
<?php echo $totales['total_registros']; ?>
</p>
</div>

<div class="bg-white p-5 rounded shadow">
<h2 class="text-gray-500">Total invitados</h2>
<p class="text-3xl font-bold">
<?php echo $totales['total_invitados']; ?>
</p>
</div>

</div>

<div class="mb-4">

<a href="exportar_excel.php"
class="bg-green-600 text-white px-4 py-2 rounded">
Exportar a Excel
</a>

</div>

<div class="mb-4">
<a href="admin_contenido.php" class="bg-blue-600 text-white px-4 py-2 rounded">Administrar contenido del sitio</a>
</div>

<div class="bg-white p-6 rounded shadow">

<table id="tabla"
class="display w-full">

<thead>

<tr>

<th>ID</th>
<th>Nombre</th>
<th>Teléfono</th>
<th>Invitados</th>
<th>Preferencia</th>
<th>Asistencia</th>

</tr>

</thead>

<tbody>

<?php while($fila = $result->fetch_assoc()) { ?>

<tr>

<td><?= $fila['Id'] ?></td>
<td><?= $fila['Name'] ?></td>
<td><?= $fila['Phone'] ?></td>
<td><?= $fila['NumberOfGuests'] ?></td>
<td><?= $fila['MealPreferences'] ?></td>
<td>

<?php
echo $fila['Attendance'] == 1
? "Confirmado"
: "No asiste";
?>

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</div>

<script>

$(document).ready(function(){

$('#tabla').DataTable({
pageLength:10,
language:{
url:"https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json"
}
});

});

</script>

</body>
</html>