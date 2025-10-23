<?php

// Configuração da conexão com o BD
$dbHost = 'localhost';
$dbNome = 'teste_epav5';  // TROQUE O NOME NA VERSÃO FINAL
$dbUsario = 'root';
$dbSenha = '';

// Realizando conexão com o BD 

try {
    $pdo = new PDO("mysql:host=$dbHost;dbname=$dbNome;charset=utf8;", $dbUsario, $dbSenha);

} catch (PDOException $error) {
    die("Error: " . $error->getMessage());
}
?>
