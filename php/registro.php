<!--   
            Página de regsitro
        Intergrado com o ticket digital
-->

<?php 
include '../includes/header.php';
include '../includes/footer.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="css/registro.css">
</head>
<body>
    <div class="container-fluid">
        <div class="form-registro row col-xl-6 col-s-10 justify-content-center h-100">
            <h1 class="roboto-title text-center">Cadastro de Usuário</h1>
            <form action="registro.php" class="roboto-regular" method="post">
                <label for="pNome" class="label-control">Nome:</label>
                <input type="text" name="pNome" id="pNome" class="form-control" maxlength="50" required autocomplete="off">
                <br>
                <input type="submit" value="Cadastrar" class="btn btn-primary" onclick="limpar()">
            </form>
        </div>
        
        <!-- Formulário de registro -->
        
    </div>
    <div class="mb-3" id="exibirID"></div>
    </body>
</html>

<?php
    /* 
    Verifica se as variáveis existem
    Caso não existam o código para de rodar
    */

    $pNome = isset($_POST['pNome']) ? $_POST['pNome'] : exit();

    // Coloca os valores das variáveis dentro da tabela e colunas especificadas

    $stmt = $pdo->prepare('INSERT INTO infoParticipante (pNome) VALUES (:pNome)');

    // Limpagem de qualquer conteúdo malicios.
    $stmt->bindParam(':pNome', $pNome);
    $stmt->execute();

    // Pega o ID do participante inserido

    $ultimopId = $pdo->lastInsertId();
    
    // Insere o registro correspondente na tabela inforanking com valores padrão

    $stmtRanking = $pdo->prepare('INSERT INTO inforanking (rIdParticipante, rPontuacaoFinal) VALUES (:rIdParticipante, 0)');
    $stmtRanking->execute([':rIdParticipante' => $ultimopId]);


    // Redireciona e passa o ID via GET
    header('Location: ticketDigital.php?id=' . $ultimopId);
    exit();
?>

<?php
include '../includes/footer.php';
?>