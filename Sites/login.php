<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
require ("config/conexion.php");

if (isset($_POST['uname']) && isset($_POST['password'])) {

    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $uname = validate($_POST['uname']);
    $pass = validate($_POST['password']);

    if (empty($uname)) {
        header("Location: index.php?error=User Name is required");
        exit();
    } else if (empty($pass)) {
        header("Location: index.php?error=Password is required");
        exit();
    }

    $sql = "SELECT * FROM usuarios WHERE user_name=:uname";
    $stmt = $db1->prepare($sql);
    $stmt->bindParam(':uname', $uname);
    $stmt->execute();

    $result = $stmt->fetchAll();

    if (count($result) === 1) {
        $row = $result[0];
        echo "not yet";
        if ($row['user_name'] === $uname && $row['password'] === $pass) {
            $_SESSION['user_name'] = $row['user_name'];
            $_SESSION['id'] = $row['id'];
            if ($row['user_name'] === 'ADMIN') {
              echo '<script>window.location.href = "home_admin.php";</script>';}
              else {
            echo '<script>window.location.href = "home.php";</script>';}
            exit();
        } else {
            header("Location: index.php?error=Incorrect Password");
            exit();
        }
    } else {
        header("Location: index.php?error=Incorrect User Name");
        exit();
    }
}
?>