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
    <title>Upload de Foto</title>
</head>
<body>
    <form action="upload-foto.php" method="post" enctype="multipart/form-data">
        <label for="user-id">ID do Usuário:</label>
        <input type="number" name="user-id" id="user-id" required>
        <br><br>

        <label for="foto-participante">Escolher arquivo</label>
        <input type="file" name="foto-participante" id="foto-participante" accept="image/*" required>
        <br><br>

        <button type="submit">Enviar</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['foto-participante'])) {
        $foto_participante = $_FILES['foto-participante'];
        $pId = intval($_POST['user-id']); 

        if ($foto_participante['error'] === UPLOAD_ERR_OK) {
            $nome_imagem = uniqid() . "-" . basename($foto_participante['name']);
            $caminho_imagem = "../fotos/$nome_imagem";

            if (move_uploaded_file($foto_participante['tmp_name'], $caminho_imagem)) {
                $stmt = $pdo->prepare('INSERT INTO infogaleria (pIdXgId, gArquivo) VALUES (:pIdXgId, :gArquivo)');
                $stmt->bindParam(':pIdXgId', $pId);
                $stmt->bindParam(':gArquivo', $nome_imagem);
                $stmt->execute();

                echo "<p style='color:green;'>✅ Foto enviada com sucesso!</p>";
            } else {
                echo "<p style='color:red;'>Erro ao mover o arquivo.</p>";
            }
        } else {
            echo "<p style='color:red;'>Erro no upload do arquivo.</p>";
        }
    }
    ?>
</body>
</html>
