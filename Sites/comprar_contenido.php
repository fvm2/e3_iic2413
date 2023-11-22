<?php 
include('templates/header.html');

/*
# Llama a conexión, crea el objeto PDO y obtiene la variable $db
require("config/conexion.php");

$query = " SELECT peliculas.id_pelicula
            FROM pelis_vende
";
$result_original = $db -> prepare($query);
$result_original -> execute();
$dataCollected = $result_original -> fetchAll();

echo "hola";


# Consulta original para obtener la lista de nombres de proveedores y precios
$query_original = "SELECT proveedoresvj.nombre as nombre, ofrece.precio as precio
                   FROM proveedoresvj, ofrece
                   WHERE proveedoresvj.id_proveedor = ofrece.id_proveedor
                   UNION ALL
                   SELECT proveedores.nombre as nombre, pelis_vende.cargo as precio
                   FROM proveedores, pelis_vende
                   WHERE proveedores.id = pelis_vende.id_proveedor";

$result_original = $db -> prepare($query_original);
$result_original -> execute();
$dataCollected = $result_original -> fetchAll();

*/

?>




<body>
    <div class='main'>
        <h1 class='title' style="color:#008080" align="center">Listas de contenido para vender</h1>
        <p style="text-align:center;">
          En esta página debe haber un listado de todos los contenidos que se pueden comprar
        </p>

        
        
        <div class="container text-center">
        <div class="row align-items-start">
            <div class="col">
                <?php 
                    require("config/conexion.php");

                    $query_p = " SELECT DISTINCT P.id, P.nombre
                        FROM pelis_vende as PelisV, peliculas as P
                        WHERE P.id = PelisV.id_pelicula
                        ";

                    $result_p = $db -> prepare($query_p);
                    $result_p -> execute();
                    $dataCollectedPeli = $result_p -> fetchAll();

                ?>
                <H3 style="color:#008080" align="center" >Peliculas a la Venta</H3>
                <div style="display: flex; justify-content: center;">
                    
                    <table>
                    <tr>
                        <th>nombre de las pelicuals</th>
                    </tr>
                    <?php
                    foreach ($dataCollectedPeli as $pp) {
                        echo "<tr> <td><a href='contenido_comprar_pelis.php?id=$pp[0]'>$pp[1]</a></td>  </tr>";
                    }
                    ?>
                    </table>

                </div>
            </div>

            <div class="col">
                <?php 
                    require("config/conexion.php");

                    $query_v = " SELECT DISTINCT O.id_videojuego, V.titulo
                        FROM ofrece as O, videojuegos as V
                        WHERE O.id_videojuego = V.id_videojuego
                        ";

                    $result_v = $db2 -> prepare($query_v);
                    $result_v -> execute();
                    $dataCollectedV = $result_v -> fetchAll();
                ?>
                <H3 style="color:#008080" align="center" >Videojuegos a la venta</H3>
                <div style="display: flex; justify-content: center;">
                    
                    <table>
                    <tr>
                        <th>nombre de los videojuego</th>
                    </tr>
                    <?php
                    foreach ($dataCollectedV as $pv) {
                        echo "<tr> <td><a href='contenido_comprar_juegos.php?id=$pv[0]'>$pv[1]</a></td>  </tr>";
                    }
                    ?>
                    </table>

                </div>
            </div>
            
        </div>
        </div>
        
        

        <!-- Formulario con campo desplegable para seleccionar proveedor -->
        <?php 
          require("config/conexion.php");
          # Consulta SQL para obtener los nombres de los proveedores
          $query_proveedores = "SELECT DISTINCT nombre FROM (
                                    SELECT nombre FROM proveedoresvj
                                    UNION
                                    SELECT nombre FROM proveedores
                                ) AS proveedores_totales";

          $result_proveedores = $db->prepare($query_proveedores);
          $result_proveedores->execute();
          $listaProveedores = $result_proveedores->fetchAll();
        ?>





        <form action="tu_archivo_de_destino.php" method="POST">
            <label for="proveedor">Elige un proveedor:</label>
            <select name="proveedor" id="proveedor">
                <?php foreach ($listaProveedores as $p): ?>
                    <option value="<?php echo htmlspecialchars($p['nombre']); ?>">
                        <?php echo htmlspecialchars($p['nombre']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <input type="submit" value="Enviar">
        </form>

        <!-- Tabla para mostrar los datos recogidos de la consulta original -->
        <table>
            <tr>
                <th>Nombre del Proveedor</th>
                <th>Precio</th>
            </tr>
            <?php foreach ($dataCollected as $p): ?>
                <tr>
                    <td><?php echo htmlspecialchars($p['nombre']); ?></td>
                    <td><?php echo htmlspecialchars($p['precio']); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>
