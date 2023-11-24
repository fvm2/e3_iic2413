<?php session_start();
    if (isset($_SESSION['username'])){
        echo "Bienvenido/a: ";
        echo $_SESSION['id_usuario'];
    }
?>

<?php include('templates/header.html');   ?>

<body>
    <style>
        body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f0f8ff;
}

.main {
    text-align: center;
    padding: 20px;
}

.title {
    color: #008080;
    animation: fadeIn 2s;
}

.container {
    display: flex;
    justify-content: center;
    margin-top: 20px;
}

.card {
    width: 300px;
    padding: 20px;
    background-color: #008080;
    color: white;
    border-radius: 10px;
    box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
    animation: slideIn 2s;
}

.btn {
    display: inline-block;
    margin-top: 20px;
    padding: 10px 20px;
    background-color: white;
    color: #008080;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s;
}

.btn:hover {
    background-color: #f0f8ff;
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

@keyframes slideIn {
    from { transform: translateY(-50px); opacity: 0; }
    to { transform: translateY(0); opacity: 1; }
}
    </style>

    <div class='main'>
        <h1 class='title' align="center">Blockbuster 2.0</h1>
        <p style="text-align:center;">La plataforma de películas, series y juegos</p>

            <form  action='login.php' method='GET'>
                <input class='btn mb-2' type='submit' value='Usuario'>
            </form>

        <h1 align="center">  </h1>
        

    

    <div class='container'>
            <div class='row'>
                <div class="col-sm-3 mb-3 mb-sm-0">
                <div class="card h-100" style=" background-color: #008080;" >
                    <div class="card-body">
                    <h5 class="card-title">Mi Perfil</h5>
                    <p class="card-text">Acá vas a poder la información del usuario, sus suscripciones 
                        y las horas vistas</p>
                    <a href="mi_perfil.php" class="btn btn-light">Ir a la página</a>
                    </div>
                </div>
                </div>
                </br>
                
                <div class="col-sm-3 mb-3 mb-sm-0">
                <div class="card h-100" style=" background-color: #008080;" >
                    <div class="card-body">
                    <h5 class="card-title">Listado de Proveedores</h5>
                    <p class="card-text">Acá vas a poder encontrar un listado con todos los 
                        proveedores y poder revisar los contenidos de cada uno de estos </p>
                    <a href="todos_proveedores.php" class="btn btn-light">Ir a la página</a>
                    </div>
                </div>
                </div>
                </br>

                <div class="col-sm-3 sm-3 mb-0">
                <div class="card h-100" style=" background-color: #008080;" >
                    <div class="card-body">
                    <h5 class="card-title">Productos para comprar</h5>
                    <p class="card-text">Acá vas a poder encontrar un listado con todos los 
                        juegos y películas que estan disponibles para la venta</p>
                    <a href="comprar_contenido.php" class="btn btn-light">Ir a la página</a>
                    </div>
                </div>
                </div>
                </br>

                <div class="col-sm-3 mb-3 mb-sm-0">
                <div class="card h-100" style=" background-color: #008080;" >
                    <div class="card-body">
                    <h5 class="card-title">Consultas Inestructuradas</h5>
                    <p class="card-text">Acá vas a poder hacer las consultas inestructuradas a la base de datos </p>
                    <a href="inestructurada.php" class="btn btn-light">Ir a la página</a>
                    </div>
                </div>
                </div>
            </div>
        </div>    
    </div>
  <br>
  <br>
  <br>
</body>
</html>
