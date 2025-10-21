<!--   
            Página de regsitro
        Intergrado com o ticket digital
-->

<?php 
include '../includes/header.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="../styles/registro.css">
</head>
    <div class="container-fluid d-flex flex-grow-1">
        <div class="form-registro d-flex row col-xl-6 col-s-10 align-items-center justify-content-center">
            <h1 class="creepster-title">Cadastro de Usuário</h1>
            <form action="registro.php" class="afacad-regular" method="post">
                <label for="pNome" class="label-control">Nome:</label>
                <input type="text" name="pNome" id="pNome" class="form-control" maxlength="50" required autocomplete="off">
                <br>
                <button class="btn afacad-regular" onclick="limpar()"><p>Cadastrar</p><button>
            </form>
        </div>
        
        <!-- Formulário de registro -->
        
    </div>
    <div class="mb-3" id="exibirID"></div>
    <!-- </body> -->

<?php
include '../includes/footer.php';
?>

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
    header('Location: ticket.php?id=' . $ultimopId);
    exit();
?>
