<?php
session_start();

require("config/conexion.php");


if (!isset($_SESSION['proveedores_vj'])) {
    $_SESSION['proveedores_vj'] = array();
}

