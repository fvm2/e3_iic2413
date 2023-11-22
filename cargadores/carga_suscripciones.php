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

if (($handle = fopen("data/pares/filtered_data/suscripciones.csv", "r")) !== FALSE) {
    $db->beginTransaction();
    $n = 1;
    $stmt = $db->prepare('INSERT INTO suscripciones (pago_id, id_suscripcion, fecha_inicio,mensualidad) VALUES (?,?,?,?)'); 

    while (($row = fgetcsv($handle)) !== FALSE) {
        if ($n > 1) {
            $pago_id = $row[0];
            if (!llaveforanea($pago_id, 'pago_id', $db, 'pagos')) {
                $errorMessage = "pago_id $pago_id no existe en la tabla pagos, fila $n";
                error_log($errorMessage, 3, $logFile);
                $n++;
                continue;
            }

            try {
                $stmt->execute([$row[0], $row[1], $row[2], $row[3]]); 
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

function llaveforanea($clave, $id, $db, $tabla) {
    $stmt = $db->prepare("SELECT COUNT(*) FROM $tabla WHERE $id = ?");
    $stmt->execute([$clave]);
    return $stmt->fetchColumn() > 0;
}
?>
