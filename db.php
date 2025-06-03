<?php
$host = 'localhost';
$dbname = 'client_system';
$user = 'phpuser';        // novo usuário
$pass = 'senha123';       // senha que você criou pro phpuser

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   // echo "Conectado com sucesso!";
} catch (PDOException $e) {
    echo "Erro na conexão: " . $e->getMessage();
}
?>

