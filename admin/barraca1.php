<?php 
include '../includes/header.php';
include '../includes/footer.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>PdA</title>
    </head>
    <body>
        <div class="mb-3">
            <div class="row"><h1 class="roboto-title">Paínel de Adminstração</h1></div>
            <div class="row"><h2 class="roboto-subtitle text-center mt-3">Barraca 1</h2></div>
            <div class="row"><p class="roboto-regular">Digite o ID do usuario para atualizar sua pontuação</p></div>
            <form action="Barraca1.php" class="roboto-regular" method="post">
                <label for="aId" class="label-control">ID:</label>
                <input type="text" name="aId" id="aId" class="form-control" required autocomplete="off">
                <br>
                <input type="submit" value="Buscar" class="btn btn-primary" onclick="limparId()">
            </form>
        </div>
    </div>
</body>
</html>

<?php

/*
Verifica se as variáveis existem.
Caso não existam o código lerá elas como NULL (Ou sejá não progresserá)
*/
$usuarioId = isset($_POST['aId']) ? $_POST['aId'] : null;

// Inicia a busca
$stmtNome = $pdo->Prepare('SELECT pNome FROM infoparticipante WHERE pId = :aId');

// Limpagem de informações maliciosas
$stmtNome->bindParam(':aId', $usuarioId);
$stmtNome->execute();

$usarioNome = $stmtNome->fetchColumn();

$usarioPontosBarraca1 = isset($_POST['aPontos']) ? $_POST['aPontos'] : null;

if ($usuarioId && !$usarioPontosBarraca1) {

    // Busca pelo ID do usuario para achar sua pontuação
    $stmtPontos = $pdo->prepare('SELECT rPontuacaoFinal FROM inforanking WHERE rIdParticipante = :aId');
    $stmtPontos->bindParam(':aId', $usuarioId);
    $stmtPontos->execute();
    $usarioPontosTotais = $stmtPontos->fetchColumn();
    // Busca pelo ID do usuario para achar sua participação
    $stmtParticipacao = $pdo->prepare('SELECT rParticipouBarraca1, rParticipouBarraca2, rParticipouBarraca3, rParticipouBarraca4 FROM inforanking WHERE rIdParticipante = :aId');
    $stmtParticipacao->bindParam(':aId', $usuarioId);
    $stmtParticipacao->execute();
    $participacao = $stmtParticipacao->fetch(PDO::FETCH_ASSOC);
    // O "fetch(PDO::FETCH_ASSOC)" retorna apenas uma linha dos resultados como um array associativo, onde as chaves são os nomes das colunas.

    if ($usarioNome) {
        /* Caso encontrar:
        Exibe-se o nome e o ID do usuario.
        Além de exibir a opção de adicionar os pontos recebidos.
        Exibir se o usuario participou de
        */
        echo '<div class="mb-3 roboto-regular">
        <p class="row"> Nome do usuário: ' . $usarioNome . ' <br> ID do usuário: ' . $usuarioId . ' <br> Quantia total de pontos atual: ' . $usarioPontosTotais . '</p>';
        echo '<form method="post" action="Barraca1.php" class="roboto-regular mb-3">
        <label for="aPontos" class="label-control">Pontos:</label>
        <input type="number" name="aPontos" id="aPontos" required autocomplete="off" class="form-control">
        <input type="hidden" name="aId" value="' . $usuarioId . '">
        <input type="submit" value="Atualizar" class="btn btn-primary mt-3" onclick="verificarRecompensa()">
        </form>
        </div>';
            echo '<div class="roboto-regular mb-3"
            <p>Participação:</p>';
            for ($i = 1; $i <= 4; $i++) {
                $participou = $participacao['rParticipouBarraca' . $i];
                echo 'Barraca ' . $i . ': ' . ($participou ? 'Sim' : 'Não') . '<br>';
            }
            echo '</div>';
    } else {
        /*
        Caso não ahar:
        Exibir que não achou
        */
        echo '<p class="mb-3 roboto-regular">Usuário não encontrado.</p>';
    }
}


if ($usuarioId && $usarioPontosBarraca1 !== null) {

    // Realizando a busca novamente.
    $stmtPontos = $pdo->prepare('SELECT rPontuacaoFinal, rParticipouBarraca1 FROM inforanking WHERE rIdParticipante = :aId');
    $stmtPontos->bindParam(':aId', $usuarioId);
    $stmtPontos->execute();
    $usarioPontosTotais = $stmtPontos->fetchColumn();

    if ($usarioPontosTotais !== false) {
        /*
        Com os valores do pontos totais e da barraca.
        Realiza-se a soma deles.
        */
        $usarioPontosTotais += $usarioPontosBarraca1;

        // Atualiza o BD
        $stmtAtualizar = $pdo->prepare('UPDATE inforanking SET rPontuacaoFinal = :pontos, rParticipouBarraca1 = 1 WHERE rIdParticipante = :aId');
        $stmtAtualizar->bindParam(':pontos', $usarioPontosTotais);
        $stmtAtualizar->bindParam(':aId', $usuarioId);
        $stmtAtualizar->execute();

        echo '<p class="roboto-regular">Pontuação atualizada para: ' . $usarioPontosTotais . ' e agora participou da 1º Barraca</p>';
    } else {
        echo '<p class="roboto-regular">Erro: Participante não encontrado no ranking.</p>';
    }
}


?>