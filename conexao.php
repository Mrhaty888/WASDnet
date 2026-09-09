<?php
$host = "localhost";
$banco = "wasdnet";
$usuario = "root";
$senha = "";

try {
    // Cria a conexão segura usando PDO
    $pdo = new PDO("mysql:host=$host;dbname=$banco;charset=utf8mb4", $usuario, $senha);
    
    // Ativa o modo de erros para o PHP te avisar se algo der errado no banco
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro ao conectar com o banco de dados: " . $e->getMessage());
}
?>