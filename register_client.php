<?php
require 'db.php';

// Pega os dados do formulário (POST)
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
$name = $_POST['name'] ?? '';
$cpf = $_POST['cpf'] ?? '';
$address = $_POST['address'] ?? '';
$zip_code = $_POST['zip_code'] ?? '';
$street = $_POST['street'] ?? '';
$city = $_POST['city'] ?? '';
$country = $_POST['country'] ?? '';
$phone_number = $_POST['phone_number'] ?? '';
$preferred_language = $_POST['preferred_language'] ?? 'en';

// Validação básica (você pode melhorar depois)
if (!$email || !$password || !$name || !$cpf) {
    die("Missing required fields.");
}

// Hash da senha
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

try {
    $pdo->beginTransaction();

    // Inserir usuário
    $stmtUser = $pdo->prepare("INSERT INTO users (email, password, role, preferred_language) VALUES (:email, :password, 'client', :lang)");
    $stmtUser->bindParam(':email', $email);
    $stmtUser->bindParam(':password', $hashedPassword);
    $stmtUser->bindParam(':lang', $preferred_language);
    $stmtUser->execute();

    $user_id = $pdo->lastInsertId();

    // Inserir perfil
    $stmtProfile = $pdo->prepare("
        INSERT INTO profiles (user_id, name, cpf, address, zip_code, street, city, country, phone_number)
        VALUES (:user_id, :name, :cpf, :address, :zip, :street, :city, :country, :phone)
    ");
    $stmtProfile->bindParam(':user_id', $user_id);
    $stmtProfile->bindParam(':name', $name);
    $stmtProfile->bindParam(':cpf', $cpf);
    $stmtProfile->bindParam(':address', $address);
    $stmtProfile->bindParam(':zip', $zip_code);
    $stmtProfile->bindParam(':street', $street);
    $stmtProfile->bindParam(':city', $city);
    $stmtProfile->bindParam(':country', $country);
    $stmtProfile->bindParam(':phone', $phone_number);
    $stmtProfile->execute();

    $pdo->commit();

    echo "Client registered successfully!";

} catch (PDOException $e) {
    $pdo->rollBack();
    echo "Error registering client: " . $e->getMessage();
}
?>

