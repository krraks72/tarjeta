<?php

$host = "localhost";
$usuario = "u581485699_krraks72";
$password = "Krraks72%7272-";
$base_datos = "u581485699_rsvp";
$puerto = 3306;

$mysqli = new mysqli($host,$usuario,$password,$base_datos,$puerto);
$mysqli->set_charset("utf8mb4");

if ($mysqli->connect_error) {
    die("Error conexión: ".$mysqli->connect_error);
}

?>