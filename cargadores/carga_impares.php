<?php
    // Crear conexión a la base de datos
  $db_host = 'localhost';
  $db_user = 'grupo91';
  $db_password = 'roberto_javi';
  $db_name = 'grupo91e3';

  try {
      $db = new PDO("pgsql:dbname=$db_name;host=$db_host;port=5432;user=$db_user;password=$db_password");
      // Configurar el modo de error para lanzar excepciones en caso de error
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch (PDOException $e) {
      // En caso de error en la conexión, muestra un mensaje y termina el script
      echo 'Error de conexión: ' . $e->getMessage();
      exit();
  }
?>

<h1>
    HTML table code for displaying details like name, rollno, city
    in tabular format and store in database
</h1>

<table align="center" width="800"
    border="1" style=
    "border-collapse: collapse;  
    border:1px solid #ddd;"  
    cellpadding="5"
    cellspacing="0">

    <thead>
        <tr bgcolor="#FFCC00">
            <th>
                <center>ID</center>
            </th>
            <th>
                <center>NOMBRE</center>
            </th>
            <th>
                <center>MAIL</center>
            </th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Get csv file
        if (($handle = fopen("usuarios.csv", "r")) !== FALSE) {
          $n = 1;
          $stmt = $db->prepare('INSERT INTO usuarios (id, nombre, mail, password, username, fecha_nacimiento) VALUES (?, ?, ?, ?, ?, ?)');
      
          while (($row = fgetcsv($handle)) !== FALSE) {
              // Skip the header row
              if ($n > 1) {
                  if (!$stmt->execute($row)) {
                      echo "Error al insertar en la fila $n";
                  }
        ?>
                    <tr>
                        <td>
                            <center>
                                <?php echo $row[0]; ?>
                            </center>
                        </td>
                        <td>
                            <center>
                                <?php echo $row[1]; ?>
                            </center>
                        </td>
                        <td>
                            <center>
                                <?php echo $row[2]; ?>
                            </center>
                        </td>
                    </tr>
        <?php
                }

                // Increment record count
                $n++;
            }

            // Closing the file
            fclose($handle);
        }
        ?>
    </tbody>
</table>