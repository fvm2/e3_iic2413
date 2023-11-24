<?php include('../templates/header.html');   ?>

<body>
    <?php
        $nombreProveedor = $_GET['nombreProveedor'];
        $nombreEvento = $_GET['nombreEvento'];
    ?>
    <?php
    #Llama a conexión, crea el objeto PDO y obtiene la variable $db
    require("../config/conexion.php");
    $query = "SELECT pr.nombre AS proveedor, p.nombre AS pelicula, pp.incluida AS incluida 
                FROM pelis_provee pp 
                JOIN peliculas p ON p.id=pp.id_pelicula 
                JOIN proveedores pr ON pp.id_proveedor=pr.id 
                WHERE LOWER(pr.nombre) LIKE LOWER(':nombreProveedor')
                AND LOWER(p.nombre) LIKE LOWER(':nombreEvento')";
    $result = $db -> prepare($query);
    $result -> bindParam(':nombreProveedor', $nombreProveedor, PDO::PARAM_STR);
    $result -> bindParam(':nombreEvento', $nombreEvento, PDO::PARAM_STR);
    $result -> execute();
    $dataCollected = $result -> fetchAll();
    ?>

    <div class="row" style="margin-right: 1rem; margin-left: 1rem;">
        <!-- si es de streaming debe ser 3 series y 3 películas-->
        <h1 align="center">Peliculas más vistas</h1>
        <?php foreach ($dataCollected as $pelicula): ?>
            <div class="col-sm-3 ">
                <div class="card">
                    <div class="card-header"  style="background-color:#F0F8FF">
                        <?php echo $pelicula['pelicula']?>
                    </div>
                    <div class="card-body">
                        <p class="card-text">Puntuación: <?php echo $pelicula['proveedor']?></p>
                        <p class="card-text">Cantidad de visualizaciones: <?php echo $pelicula['incluida']?></p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</body>
<?php include('../templates/footer.html'); ?>