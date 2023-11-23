<?php
include('config/conexion.php');

$query = "UPDATE suscripciones
          SET activa = 'no'
          WHERE fecha_termino < CURDATE() AND activa = 'si'";

$result = $db->prepare($query);
$result->execute();
?>