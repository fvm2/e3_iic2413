<?php include('templates/header.html');   ?>

<body>
    <div class='main'>
        <h1 class='title' style="color:#008080" align="center">Nombre proveedor</h1>
        <p style="text-align:center;">
          En esta pagina debe haber un listados de todos los proveedores con un link 
          que lleve a una pagina con todos sus datos 
        </p>
        <!-- si es de Videojuegos-->
        <div class="card" style="width: 18rem; margin-right: 10rem; margin-left: 10rem;" >
            <div class="card-body">
                <p class="card-text">Precio</p>
                <p class="card-text">Cantidad de videojuegos</p>
            </div>
        </div>
        <!-- si es de streaming-->
        <div class="card" style="width: 18rem; margin-right: 10rem; margin-left: 10rem;" >
            <div class="card-body">
                <p class="card-text">Precio</p>
                <p class="card-text">Cantidad de Peliculas</p>
                <p class="card-text">Cantidad de Series</p>
            </div>
        </div>

        <div class="row" style="margin-right: 1rem; margin-left: 1rem;">
            <h3>Recomendados</h3>
            <div class="col-sm-3 ">
                <div class="card">
                <div class="card-header"  style="background-color:#F0F8FF">
                    Recomendado 1
                </div>
                <div class="card-body">
                    <p class="card-text">puntuacion</p>
                    <p class="card-text">cantidad de visualizaciones</p>
                </div>
                </div>
            </div>

            <div class="col-sm-3">
                <div class="card">
                <div class="card-header"  style="background-color:#F0F8FF">
                    Recomendado 2
                </div>
                <div class="card-body">
                    <p class="card-text">puntuacion</p>
                    <p class="card-text">cantidad de visualizaciones</p>
                </div>
                </div>
            </div>

            <div class="col-sm-3">
                <div class="card">
                <div class="card-header"  style="background-color:#F0F8FF">
                    Recomendado 3
                </div>
                <div class="card-body">
                    <p class="card-text">puntuacion</p>
                    <p class="card-text">cantidad de visualizaciones</p>
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