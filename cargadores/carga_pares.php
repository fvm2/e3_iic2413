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
}

catch (PDOException $e) {
    // En caso de error en la conexión, muestra un mensaje y termina el script
    echo 'Error de conexión: ' . $e->getMessage();
    exit();
}
?>


<?php
// Get csv file
if (($handle = fopen("archivo.csv", "r")) !== FALSE) {
    $n = 1;
    $stmt = $db->prepare('INSERT INTO tabla() VALUES ()');

    while (($row = fgetcsv($handle)) !== FALSE) {
        // Skip the header row
        if ($n > 1) {
            if (!$stmt->execute($row)) {
                echo "Error al insertar en la fila $n";
            }
?>

<?php
// Increment record count
$n++;
// Closing the file
fclose($handle);
?>