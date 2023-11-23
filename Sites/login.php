
<?php
/*
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
*/
?>
<?php
	session_start();
	$msg = $_GET['msg']
?>

<?php include('../templates/header.html'); ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            height: 100vh; /* Establece la altura del cuerpo al 100% de la altura de la ventana */
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #F0F8FF;
            margin: 0; /* Elimina el margen predeterminado del cuerpo */
        }

        .card {
            width: 500px;
            height: 500px;
            background-color: #008080;
            text-align: center;
            padding: 20px;
            border-radius: 10px; /* Añade bordes redondeados */
            font-size: 36px; /* Cambia el tamaño de la letra */
            font-family: 'Arial', sans-serif; /* Cambia la tipografía */
        }
        .card input, .card button {
            font-size: 24px;
            font-family: 'Arial', sans-serif;
            margin-bottom: 10px; /* Agrega un margen inferior para separar los elementos */
            border-radius: 10px;
        }


        /* Puedes agregar estilos adicionales según sea necesario */
    </style>
    <title>Login</title>
</head>

<body>
    <div class="card">
        <div class="card-body"><br>
            <h3> Ingrese nombre de usuario y contraseña </h3>
            </br>
            <form class="form-signin" role="form" action="login_validation.php" method="post">
                <?php echo $msg; ?>
                <input type="text" name="username" placeholder="nombre de usuario" required autofocus >
                </br>
                <input type="password" name="password" placeholder="contraseña" required >
                </br>
                <button type="submit" name="login" class="btn btn-secondary btn-lg"> Iniciar sesión </button>
            </form>
        </div>
        </br>
    </div>

</body>


