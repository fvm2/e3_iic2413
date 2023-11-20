<?php

$db_host = 'localhost';
$db_user = 'grupo98';
$db_password = 'magnesio100';
$db_name = 'grupo98e3';

try {
    $db = new PDO("pgsql:dbname=$db_name;host=$db_host;port=5432;user=$db_user;password=$db_password");

    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}

catch (PDOException $e) {
    echo 'Error de conexión: ' . $e->getMessage();
    exit();
}


$handle = fopen("videojuegos.csv", "r");
if ($handle !== FALSE) {
    $n = 1;
    $stmt = $db->prepare('INSERT INTO videojuegos (id_videojuego,titulo,puntuacion,clasificacion,fecha_de_lanzamiento,beneficio_preorden) VALUES (?, ?, ?, ?, ?, ?)');
    while (($row = fgetcsv($handle)) !== FALSE) {
        if ($n > 1) {
            if (!$stmt->execute($row)) {
                echo "Error al insertar en la fila $n";
            }
        }
        $n++;
    }
    fclose($handle);
}

$handle = fopen("proveedoresvj.csv", "r");
if ($handle !== FALSE) {
    $n = 1;
    $stmt = $db->prepare('INSERT INTO ProveedoresVJ (id_proveedor, nombre, plataforma) VALUES (?, ?, ?)'); 
    while (($row = fgetcsv($handle)) !== FALSE) {
        if ($n > 1) {
            if (!$stmt->execute($row)) {
                echo "Error al insertar en la fila $n";
            }
        }
        $n++;
    }
    fclose($handle);
}

$handle = fopen("pagos.csv", "r");
if ($handle !== FALSE) {
    $n = 1;
    $stmt = $db->prepare('INSERT INTO Pagos (pago_id, id_usuario,id_videojuego,monto,fecha_pago) VALUES (?,?,?,?,?)'); 
    while (($row = fgetcsv($handle)) !== FALSE) {
        if ($n > 1) {
            if (!$stmt->execute($row)) {
                echo "Error al insertar en la fila $n";
            }
        }
        $n++;
    }
    fclose($handle);
}

$handle = fopen("pago_unico.csv", "r");
if ($handle !== FALSE) {
    $n = 1;
    $stmt = $db->prepare('INSERT INTO Pago_unico (pago_id,id_proveedor,preorden) VALUES (?,?)'); 
    while (($row = fgetcsv($handle)) !== FALSE) {
        if ($n > 1) {
            if (!$stmt->execute($row)) {
                echo "Error al insertar en la fila $n";
            }
        }
        $n++;
    }
    fclose($handle);
}

$handle = fopen("suscripciones.csv", "r");
if ($handle !== FALSE) {
    $n = 1;
    $stmt = $db->prepare('INSERT INTO Suscripciones (pago_id,id_suscripcion,fecha_inico,mensualidad) VALUES (?,?,?,?)'); 
    while (($row = fgetcsv($handle)) !== FALSE) {
        if ($n > 1) {
            if (!$stmt->execute($row)) {
                echo "Error al insertar en la fila $n";
            }
        }
        $n++;
    }
    fclose($handle);
}

$handle = fopen("activas.csv", "r"); 
if ($handle !== FALSE) {
    $n = 1;
    $stmt = $db->prepare('INSERT INTO activa (pago_id,id_suscripcion) VALUES (?,?)'); 
    while (($row = fgetcsv($handle)) !== FALSE) {
        if ($n > 1) {
            if (!$stmt->execute($row)) {
                echo "Error al insertar en la fila $n";
            }
        }
        $n++;
    }
    fclose($handle);
}

$handle = fopen("inactivas.csv", "r"); 
if ($handle !== FALSE) {
    $n = 1;
    $stmt = $db->prepare('INSERT INTO inactiva (pago_id,id_suscripcion,fecha_termino) VALUES (?,?,?)'); 
    while (($row = fgetcsv($handle)) !== FALSE) {
        if ($n > 1) {
            if (!$stmt->execute($row)) {
                echo "Error al insertar en la fila $n";
            }
        }
        $n++;
    }
    fclose($handle);
}


$handle = fopen("transaccion.csv", "r"); 
if ($handle !== FALSE) {
    $n = 1;
    $stmt = $db->prepare('INSERT INTO Transaccion (pago_id, id_videojuego, id_usuario, id_proveedor) VALUES (?,?,?,?)'); 
    while (($row = fgetcsv($handle)) !== FALSE) {
        if ($n > 1) {
            if (!$stmt->execute($row)) {
                echo "Error al insertar en la fila $n";
            }
        }
        $n++;
    }
    fclose($handle);
}
$handle = fopen("generos_subgeneros.csv", "r");
if ($handle !== FALSE) {
    $n = 1;
    $stmt = $db->prepare('INSERT INTO generos_subgeneros (genero, subgenero) VALUES (?,?)'); 
    while (($row = fgetcsv($handle)) !== FALSE) {
        if ($n > 1) {
            if (!$stmt->execute($row)) {
                echo "Error al insertar en la fila $n";
            }
        }
        $n++;
    }
    fclose($handle);
}

$handle = fopen("vj_genero.csv", "r");
if ($handle !== FALSE) {
    $n = 1;
    $stmt = $db->prepare('INSERT INTO genero_subgenero (id_videojuego,genero,subgenero) VALUES (?,?)'); 



    while (($row = fgetcsv($handle)) !== FALSE) {
        if ($n > 1) {
            if (!$stmt->execute($row)) {
                echo "Error al insertar en la fila $n";
            }
        }
        $n++;
    }
    fclose($handle);
}


$handle = fopen("resenas.csv", "r");
if ($handle !== FALSE) {
    $n = 1;
    $stmt = $db->prepare('INSERT INTO resenas (id_resena, titulo,texto,veredicto) VALUES (?,?,?,?)'); 
    while (($row = fgetcsv($handle)) !== FALSE) {
        if ($n > 1) {
            if (!$stmt->execute($row)) {
                echo "Error al insertar en la fila $n";
            }
        }
        $n++;
    }
    fclose($handle);
}

$handle = fopen("horas_juego.csv", "r");
if ($handle !== FALSE) {
    $n = 1;
    $stmt = $db->prepare('INSERT INTO horas_juego (id_usuario,id_videojuego,cantidad) VALUES (?,?,?)'); 
    while (($row = fgetcsv($handle)) !== FALSE) {
        if ($n > 1) {
            if (!$stmt->execute($row)) {
                echo "Error al insertar en la fila $n";
            }
        }
        $n++;
    }
    fclose($handle);
}

$handle = fopen("opinion.csv", "r"); 
if ($handle !== FALSE) {
    $n = 1;
    $stmt = $db->prepare('INSERT INTO opinion (id_resena,id_usuario,id_videojuego) VALUES (?,?,?)'); 
    while (($row = fgetcsv($handle)) !== FALSE) {
        if ($n > 1) {
            if (!$stmt->execute($row)) {
                echo "Error al insertar en la fila $n";
            }
        }
        $n++;
    }
    fclose($handle);
}

$handle = fopen("tiene_cuenta.csv", "r"); 
if ($handle !== FALSE) {
    $n = 1;
    $stmt = $db->prepare('INSERT INTO Tiene_cuenta (id_usuario,id_proveedor) VALUES (?,?)'); 
    while (($row = fgetcsv($handle)) !== FALSE) {
        if ($n > 1) {
            if (!$stmt->execute($row)) {
                echo "Error al insertar en la fila $n";
            }
        }
        $n++;
    }
    fclose($handle);
}


$handle = fopen("ofrece.csv", "r"); 
if ($handle !== FALSE) {
    $n = 1;
    $stmt = $db->prepare('INSERT INTO tiene_cuenta (id_proveedor,id_videojuego,precio,precio_preorden,id_usuario,id_proveedor) VALUES (?,?,?,?,?,?)'); 
    while (($row = fgetcsv($handle)) !== FALSE) {
        if ($n > 1) {
            if (!$stmt->execute($row)) {
                echo "Error al insertar en la fila $n";
            }
        }
        $n++;
    }
    fclose($handle);
}















?>

















