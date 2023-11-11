<?php include('templates/header.html');   ?>

<body>
    <div class='main'>
        <h1 class='title' align="center">Blockbuster 2.0</h1>
        <p style="text-align:center;">La plataforma de películas, series y juegos</p>

            <form  action='login.php' method='GET'>
                <input class='btn mb-2' type='submit' style="background-color:#F0F8FF" value='Usuario'>
            </form>

        <h1 align="center">  </h1>

        <div class="card" style="width: 18rem; margin-right: 10rem; margin-left: 10rem;" >
            <div class="card-header"  style="background-color:#F0F8FF">
                Usuario
            </div>
            <div class="card-body">
                <p class="card-text">Nombre</p>
                <p class="card-text">Email</p>
                <p class="card-text">Username</p>
                <p class="card-text">edad</p>
            </div>
        </div>

        <div class="row" style="margin-right: 1rem; margin-left: 1rem;">
            <h3>suscripciones actuales</h3>
            <div class="col-sm-6 ">
                <div class="card">
                <div class="card-header"  style="background-color:#F0F8FF">
                    Videojuegos
                </div>
                <div class="card-body">
                    <p class="card-text">Lista de todas mis suscripciones activas</p>
                </div>
                <div class="card-footer text-muted">
                    cantidad de horas jugadas
                </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card">
                <div class="card-header"  style="background-color:#F0F8FF">
                    Peliculas
                </div>
                <div class="card-body">
                    <p class="card-text">Lista de todas mis suscripciones activas</p>
                </div>
                <div class="card-footer text-muted">
                    cantidad de horas vistas
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
