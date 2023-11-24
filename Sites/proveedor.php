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
                    WHERE id = :idProveedor";

          $result = $db -> prepare($query);
          $result -> bindParam(':idProveedor', $idProveedor, PDO::PARAM_INT);
          $result -> execute();
          $dataCollected = $result -> fetch();

          $queryCantidad = "SELECT COUNT(*) AS peliculas_activas
                            FROM pelis_provee
                            WHERE id_proveedor = :idProveedor
                            AND incluida = TRUE";
          $result1 = $db -> prepare($queryCantidad);
          $result1 -> bindParam(':idProveedor', $idProveedor, PDO::PARAM_INT);
          $result1 -> execute();
          $CantidadPeliculas = $result1 -> fetch();

          $queryseries = "SELECT COUNT(*) AS series_dispo
                          FROM series_provee
                          WHERE id_proveedor = :idProveedor";
          $result2 = $db -> prepare($queryseries);
          $result2 -> bindParam(':idProveedor', $idProveedor, PDO::PARAM_INT);
          $result2 -> execute();
          $CantidadSeries = $result2 -> fetch();

          $querycosto = "SELECT DISTINCT costo
                         FROM suscripciones
                         WHERE pro_id = :idProveedor";
          $result3 = $db -> prepare($querycosto);
          $result3 -> bindParam(':idProveedor', $idProveedor, PDO::PARAM_INT);
          $result3 -> execute();
          $Costo = $result3 -> fetch();
          ?>
        </p>
        <div class="card" style="width: 18rem; margin-right: 10rem; margin-left: 10rem;" >
            <div class="card-body">
                <p class="card-text">Nombre: <?php echo $dataCollected['nombre']?></p>
                <p class="card-text">Costo: <?php echo $Costo['costo']?></p>
                <p class="card-text">Cantidad de Peliculas: <?php echo $CantidadPeliculas['peliculas_activas']?></p>
                <p class="card-text">Cantidad de Series: <?php echo $CantidadSeries['series_dispo']?></p>
            </div>
        </div>
        <h2 align="center"> Ver Peliculas y Series más vistas </h3>

        <form align="center" action="consultas/trending_topic.php?idProveedor=<?php echo $idProveedor; ?>" method="post">
            <input type="submit" value="Trending Topic">
        </form>

        <br>
        <br>
        <!-- Form -->
        <div class='container' style="width: 70%">
            <h3>¡Busca tus peliculas y series favoritas!</h3>
            <form action='consultas/buscador_streaming.php' method='GET'>
                <div class="mb-3">
                    <label for="nombreProveedor" class="form-label">Nombre del proveedor</label>
                    <input type="text" class="form-control form-control-lg" id="nombreProveedor" name="nombreProveedor" placeholder="Proveedor">
                </div>
                <div class="mb-3">
                    <label for="nombreEvento" class="form-label">Nombre de tu peliucla o serie</label>
                    <input type="text" class="form-control form-control-lg" id="nombreEvento" name="nombreEvento" placeholder="Películas o series">
                </div>
                <input class='btn' type='submit' value='Consultar'>
            </form>
        </div>
    </div>
  <br>
  <br>
  <br>
</body>
