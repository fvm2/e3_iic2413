<?php
ob_start();
session_start();
require("config/conexion.php");

$msg = '';
if (isset($_POST['login']) && !empty($_POST['username']) && !empty($_POST['password']))
{
    // usuarios (id_usuario, nombre, username, mail, password, fecha_nacimiento)
    $username = $_POST['username'];
    $user_password = $_POST['password'];

    // Consulta a la base de datos para obtener la contraseña del usuario
    $query = "SELECT password, id_usuario FROM usuarios WHERE username = :username";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $password = $row['password'];
    $id_usuario = $row['id_usuario'];

    // Verifica si la contraseña ingresada por el usuario corresponde a la almacenada en la base de datos
    // Parece que la contraseña tiene que ser un hash
    //if ($row && password_verify($user_password, $row['password'])) {

    if ($row && $user_password == $password) {
        $_SESSION['valid'] = true;
        $_SESSION['timeout'] = time();
        $_SESSION['username'] = $username;
        $_SESSION['id_usuario'] = $id_usuario;
        $msg = "Sesión iniciada correctamente";
        header("Location: index.php?msg=$msg");
    } else {
        $msg = "Nombre de usuario o contraseña incorrectos";
        header("Location: login.php?msg=$msg");
    }
} else {
    $msg = "Por favor, ingresa tu nombre de usuario y contraseña";
    header("Location: login.php?msg=$msg");
}
?>