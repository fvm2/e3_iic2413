<?php include('templates/header.html');   ?>

<body>
<?php
require("../config/conexion.php");

// Obtener información del usuario
$query = ";";

$result = $db -> prepare($query);
$result -> execute();
$dataCollected = $result -> fetchAll();

// Crear vista materializada
$createViewQuery = "
    CREATE MATERIALIZED VIEW IF NOT EXISTS user_profile_view AS
    SELECT
        u.name,
        u.email,
        u.username,
        s.subscription_type,
        s.purchase_date,
        s.hours_used,
        u.age
    FROM
        usuarios u, suscripciones s
    WHERE
        # fecha compra no null
        AND u.id = s.
    ORDER BY
        s.purchase_date DESC
";

$result = $db -> prepare($createViewQuery);
$result -> execute();
$vista_materializada = $result -> fetchAll();

// Crear trigger para que se refresque la vista materializada diariamente
$refreshViewQuery = "REFRESH MATERIALIZED VIEW user_profile_view";

// Obtener información de la vista materializada
$getUserProfileQuery = "
    SELECT
        name,
        email,
        username,
        subscription_type,
        purchase_date,
        hours_used,
        age
    FROM
        user_profile_view
";

try {
    $stmt = $pdo->query($getUserProfileQuery);
    $profileData = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Display the profile information
    foreach ($profileData as $row) {
        echo "Name: " . $row['name'] . "<br>";
        echo "Email: " . $row['email'] . "<br>";
        echo "Username: " . $row['username'] . "<br>";
        echo "Subscription Type: " . $row['subscription_type'] . "<br>";
        echo "Purchase Date: " . $row['purchase_date'] . "<br>";
        echo "Hours Used: " . $row['hours_used'] . "<br>";
        echo "Age: " . $row['age'] . "<br>";
        echo "<br>";
    }
} catch (PDOException $e) {
    die("Error retrieving profile information: " . $e->getMessage());
}

?>

<?php include('templates/footer.html'); ?>