<?php include('templates/header.html');   ?>
<?php
$idVideoJuegos = $_GET['id']; 

?>
<?php
#Llama a conexión, crea el objeto PDO y obtiene la variable $db
require("config/conexion.php");


$query = "SELECT proveedoresvj.nombre AS nombre_proveedor, videojuegos.titulo, ofrece.precio
          FROM videojuegos, proveedoresvj, ofrece
          WHERE videojuegos.id_videojuego = $idVideoJuegos AND
                ofrece.id_videojuego = videojuegos.id_videojuego AND
                proveedoresvj.id = ofrece.id_proveedor";
$result = $db2 -> prepare($query);
$result -> execute();
$dataCollected = $result -> fetchAll();


# Consulta para obtener los proveedores
$queryProveedores = "SELECT nombre
                     FROM proveedoresvj";
$resultProveedores = $db2->prepare($queryProveedores);
$resultProveedores->execute();
$proveedores = $resultProveedores->fetchAll();



$queryVideojuegos_especificacion = "SELECT videojuegos.titulo, vj_genero.nombre as genero
                                    FROM videojuegos, proveedoresvj, ofrece, vj_genero
                                    WHERE videojuegos.id_videojuego = $idVideoJuegos AND
                                          ofrece.id_videojuego = videojuegos.id_videojuego AND
                                          proveedoresvj.id = ofrece.id_proveedor AND videojuegos.id_videojuego = vj_genero.id_videojuego
                                    GROUP BY videojuegos.titulo";

$resultVideojuegos_especificacion = $db2 -> prepare($queryVideojuegos_especificacion);
$resultVideojuegos_especificacion -> execute();
$videojuegos_especificacion = $resultVideojuegos_especificacion -> fetchAll();
?>

<body>
    <div class='main'>
        <h1 class='title' style="color:#008080" align="center"><?php echo $videojuegos[0]['titulo']?></h1>
        <br>
        <br>
        
        <!-- -->
        <p style="text-align:center;">
          Especificaciones del contenido
        </p>
        <br><br>
        <table align= "center">
          <tr>
            <th>Videojuego</th>

          </tr>
            <?php foreach ($queryVideojuegos_especificacion as $row): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['titulo']); ?></td>
                    <td><?php echo htmlspecialchars($row['genero']); ?></td>
                </tr>
            <?php endforeach; ?>
          </table>



        <p style="text-align:center;">
          Tabla con proveedor que lo ofrece y sus precios
        </p>
        <br><br>
        <table align="center">
        <tr>
          <th>Proveedor</th>
          <th>Videojuego</th>
          <th>Precio</th>
        </tr>
            <?php foreach ($dataCollected as $row): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['nombre_proveedor']); ?></td>
                    <td><?php echo htmlspecialchars($row['titulo']); ?></td>
                    <td><?php echo htmlspecialchars($row['precio']); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>

  
    
        
        <!-- -->
        <div class='container' style="width: 70%">
            <h3>Seleciona un proveedor para comprar</h3>
            <br>
            <form action='./queries/prodecimiento02.php' method='GET'>
                <select class="form-select form-select-lg mb-3" aria-label="Large select example" name="idProveedor">
                    <option selected>Selecciona un Proveedor</option>
                    <?php foreach ($proveedores as $proveedor): ?>
                        <option value="<?php echo htmlspecialchars($proveedor['id_proveedor']); ?>">
                            <?php echo htmlspecialchars($proveedor['nombre']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <button type="submit" class="btn btn-primary">Comprar</button>
            </form>
        </div>



    </div>
  <br>
  <br>
  <br>
</body>
</html>
