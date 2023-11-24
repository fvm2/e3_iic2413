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

if (($handle = fopen("data/pares/filtered_data/tiene_cuenta.csv", "r")) !== FALSE) {
    $db->beginTransaction();
    $n = 1;
    $stmt = $db->prepare('INSERT INTO tiene_cuenta (id_usuario,id_proveedor) VALUES (?,?)');

    while (($row = fgetcsv($handle)) !== FALSE) {
        if ($n > 1) {
            $id_usuario = $row[0]; 
            $id_proveedor = $row[1];

            if (!llaveforanea($id_usuario, 'id_usuario', $db, 'usuarios') || !llaveforanea($id_proveedor,'id_proveedor',$db, 'proveedoresvj')) {
                $errorMessage = "Clave foránea no existe para la fila $n";
                error_log($errorMessage, 3, $logFile);
                $n++;
                continue;
            }

            try {
                // Asegúrate de que el orden de los elementos en $row coincida con tu consulta SQL
                $stmt->execute([$row[0], $row[1]]); 
            } catch (PDOException $ex) {
                $db->rollBack();
                $errorMessage = "Error en la fila $n: " . $ex->getMessage();
                error_log($errorMessage, 3, $logFile);
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
