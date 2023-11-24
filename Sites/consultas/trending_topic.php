<?php include('../templates/header.html');   ?>

<body>
    <?php
        $idProveedor = $_GET['idProveedor'];
    ?>
    <?php
    #Llama a conexión, crea el objeto PDO y obtiene la variable $db
    require("../config/conexion.php");
    $query = "WITH PeliculasMasVistas AS (
                SELECT
                    p.id,
                    p.nombre,
                    p.puntuacion,
                    COUNT(vp.id_pelicula) AS visualizaciones
                FROM
                    peliculas p
                JOIN
                    ve_peliculas vp ON p.id = vp.id_pelicula
                GROUP BY
                    p.id, p.nombre, p.puntuacion
                ORDER BY
                    visualizaciones DESC
            )
            
            SELECT
                pv.id,
                pv.nombre,
                pv.puntuacion,
                pv.visualizaciones
            FROM
                PeliculasMasVistas pv
            JOIN
                pelis_provee pp ON pv.id = pp.id_pelicula
            WHERE
                pp.id_proveedor = :idProveedor
                AND pp.incluida = true
            ORDER BY
                visualizaciones DESC
            LIMIT 3";          
    
    $result = $db -> prepare($query);
    $result -> bindParam(':idProveedor', $idProveedor, PDO::PARAM_INT);
    $result -> execute();
    $dataCollected = $result -> fetchAll();

    $query1 = "WITH SeriesMasVistas AS (
        SELECT
            s.id,
            s.nombre,
            s.clasificacion,
            s.puntuacion,
            SUM(vp.id_capitulo) AS visualizaciones
        FROM
            series s
        JOIN
            temporadas t ON s.id = t.id_serie
        JOIN
            capitulos c ON t.id = c.id_temporada
        JOIN
            ve_series vp ON c.id_capitulo = vp.id_capitulo
        GROUP BY
            s.id, s.nombre, s.clasificacion, s.puntuacion
        ORDER BY
            visualizaciones DESC
    )
    
    SELECT
        svmv.id,
        svmv.nombre,
        svmv.puntuacion,
        svmv.visualizaciones
    FROM
        SeriesMasVistas svmv
    JOIN
        series_provee sp ON svmv.id = sp.id_serie
    WHERE
        sp.id_proveedor = :idProveedor
    ORDER BY svmv.visualizaciones DESC
    LIMIT 3";
    $result1 = $db -> prepare($query1);
    $result1 -> bindParam(':idProveedor', $idProveedor, PDO::PARAM_INT);
    $result1 -> execute();
    $dataCollected1 = $result1 -> fetchAll();
    ?>

    <div class="row" style="margin-right: 1rem; margin-left: 1rem;">
        <!-- si es de streaming debe ser 3 series y 3 películas-->
        <h1 align="center">Peliculas más vistas</h1>
        <?php foreach ($dataCollected as $pelicula): ?>
            <div class="col-sm-3 ">
                <div class="card">
                    <div class="card-header"  style="background-color:#F0F8FF">
                        <?php echo $pelicula['nombre']?>
                    </div>
                    <div class="card-body">
                        <p class="card-text">Puntuación: <?php echo $pelicula['puntuacion']?></p>
                        <p class="card-text">Cantidad de visualizaciones: <?php echo $pelicula['visualizaciones']?></p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <br>
    <div class="row" style="margin-right: 1rem; margin-left: 1rem;">
        <h2 align="center">Series más vistas</h2>
        <?php foreach ($dataCollected1 as $serie): ?>
            <div class="col-sm-3 ">
                <div class="card">
                    <div class="card-header"  style="background-color:#F0F8FF">
                        <?php echo $serie['nombre']?>
                    </div>
                    <div class="card-body">
                        <p class="card-text">Puntuación: <?php echo $serie['puntuacion']?></p>
                        <p class="card-text">Cantidad de visualizaciones: <?php echo $serie['visualizaciones']?></p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</body>
<?php include('../templates/volver_atras.html'); ?>