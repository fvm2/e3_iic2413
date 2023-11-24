<?php
    // Crear conexión a la base de datos
    $db_host = 'localhost';
    $db_user = 'grupo98';
    $db_password = 'magnesio100';
    $db_name = 'grupo98e3';

    try {
        $db = new PDO("pgsql:dbname=$db_name;host=$db_host;port=5432;user=$db_user;password=$db_password");
        // Configurar el modo de error para lanzar excepciones en caso de error
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        // En caso de error en la conexión, muestra un mensaje y termina el script
        echo 'Error de conexión: ' . $e->getMessage();
        exit();
    }

    $logFile = 'error_log.txt';

    // Get csv file
    if (($handle = fopen("data/pares/filtered_data/proveedoresvj.csv", "r")) !== FALSE) {
        $n = 1;
        $stmt = $db->prepare('INSERT INTO ProveedoresVJ (id_proveedor,nombre,plataforma) VALUES (?, ?, ?)'); 

        while (($row = fgetcsv($handle)) !== FALSE) {
            // Skip the header row
            if ($n > 1) {
                try {
                    if (!$stmt->execute($row)) {
                        $errorMessage = "Error al insertar en la fila $n";
                        echo $errorMessage;
                        error_log($errorMessage, 3, $logFile);

                        // Opción b: Omitir la fila actual y continuar con la siguiente
                        continue;
                    }
                } catch (PDOException $ex) {
                    // Capturar la excepción y manejarla
                    $errorMessage = "Error en la fila $n: " . $ex->getMessage();
                    echo $errorMessage;
                    
                    // Verificar si el archivo de registro existe antes de escribir en él
                    if (isset($logFile) && !empty($logFile)) {
                        error_log($errorMessage, 3, $logFile);
                    }

                    // Opción b: Omitir la fila actual y continuar con la siguiente
                    continue;
                }
            }

            // Increment record count
            $n++;
        }

        // Commit de la transacción
        $db->commit();

        // Closing the file
        fclose($handle);
    }
?>
