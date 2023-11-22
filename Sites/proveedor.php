<?php include('templates/header.html');   ?>

<body>
    <div class='main'>
        <h1 class='title' style="color:#008080" align="center">Información del proveedor</h1>
        <?php
           $idProveedor = $_GET['id']; 
        ?>
        <p>
          <?php
          #Llama a conexión, crea el objeto PDO y obtiene la variable $db
          require("config/conexion.php");
          $query = "SELECT nombre
                    FROM proveedores
                    WHERE id = $idProveedor";

          $result = $db -> prepare($query);
          $result -> execute();
          $dataCollected = $result -> fetchAll();
          ?>
        </p>
        <div class="card" style="width: 18rem; margin-right: 10rem; margin-left: 10rem;" >
            <div class="card-body">
                <p class="card-text">Nombre: <?php echo $dataCollected[0]['nombre']?></p>
                <p class="card-text">Cantidad de Peliculas</p>
                <p class="card-text">Cantidad de Series</p>
            </div>
        </div>
        <br>
        <br>

        <!-- Muestra las 3 recomendaciones más populares de la plataforma-->
        <div class="row" style="margin-right: 1rem; margin-left: 1rem;">
            <!-- si es de streaming debe ser 3 series y 3 películas-->
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

        <br>
        <br>
        <!-- Form -->
        <div class='container' style="width: 70%">
            <h3>Ver base de datos 1</h3>
            <form  action='./queries/prodecimiento01.php' method='GET'>
            <div class="mb-3">
                <label for="nombreProveedor" class="form-label">Nombre del proveedor</label>
                <input type="text" class="form-control form-control-lg" id="nombreProveedor" placeholder="proovedor">
            </div>
            <div class="mb-3">
                <label for="nombreEvento" class="form-label">Nombre del contenido de entretenimiento</label>
                <input type="text" class="form-control form-control-lg" id="nombreEvento" placeholder="peliculas, series o videojuegos">
            </div>
                <input class='btn' type='submit' value='Consultar'>
            </form>
        </div>
    </div>
  <br>
  <br>
  <br>
</body>
