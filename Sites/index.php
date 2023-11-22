<?php include('templates/header.html');   ?>

<body>
    <div class='main'>
        <h1 class='title' align="center">Blockbuster 2.0</h1>
        <p style="text-align:center;">La plataforma de películas, series y juegos</p>

            <form  action='login.php' method='GET'>
                <input class='btn mb-2' type='submit' style="background-color:#F0F8FF" value='Usuario'>
            </form>

        <h1 align="center">  </h1>
        <div class='container align-self-center'>
            <div class='row'>
            <div class="col-sm-4 mb-3 mb-sm-0">
                <div class="card h-100" style="width: 15rem; background-color: #008080;" >
                    <div class="card-body">
                        <h5 class="card-title">Mi perfil</h5>
                        <p class="card-text">Acaba vas a poder la informacion del usuario, sus suscripciones 
                            y las horas vistas </p>
                        <a href="mi_perfil.php" class="btn btn-light">ir a la pagina</a>
                    </div>
                </div>
            </div>
            </br>
            <div class="col-sm-4 mb-3 mb-sm-0">
                <div class="card h-100" style="width: 15rem; background-color: #008080;" >
                    <div class="card-body">
                        <h5 class="card-title">Listado de proveedores</h5>
                        <p class="card-text">Acaba vas a poder encontrar un listado con todos los 
                            proveedores y poder revisar los contenidos de cada uno de estos </p>
                        <a href="todos_proveedores.php" class="btn btn-light">ir a la pagina</a>
                    </div>
                </div>
            </div>
            </br>
            <div class="col-sm-4 sm-3 mb-0">
                <div class="card h-100" style="width: 15rem; background-color: #008080;" >
                    <div class="card-body">
                        <h5 class="card-title">productos para comprar</h5>
                        <p class="card-text">Acaba vas a poder encontrar un listado con todos los 
                            juegos y peliculas que estan disponibles para la venta</p>
                        <a href="comprar_contenido.php" class="btn btn-light">ir a la pagina</a>
                    </div>
                </div>
            </div>
            </div>
        </div>


        <div class='container'>
            <h3>Ver base de datos 1</h3>
                <form  action='consultas/bdd_1.php' method='GET'>
                    <input class='btn' type='submit' value='Consultar'>
                </form>
        </div>
            
        <div class='container'>
            <h3>Ver base de datos 2</h3>
                <form  action='consultas/bdd_2.php' method='GET'>
                    <input class='btn' type='submit' value='Consultar'>
                </form>
        </div>

        <div class='container'>
            <h3>Ver todos los proveedores</h3>
                <form  action='todos_proveedores.php' method='GET'>
                    <input class='btn' type='submit' style="background-color:#F0F8FF" value='proveedores'>
                </form>
        </div>
    
    </div>
  <br>
  <br>
  <br>
</body>
</html>
