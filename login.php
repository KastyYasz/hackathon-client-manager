<?php
require 'db.php'; // connect to database

// Get data from POST
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

if (!$email || !$password) {
    die("Email and password are required.");
}

try {
    // Prepare SQL to find user by email
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if user exists and verify password
    if ($user && password_verify($password, $user['password'])) {
        echo "Login successful! Welcome, " . $user['email'] . " (" . $user['role'] . ")";
    } else {
        echo "Invalid email or password.";
    }

} catch (PDOException $e) {
    echo "Login error: " . $e->getMessage();
}
?>
