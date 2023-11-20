<?php
// Arreglo de información de usuarios con sus contraseñas
$users = [];

// Iterar sobre el arreglo de usuarios y encripta sus contraseñas
foreach ($users as &$user) {
    $salt = generateSalt(); // Genera un salt aleatorio para cada user
    $encryptedPassword = crypt($user['password'], $salt);
    $user['password'] = $encryptedPassword;
}

function generateSalt() {
    $salt = '';
    $saltChars = array_merge(range('A','Z'), range('a','z'), range(0,9));
    for ($i = 0; $i < 22; $i++) {
        $salt .= $saltChars[array_rand($saltChars)];
    }
    return '$2y$10$' . $salt;
}
?>