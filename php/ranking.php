<?php 
include '../includes/connection.php';
include '../includes/header.php';

// Paginação
$limite = 8; 
$pagina = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($pagina < 1) $pagina = 1;
$inicio = ($pagina - 1) * $limite;

// Total de registros
$total = $pdo->query("SELECT COUNT(*) FROM inforanking")->fetchColumn();
$total_paginas = ceil($total / $limite);

$posicao_atual = 0;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ranking Geral</title>
    <link rel="stylesheet" href="../styles/ranking.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark">
    <div class="container-fluid flex-grow-1">
        <div class="father d-flex flex-column align-items-center">

            <h1 class="text-center creepster-title mt-3 mb-4">Ranking Geral</h1>

            <form action="ranking.php" method="post" class="afacad-regular d-flex flex-column flex-sm-row align-items-center mb-4">
                <input type="number" name="uId" id="uId" required autocomplete="off" placeholder="Insira seu ID" class="input-search me-sm-2 mb-2 mb-sm-0"/>
                <button type="submit" class="btn-form ">Pesquisar</button>
            </form>

            <?php
            if (isset($_POST['uId']) && !empty($_POST['uId'])) {
                $rankingBusca = $_POST['uId'];
                $stmtRankgeral = $pdo->query('SELECT * FROM infoparticipante INNER JOIN inforanking ON infoparticipante.pId = inforanking.rIdParticipante ORDER BY rPontuacaoFinal DESC, TIMESTAMPDIFF(SECOND, rTempoFinal, rTempoInicial) ASC');
                $rankingCompleto = $stmtRankgeral->fetchAll();
            
                $posicaoUsuario = null;
                $dadosUsuario = null;
                $contador = 1;

                foreach ($rankingCompleto as $participante) {
                    if ($participante['pId'] == $rankingBusca) {
                        $posicaoUsuario = $contador;
                        $dadosUsuario = $participante;
                        break;
                    }
                    $contador++;
                }

                if ($dadosUsuario):
                    $tempoInicial = new DateTime($dadosUsuario['rTempoInicial']);
                    $tempoFinal = new DateTime($dadosUsuario['rTempoFinal']);
                    $diferenca = $tempoFinal->diff($tempoInicial);
                    $diferencaformatada = $diferenca->format('%d %H-%i-%s');
            ?>
            <div class="dform roboto-regular container-fluid d-flex flex-column leaderboard-container col-12 col-sm-10 col-md-8 col-lg-6">
                <div class="roboto-regular display-ranking d-flex flex-wrap align-items-center justify-content-between">
                    <p class="col-6 p4 d-flex align-items-center">
                        <?php
                        $posicaoUsuario++;
                        if($posicaoUsuario == 1) echo '<img src="../assets/primeiro-lugar.png" class="img-fluid me-2">';
                        if($posicaoUsuario == 2) echo '<img src="../assets/segundo-lugar.png" class="img-fluid me-2">';
                        if($posicaoUsuario == 3) echo '<img src="../assets/terceiro-lugar.png" class="img-fluid me-2">';
                        if ($posicaoUsuario >= 4) echo $posicaoUsuario ?> 
                        <img src="../assets/Ellipse-1.png" class="img-fluid img-boll me-2"> <?php echo $participante['pNome']; ?>
                    </p>
                    <p class="col-5 p2 text-end"><?php echo $participante['rPontuacaoFinal']; ?></p>
                </div>
            </div>
            <?php else: ?>
                <p class="text-light">Nenhum resultado encontrado para o ID informado.</p>
            <?php endif; 
            } else {
                $stmtRankgeral = $pdo->query("SELECT * FROM infoparticipante INNER JOIN inforanking ON infoparticipante.pId = inforanking.rIdParticipante ORDER BY rPontuacaoFinal DESC, TIMESTAMPDIFF(SECOND, rTempoFinal, rTempoInicial) ASC LIMIT $limite OFFSET $inicio");
                $rankingParticipantes = $stmtRankgeral->fetchAll();
                $posicao = $inicio;
            ?>
            <div class="container-fluid d-flex flex-column leaderboard-container col-12 col-sm-10 col-md-8 col-lg-6 mb-5">
                <?php foreach ($rankingParticipantes as $participante):
                    $tempoInicial = new DateTime($participante['rTempoInicial']);
                    $tempoFinal = new DateTime($participante['rTempoFinal']);
                    $diferenca = $tempoFinal->diff($tempoInicial);
                    $diferencaformatada = $diferenca->format('%d %H-%i-%s');
                    $posicao++;
                ?>
                <div class="display-ranking d-flex flex-wrap align-items-center justify-content-between">
                    <?php if($posicao <= 3): ?>
                        <p class="col-6 p1 afacad-regular-ranking d-flex align-items-center">
                            <img src="../assets/<?= $posicao == 1 ? 'primeiro-lugar.png' : ($posicao == 2 ? 'segundo-lugar.png' : 'terceiro-lugar.png') ?>" class="img-fluid me-2">
                            <img src="../assets/Ellipse-1.png" class="img-fluid img-boll1 afacad-regular-ranking me-2"> <?= $participante['pNome']; ?>
                        </p>
                    <?php else: ?>
                        <p class="col-6 p3 afacad-regular-ranking d-flex align-items-center">
                            <?= $posicao ?>
                            <img src="../assets/Ellipse-1.png" class="img-fluid img-boll-2 afacad-regular me-2"> <?= $participante['pNome']; ?>
                        </p>
                    <?php endif; ?>
                    <p class="col-5 p2 text-end afacad-regular-ranking"><?= $participante['rPontuacaoFinal']; ?></p>
                </div>
                <?php endforeach; ?>

                <div class="page mt-3">
                    <div class="paginas">
                        <?php for ($i = 1; $i <= min(3, $total_paginas); $i++): ?>
                            <a href="?page=<?= $i ?>">
                                <div class="page-btn afacad-regular <?= ($i == $pagina) ? 'active' : '' ?>"><?= $i ?></div>
                            </a>
                        <?php endfor; ?>
                        <?php if ($pagina < $total_paginas): ?>
                            <a href="?page=<?= $pagina + 1 ?>">
                                <div class="page-btn arrow">&gt;</div>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php }; ?>
        </div>
    </div>
</body>
</html>

<?php include '../includes/footer.php'; ?>
