<?php
\\ Credenciales
$db_host = 'localhost';

$db_user_98 = 'grupo98';
$db_password_98 = 'magnesio100';
$db_name_98 = 'grupo98e3';

$db_user_91 = 'grupo91';
$db_password_91 = 'roberto_javi';
$db_name_91 = 'grupo91e3';

\\ Carga para el grupo 91
$db_91 = new PDO("pgsql:dbname=$db_name_91;host=$db_host;port=5432;user=$db_user_91;password=$db_password_91");

$stmt_91 = $db_91->query('SELECT * FROM usuarios');
$users_91 = $stmt_91->fetchAll(PDO::FETCH_ASSOC);

foreach ($users_91 as $user) {
    $salt = generateSalt();
    $encryptedPassword = crypt($user['password'], $salt);

    $stmt = $db_91->prepare('UPDATE usuarios SET password = ? WHERE id_usuario = ?');
    $stmt->execute([$encryptedPassword, $user['id_usuario']]);
}

\\ Carga para el grupo 98
$db_98 = new PDO("pgsql:dbname=$db_name_98;host=$db_host;port=5432;user=$db_user_98;password=$db_password_98");

$stmt_98 = $db_98->query('SELECT * FROM usuarios');
$users_98 = $stmt_98->fetchAll(PDO::FETCH_ASSOC);

foreach ($users_98 as $user) {
    $salt = generateSalt();
    $encryptedPassword = crypt($user['password'], $salt);

    $stmt = $db_98->prepare('UPDATE usuarios SET password = ? WHERE id_usuario = ?');
    $stmt->execute([$encryptedPassword, $user['id_usuario']]);
}

\\ Función para generar salt
function generateSalt() {
    $salt = '';
    $saltChars = array_merge(range('A','Z'), range('a','z'), range(0,9));
    for ($i = 0; $i < 22; $i++) {
        $salt .= $saltChars[array_rand($saltChars)];
    }
    return '$2y$10$' . $salt;
}
?>