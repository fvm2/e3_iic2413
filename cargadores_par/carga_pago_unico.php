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

    if (($handle = fopen("data/pares/filtered_data/pago_unico.csv", "r")) !== FALSE) {
        $db->beginTransaction();
        $n = 1;
        $stmt = $db->prepare('INSERT INTO Pago_unico (pago_id, id_proveedor, preorden) VALUES (?,?,?)');  

        while (($row = fgetcsv($handle)) !== FALSE) {
            if ($n > 1) {
                $pago_id = $row[0]; 
                $id_proveedor = $row[1];
    
                if (!llaveforanea($pago_id, 'pago_id', $db, 'pagos')) {
                    $errorMessage = "Clave foránea no existe para la fila $n";
                    error_log($errorMessage, 3, $logFile);
                    $n++;
                    continue;
                } elseif (!llaveforanea($id_proveedor,'id_proveedor',$db, 'proveedoresvj')) {
                    $errorMessage = "Clave foránea vj no existe para la fila $n";
                    error_log($errorMessage, 3, $logFile);
                    $n++;
                    continue;
                }
    
                try {
                    // Asegúrate de que el orden de los elementos en $row coincida con tu consulta SQL
                    $pago_id = (int)$row[0]; 
                    $id_proveedor = (int)$row[1];

                    $stmt->bindParam(1, $pago_id, PDO::PARAM_INT);
                    $stmt->bindParam(2, $id_proveedor, PDO::PARAM_INT);
                    $stmt->bindParam(3, $row[2], PDO::PARAM_BOOL);

                    $stmt->execute();
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
    