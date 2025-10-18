<?php

// Configuração da conexão com o BD
$dbHost   = 'localhost';
$dbNome   = 'teste_epav4'; // TROQUE O NOME NA VERSÃO FINAL
$dbUsuario = 'root';
$dbSenha  = ''; // mantenha vazia se o root não tiver senha

try {
    // Força o MySQL a usar autenticação compatível com PHP (mysql_native_password)
    $pdo = new PDO("mysql:host=$dbHost;charset=utf8;", $dbUsuario, $dbSenha);
    $pdo->exec("ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY '';");

    // Agora conecta ao banco
    $pdo = new PDO("mysql:host=$dbHost;dbname=$dbNome;charset=utf8;", $dbUsuario, $dbSenha);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $error) {
    die("Erro na conexão: " . $error->getMessage());
}
?>
