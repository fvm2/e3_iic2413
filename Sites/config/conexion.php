<?php
  
  try {
    #Pide las variables para conectarse a la base de datos.
    require('data.php'); 
    # Se crea la instancia de PDO
    $db = new PDO("pgsql:dbname=$databaseName;host=127.0.0.1;port=5432;user=$user;password=$password");
  } catch (Exception $e) {
    echo "No se pudo conectar a la base de datos: $e";
  }
  try {
    require('data.php');
    $db2 = new PDO("pgsql:dbname=$databaseName2;host=127.0.0.1;port=5432;user=$user2;password=$password2");
    } catch (Exception $e) {
      echo "No se pudo conectar a la base de datos: $e";
    }
?>