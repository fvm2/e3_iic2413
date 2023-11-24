<?php
session_start();

include('../cargadores/encrypt.php');

// Encontrar el mayor id_usuario en la tabla usuarios
$query = "SELECT MAX(id_usuario) FROM usuarios;";
$stmt = $db -> prepare($query);
$stmt -> execute();
$max_id = $stmt -> fetch(PDO::FETCH_ASSOC);
$id_usuario = $max_id['MAX(id_usuario)'] + 1;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar los datos del formulario
    $nombre = $_POST['nombre'];
    $username = $_POST['username'];
    $email = $_POST['email'];

    $password = $_POST['password'];
    $salt = generateSalt();
    $encryptedPassword = crypt($password, $salt);

    $fecha_nacimiento = $_POST['fecha_nacimiento'];

    // aquí agregar codigo agregar usuario a la tabla
    $query = "INSERT INTO usuarios (id_usuario, nombre, username, mail, password, fecha_nacimiento)
              VALUES (:id_usuario, :nombre, :username, :mail, :password, :fecha_nacimiento);";

    $stmt = $db->prepare($query);

    $stmt -> bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
    $stmt -> bindParam(':nombre', $nombre, PDO::PARAM_STR);
    $stmt -> bindParam(':username', $username, PDO::PARAM_STR);
    $stmt -> bindParam(':mail', $email, PDO::PARAM_STR);
    $stmt -> bindParam(':password', $encryptedPassword, PDO::PARAM_STR);
    $stmt -> bindParam(':fecha_nacimiento', $fecha_nacimiento, PDO::PARAM_STR);

    
    try {
        $stmt -> execute();
        // Redirige al usuario a la página de inicio de sesión después de registrarse
        header("Location: login.php");
    } catch(PDOException $e) {
        // Maneja los errores que pueden ocurrir durante la ejecución de la consulta
        echo "Error: " . $e->getMessage();
    }
}
?>