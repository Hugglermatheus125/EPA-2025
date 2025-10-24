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
    <div class="container flex-grow-1">

    <div class="mcontainer">

    <div class="form-registro d-flex col-12 col-sm-10 col-md-8 col-lg-6">
        <h1 class="creepster-title d-flex col-12 col-sm-10 col-md-8 col-lg-6">Cadastro de Usuário</h1>

        <form action="registro.php" class="afacad-regular" method="post">
            <div class="inpu">
                <label for="pNome" class="label-control">Nome:</label>
                <input type="text" name="pNome" id="pNome" class="form-control" maxlength="50" required autocomplete="off">
                </div><br>
                <button class="btn afacad-regular" onclick="limpar()"><p>Cadastrar</p>
            </form>
            
            
            
            <!-- Formulário de registro -->
        </div>
    </div>
    </div>
    </div>
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
