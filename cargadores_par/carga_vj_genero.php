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

if (($handle = fopen("data/pares/filtered_data/vj_genero.csv", "r")) !== FALSE) {
    $db->beginTransaction();
    $n = 1;
    $stmt = $db->prepare('INSERT INTO vj_genero (id_videojuego,genero) VALUES (?,?)'); 

    while (($row = fgetcsv($handle)) !== FALSE) {
        if ($n > 1) {
            $id_videojuego = $row[0]; // Asumiendo que id_videojuego es la tercera columna en tu CSV
            if (!llaveforanea($id_videojuego, $db)) {
                $errorMessage = "id_videojuego $id_videojuego no existe en la tabla videojuegos, fila $n";
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

function llaveforanea($id_videojuego, $db) {
    $stmt = $db->prepare("SELECT COUNT(*) FROM videojuegos WHERE id_videojuego = ?");
    $stmt->execute([$id_videojuego]);
    return $stmt->fetchColumn() > 0;
}
?>
