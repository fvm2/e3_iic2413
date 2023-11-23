<?php include('templates/header.html');   ?>

<body>
    <div class='main'>
        <h1 class='title' style="color:#008080" align="center">Proveedores de Streaming</h1>
        <p>
          <?php
          #Llama a conexión, crea el objeto PDO y obtiene la variable $db
          require("config/conexion.php");
          $query = "SELECT id, nombre
                    FROM proveedores";

          $result = $db -> prepare($query);
          $result -> execute();
          $dataCollected = $result -> fetchAll();
          ?>
          <div style="display: flex; justify-content: center;">
            <table>
                <tr>
                    <th>Proveedores</th>
                </tr>
                <?php
                foreach ($dataCollected as $p) {
                    echo "<tr> <td><a href='proveedor.php?id=$p[0]'>$p[1]</a></td>  </tr>";
                }
                ?>
              
            </table>
          </div>
        </p>


    </div>
  <br>
  <br>
  <br>
</body>

<?php include('templates/footer.html'); ?>

