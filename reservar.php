<?php
// Permitir solo POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo "Método no permitido";
    exit;
}

// Recibir datos
$name      = isset($_POST['name']) ? trim($_POST['name']) : '';
$phone     = isset($_POST['phone']) ? trim($_POST['phone']) : '';
$guests    = isset($_POST['Number_Of_Guests']) ? intval($_POST['Number_Of_Guests']) : 0;
$lodging   = isset($_POST['Meal_Preferences']) ? trim($_POST['Meal_Preferences']) : '';
$attend    = isset($_POST['attendance']) ? intval($_POST['attendance']) : 0;

// Validación
if ($name === "" || $phone === "" || $lodging === "") {
    echo "Datos incompletos.";
    exit;
}

// Datos de conexión
$host = "localhost";
$usuario = "u581485699_krraks72";
$password = "Krraks72%7272-";
$base_datos = "u581485699_rsvp";
$puerto = 3306;

// Conexión a BD
$mysqli = new mysqli($host, $usuario, $password, $base_datos, $puerto);
$mysqli->set_charset("utf8mb4");

if ($mysqli->connect_errno) {
    echo "Error conectando a la base de datos";
    exit;
}

// Insertar registro
$stmt = $mysqli->prepare("
    INSERT INTO rsvp (Name, Phone, NumberOfGuests, MealPreferences, Attendance)
    VALUES (?, ?, ?, ?, ?)
");
$stmt->bind_param("ssisi", $name, $phone, $guests, $lodging, $attend);
$stmt->execute();

if ($stmt->affected_rows > 0) {

    // ✔ Redirección si se guardó correctamente
    header("Location: /confirmation.html");
    exit;

} else {
    echo "No se pudo guardar el registro.";
}

$stmt->close();
$mysqli->close();
