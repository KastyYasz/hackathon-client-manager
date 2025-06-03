<?php
require 'db.php'; // database connection

try {
    // Prepare SQL to fetch all client users with their profiles
    $stmt = $pdo->prepare("
        SELECT 
            u.id AS user_id,
            u.email,
            p.name,
            p.cpf,
            p.address,
            p.zip_code,
            p.street,
            p.city,
            p.country,
            p.phone_number
        FROM users u
        JOIN profiles p ON u.id = p.user_id
        WHERE u.role = 'client'
    ");

    $stmt->execute();

    $clients = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Check if there are any clients
    if ($clients) {
        foreach ($clients as $client) {
            echo "ID: " . $client['user_id'] . PHP_EOL;
            echo "Name: " . $client['name'] . PHP_EOL;
            echo "Email: " . $client['email'] . PHP_EOL;
            echo "CPF: " . $client['cpf'] . PHP_EOL;
            echo "Address: " . $client['address'] . ", " . $client['street'] . PHP_EOL;
            echo "City: " . $client['city'] . " | Country: " . $client['country'] . PHP_EOL;
            echo "ZIP: " . $client['zip_code'] . " | Phone: " . $client['phone_number'] . PHP_EOL;
            echo "-------------------------------" . PHP_EOL;
        }
    } else {
        echo "No clients found.";
    }

} catch (PDOException $e) {
    echo "Error fetching clients: " . $e->getMessage();
}
?>
