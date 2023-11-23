<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar los datos del formulario
    $nombre = $_POST['nombre'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];

    // aquí agregar codigo agregar usuario a la tabla
}
?>