<?php
require 'db.php';

$email = 'admin1@admin.com';
$password = 'admin123';
$role = 'admin';
$preferred_language = 'en';

// Hash the password securely
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

try {
    // Prepare and insert admin user
    $stmt = $pdo->prepare("INSERT INTO users (email, password, role, preferred_language) VALUES (:email, :password, :role, :lang)");
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $hashedPassword);
    $stmt->bindParam(':role', $role);
    $stmt->bindParam(':lang', $preferred_language);
    $stmt->execute();

    echo "Admin registered successfully with email: $email and password: $password";

} catch (PDOException $e) {
    echo "Error creating admin: " . $e->getMessage();
}
?>
