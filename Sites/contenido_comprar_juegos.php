<?php include('templates/header.html');   ?>
<?php
$idVideoJuegos = $_GET['id']; 

?>
<?php
#Llama a conexión, crea el objeto PDO y obtiene la variable $db
require("config/conexion.php");
$query = "SELECT titulo, puntuacion, clasificacion, fecha, beneficio_preorden
          FROM videojuegos
          WHERE id_videojuego = $idVideoJuegos";


$result = $db2 -> prepare($query);
$result -> execute();
$dataCollected = $result -> fetchAll();

$queryVideojuegos_Genero = "SELECT genero
                            FROM vj_genero
                            WHERE id_videojuego = $idVideoJuegos";

$resultVideojuegos_Genero = $db2 -> prepare($queryVideojuegos_Genero);
$resultVideojuegos_Genero -> execute();
$videojuegos_genero = $resultVideojuegos_Genero -> fetchAll();

?>



<body>
    <div class='main'>
        <h1 class='title' style="color:#008080" align="center"><?php echo $dataCollected[0]['titulo']?></h1>
        </br>
        </br>
        
        <!-- -->
        <p style="text-align:center;">
          Generos:
          <?php
            foreach ($videojuegos_genero as $VjG) {
              echo $VjG[0];
            }
          ?>
          </br>
          Clasificacion: <?php echo $dataCollected[0]['clasificacion']?>
          </br>
          Puntuacion: <?php echo $dataCollected[0]['puntuacion']?>
          </br>
          Fecha: <?php echo $dataCollected[0]['fecha']?>
          </br>
          Beneficio Preorden: <?php echo $dataCollected[0]['beneficio_preorden']?>
            
        </p>
        <br>
        <br>

        <!-- -->
        <p style="text-align:center;">
          Tabla con proveedor que lo ofrece y sus precios 
          
        </p>
        <div class='container'>
        <?php
        #Llama a conexión, crea el objeto PDO y obtiene la variable $db
        require("config/conexion.php");


        $queryVideojuegos_Proveedor = "SELECT p.nombre, o.precio, p.id_proveedor
                                    FROM ofrece as o, proveedoresvj as p
                                    WHERE o.id_videojuego = $idVideoJuegos
                                    AND o.id_proveedor = p.id_proveedor";

        $resultVideojuegos_Proveedor = $db2 -> prepare($queryVideojuegos_Proveedor);
        $resultVideojuegos_Proveedor -> execute();
        $videojuegos_proveedor = $resultVideojuegos_Proveedor -> fetchAll();
        ?>
          <table>
            <tr>
              <th>Proveedores</th>
              <th>Precio</th>
            </tr>
            <?php
              foreach ($videojuegos_proveedor as $VjP) {
                  echo "<tr> <td>$VjP[0]</td> <td>$VjP[1]</td></tr>";
              }
            ?>
              
            </table>
        </div>
        <br>
        <br>
        
        <!-- -->
        <div class='container' style="width: 70%">
          <h3>Seleciona un proveedor para comprar</h3>
          <br>
          <form action='./queries/prodecimiento02.php' method='GET'>
            <select class="form-select form-select-lg mb-3" aria-label="Large select example">
              <?php
                foreach ($videojuegos_proveedor as $VjP) {
                  echo "<option value=$VjP[2]>$VjP[0]</option>";
                }
              ?>
            </select>
            <button type="submit" class="btn btn-primary" onclick="window.location.href='/Sites/historial_compras.php'">Submit</button>
          </form>
        </div>


    </div>
  <br>
  <br>
  <br>
</body>
</html>
