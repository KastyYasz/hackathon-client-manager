<?php
require 'db.php'; // connect to database

// Simulated data (in real case, use $_POST from a form)
$email = 'client2@example.com';
$password = 'minhasenha123';
$role = 'client'; // or 'admin'

// Hash the password before saving
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

try {
    // Prepare SQL to insert new user
    $stmt = $pdo->prepare("INSERT INTO users (email, password, role) VALUES (:email, :password, :role)");
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $hashedPassword);
    $stmt->bindParam(':role', $role);

    $stmt->execute();

    echo "User registered successfully!";

} catch (PDOException $e) {
    echo "Registration error: " . $e->getMessage();
}
?>
