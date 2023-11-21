<?php
// Crear conexión a la base de datos
$db_host = 'localhost';
$db_user = 'grupo98';
$db_password = 'magnesio100';
$db_name = 'grupo98e3';

try {
    $db = new PDO("pgsql:dbname=$db_name;host=$db_host;port=5432;user=$db_user;password=$db_password");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Error de conexión: ' . $e->getMessage();
    exit();
}

$logFile = 'error_log.txt';

if (($handle = fopen("data/pares/filtered_data/pagos.csv", "r")) !== FALSE) {
    $db->beginTransaction();
    $n = 1;
    $stmt = $db->prepare('INSERT INTO Pagos (pago_id, monto, fecha_pago, id_usuario, id_videojuego) VALUES (?, ?, ?, ?, ?)');

    while (($row = fgetcsv($handle)) !== FALSE) {
        if ($n > 1) {
            $id_videojuego = $row[4];
            if (!llaveprimaria($id_videojuego, $db)) {
                $errorMessage = "id_videojuego $id_videojuego no existe en la tabla videojuegos, fila $n";
                error_log($errorMessage, 3, $logFile);
                $n++;
                continue;
            }

            // Formatear la fecha antes de insertarla en la base de datos
            $formattedDate = date('Y-m-d', strtotime($row[2]));

            try {
                // Usar bindParam para asignar correctamente el tipo de dato a la fecha
                $stmt->bindParam(1, $row[0], PDO::PARAM_INT);
                $stmt->bindParam(2, $row[1], PDO::PARAM_INT);
                $stmt->bindParam(3, $formattedDate, PDO::PARAM_STR);
                $stmt->bindParam(4, $row[3], PDO::PARAM_INT);
                $stmt->bindParam(5, $id_videojuego, PDO::PARAM_INT);

                $stmt->execute();
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

function llaveprimaria($id_videojuego, $db) {
    $stmt = $db->prepare("SELECT COUNT(*) FROM videojuegos WHERE id_videojuego = ?");
    $stmt->execute([$id_videojuego]);
    return $stmt->fetchColumn() > 0;
}
?>
