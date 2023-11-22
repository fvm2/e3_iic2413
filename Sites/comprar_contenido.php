<?php include('templates/header.html');   ?>


<?php
    #Llama a conexión, crea el objeto PDO y obtiene la variable $db
    require("../config/conexion.php");
    $query = "SELECT proveedoresvj.nombre as nombre, ofrece.precio as precio
              FROM proveedoresvj, ofrece
              WHERE proveedoresvj.id_proveedor = ofrece.id_proveedor
              UNION ALL
              SELECT proveedores.nombre as nombre, pelis_vende.cargo as precio
              FROM proveedores, pelis_vende
              WHERE proveedores.id = pelis_vende.id_proveedor";

    $result = $db -> prepare($query);
    $result -> execute();
    $dataCollected = $result -> fetchAll();
    echo $dataCollected;
    ?>

<body>
    <div class='main'>
        <h1 class='title' style="color:#008080" align="center">Listas de contenido para vender</h1>
        <p style="text-align:center;">
          En esta pagina debe haber un listados de todos los contenidos que se pueden comprar
        </p>
      
  <?php
    foreach ($dataCollected as $p) {
        echo "<tr> <td>$p[0]</td> <td>$p[1]</td> </tr>";
    }
  ?>
    </div>
  <br>
  <br>
  <br>
</body>
</html>