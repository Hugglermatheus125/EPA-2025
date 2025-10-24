<?php 
include '../includes/connection.php';
include '../includes/header.php';

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="upload-foto.php" method="post" enctype="multipart/form-data">
        <label for="foto-participante">Escolher arquivo</label>
        <input type="file" name="foto-participante" id="foto-participante">

        <button type="submit">Submit</button>
    </form>
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $foto_participante = isset($_FILES['foto-participante']) ? $_FILES['foto-participante'] : exit();

    $nome_imagem = uniqid() . "-" . $foto_participante['name'];
    $caminho_imagem = "../fotos/$nome_imagem";
    move_uploaded_file($foto_participante['tmp_name'], $caminho_imagem);

    $stmt = $pdo->prepare('INSERT INTO infoGaleria (gArquivo) VALUES (:gArquivo)');
    $stmt->bindParam(':gArquivo', $nome_imagem);
    $stmt->execute();
    }
    ?>
</body>
</html>