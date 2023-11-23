<?php
    session_start();
    $msg = $_GET['msg'];
?>

<?php include('../templates/header.html'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #F0F8FF;
            margin: 0;
        }

        .card {
            width: 500px;
            height: 600px;
            background-color: #008080;
            text-align: center;
            padding: 20px;
            border-radius: 10px;
            font-size: 18px;
            font-family: 'Arial', sans-serif;
        }

        .card input, .card button {
            font-size: 16px;
            font-family: 'Arial', sans-serif;
            margin-bottom: 10px;
            border-radius: 5px;
            padding: 8px;
        }
    </style>
    <title>Registro</title>
</head>

<body>
    <div class="card">
        <div class="card-body"><br>
            <h3> Registro de Usuario </h3>
            <br>
            <form class="form-signup" role="form" action="registro_validation.php" method="post">
                <?php echo $msg; ?>
                <input type="text" name="nombre" placeholder="Nombre " required autofocus>
                <br>
                <input type="text" name="username" placeholder="Username" required>
                <br>
                <input type="email" name="email" placeholder="Correo electrónico" required>
                <br>
                <input type="password" name="password" placeholder="Contraseña" required>
                <br>
                <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
                <input type="date" name="fecha_nacimiento" required>
                <br>
                <button type="submit" name="register" class="btn btn-secondary btn-lg">Registrarse</button>
            </form>
        </div>
        <br>
    </div>
</body>
</html>
