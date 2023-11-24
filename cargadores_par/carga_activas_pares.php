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

if (($handle = fopen("data/pares/filtered_data/activas.csv", "r")) !== FALSE) {
    $db->beginTransaction();
    $n = 1;
    $stmt = $db->prepare('INSERT INTO activa (pago_id, id_suscripcion) VALUES (?, ?)');

    while (($row = fgetcsv($handle)) !== FALSE) {
        if ($n > 1) {
            // Validar que pago_id existe en la tabla pagos antes de intentar insertar
            $pago_id = $row[0];
            if (!llaveprimaria($pago_id, $db)) {
                $errorMessage = "pago_id $pago_id no existe en la tabla pagos, fila $n";
                error_log($errorMessage, 3, $logFile);
                $n++;
                continue;
            }


            try {
                $stmt->execute($row);
            } catch (PDOException $ex) {
                $db->rollBack();
                $errorMessage = "Error en la fila $n: " . $ex->getMessage();
                error_log($errorMessage, 3, $logFile);
                echo $errorMessage;
                fclose($handle);
                exit('Error al insertar datos. Ver log para detalles.');
            }
        }
        $n++;
    }

    $db->commit();
    fclose($handle);
}

function llaveprimaria($pago_id, $db) {
    $stmt = $db->prepare("SELECT COUNT(*) FROM pagos WHERE pago_id = ?");
    $stmt->execute([$pago_id]);
    return $stmt->fetchColumn() > 0;
}
?>
