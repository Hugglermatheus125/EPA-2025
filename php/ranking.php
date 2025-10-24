<?php 
include '../includes/connection.php';
include '../includes/header.php';






//Paginação
$limite = 5; // máximo por página
$pagina = isset($_GET['page']) ? (int)$_GET['page'] : 1;

if ($pagina < 1) $pagina = 1;
$inicio = ($pagina - 1) * $limite;

$total = $pdo->query("SELECT COUNT(*) FROM inforanking")->fetchColumn();
$total_paginas = ceil($total / $limite);

$sql = "
    SELECT p.pNome, r.rPontuacaoFinal
    FROM infoparticipante p
    LEFT JOIN inforanking r ON r.rIdParticipante = p.pId
    ORDER BY r.rPontuacaoFinal DESC
    LIMIT $limite OFFSET $inicio
";  
$result = $pdo->query($sql);

$posicao_atual = 0;
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="../styles/ranking.css">
    </head>
    <body>
        <div class="container-fluid flex-grow-1 " >
    <div class="father d-flex flex-column align-items-center ">
        
        <h1 class="text-center creepster-title" style="color: var(--white);">Ranking Geral</h1>

        <form action="ranking.php" method="post">
            <input type="number" name="uId" id="uId" required autocomplete="off" placeholder="Insira seu ID" class="input-search"/>
            <button type="submit" class="btn-form mt-3">Pesquisar</button>
        </form>
        <?php
            if (isset($_POST['uId']) && !empty($_POST['uId'])) {
                // Captura o ID pesquisado
                $rankingBusca = $_POST['uId'];
            
                // Puxa o ranking completo ordenado
                $stmtRankgeral = $pdo->query('SELECT * FROM infoparticipante INNER JOIN inforanking ON infoparticipante.pId = inforanking.rIdParticipante ORDER BY rPontuacaoFinal DESC, TIMESTAMPDIFF(SECOND, rTempoInicial, rTempoFinal) ASC');
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
            
                if ($dadosUsuario) {
                    $tempoInicial = new DateTime($dadosUsuario['rTempoInicial']);
                    $tempoFinal = new DateTime($dadosUsuario['rTempoFinal']);
                    $diferenca = $tempoFinal->diff($tempoInicial);
                    $diferencaformatada = $diferenca->format('%d %H-%i-%s');
                    ?>
                <br>
                <div class=" roboto-regular container-fluid d-flex flex-column leaderboard-container">
                    <div class="roboto-regular display-ranking d-flex row align-items-center justify-content-between">
                        <p class="col-6 p1">
                            <?php
                            $posicaoUsuario++;
                            if($posicaoUsuario == 1){
                                echo '<img src="../assets/primeiro-lugar.png" class=" img-fluid">';
                                
                            }
                            
                            if($posicaoUsuario == 2){
                                echo '<img src="../assets/segundo-lugar.png" class=" img-fluid ">';
                            }
                            
                            if($posicaoUsuario == 3){
                                echo '<img src="../assets/terceiro-lugar.png" class=" img-fluid">';
                            }
                            if ($posicaoUsuario >= 4) {
                                echo $posicaoUsuario;
                                
                                
                            }
                            ?>
                            <img src="../assets/Ellipse-1.png" class="img-fluid img-boll"> <?php echo $participante['pNome']; ?>
                        </p>
                        <p class="col-5 p2">
                            <?php echo $participante['rPontuacaoFinal']; ?>
                        </p>
                    </div>
                </div>

                    <?php
                            
                } else {
                    echo '<p>Nenhum resultado encontrado para o ID informado.</p>';
                }
            } else {
                /*
                    Se não houver um ID buscado
                    Exibir o ranking normalmente.
                */
                $stmtRankgeral = $pdo->query('SELECT * FROM infoparticipante INNER JOIN inforanking ON infoparticipante.pId = inforanking.rIdParticipante ORDER BY rPontuacaoFinal DESC, TIMESTAMPDIFF(SECOND, rTempoInicial, rTempoFinal) ASC');
                $rankingParticipantes = $stmtRankgeral->fetchAll();
                $posicao = 0;
                ?>
                <br>
                <div class="roboto-regular container-fluid d-flex flex-column leaderboard-container">
                
                <?php
                foreach ($rankingParticipantes as $participante) {
                    $tempoInicial = new DateTime($participante['rTempoInicial']);
                    $tempoFinal = new DateTime($participante['rTempoFinal']);
                    $diferenca = $tempoFinal->diff($tempoInicial);
                    $diferencaformatada = $diferenca->format('%d %H-%i-%s');

                    ?>

                    <div class="roboto-regular display-ranking d-flex row align-items-center justify-content-between">

                    <p class="col-6 p1">
                        <?php
                        $posicao++;
                        if($posicao == 1){
                            echo '<img src="../assets/primeiro-lugar.png" class=" img-fluid">';
                            
                        }
                        
                        if($posicao == 2){
                            echo '<img src="../assets/segundo-lugar.png" class=" img-fluid ">';
                        }
                        
                        if($posicao == 3){
                            echo '<img src="../assets/terceiro-lugar.png" class=" img-fluid">';
                        }
                        if ($posicao >= 4) {
                            echo $posicao;
                            
                            
                        }
                        ?>
                        <img src="../assets/Ellipse-1.png" class="img-fluid img-boll"> <?php echo $participante['pNome']; ?>
                    </p>
                    <p class="col-5 p2">
                         <?php echo $participante['rPontuacaoFinal']; ?>
                    </p>
                                                                            </div>
                        
                <?php } ?> 
                <div class="paginas">
                    <?php for ($i = 1; $i <= min(3, $total_paginas); $i++): ?>
                        <a href="?page=<?= $i ?>">
                            <div class="page-btn <?= ($i == $pagina) ? 'active' : '' ?>"><?= $i ?></div>
                        </a>
                    <?php endfor; ?>


                    <?php if ($pagina < $total_paginas): ?>
                        <a href="?page=<?= $pagina + 1 ?>">
                            <div class="page-btn arrow">&gt;</div>
                        </a>
                    <?php endif; ?>
                </div>
        <?php }; ?>
        </div>
    </div>
    </div>
</body>
</html>


<?php  
include '../includes/footer.php';

?>

<!-- Exibindo informações da tabela criada a partir do INNER JOIN -->