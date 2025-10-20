<?php 
include '../includes/connection.php';
include '../includes/header.php';

$stmt = $pdo->query('SELECT * FROM infoparticipante INNER JOIN inforanking ON infoparticipante.pId = inforanking.rIdParticipante ORDER BY rPontuacaoFinal DESC, TIMESTAMPDIFF(SECOND, rTempoInicial, rTempoFinal) ASC');
$rankingParticipantes = $stmt->fetchAll();


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
    <div class="d-flex flex-column justify-content-around align-items-center">
        
        <h1 class="text-center creepster-title">Ranking Geral</h1>
        
        <input type="text" name="buscar" id="input-search" class="input-search">
        <br>
        
        <div class=" roboto-regular container-fluid d-flex flex-column leaderboard-container">
            
            <?php 
                foreach ($rankingParticipantes as $index => $participante) { 
                    
                    // Convertendo os timestamps para objetos DateTime.
                    $tempoInicial = new DateTime($participante['rTempoInicial']);
                    $tempoFinal = new DateTime($participante['rTempoFinal']);
                    
                    // Calculando a diferença entre as duas datas.
                    $diferenca = $tempoFinal->diff($tempoInicial);
                    
                    /*
                    Formata o resultado a partir to "DateInterval::Format".
                    Que seria o "Quanto tempo foi gastado".
                */
                $diferencaformatada = $diferenca->format('%d %H-%i-%s');
                
                ?>
            <p class="roboto-regular display-ranking d-flex row">
                
                <?php
                        $posicao_atual++;
                        if($posicao_atual == 1){
                            echo '<img src="ouro">';
                            
                        }
                        
                        if($posicao_atual == 2){
                            echo '<img src="prata">';
                        }
                        
                        if($posicao_atual == 3){
                            echo '<img src="bronze">';
                        }
                        if ($posicao_atual >= 4) {
                            echo $posicao_atual;
                            
                            
                        }
                        ?>
    
                    <img src="bolinha-preta">
                    <div class="col-6"><?php echo $participante['pNome']; ?></div>
                    <div class="col-6">Pontuação: <?php echo $participante['rPontuacaoFinal']; ?></div>
                
                
                <!--
                                                                            Formatação: Dia Hora-Minutos-Segunods
                                                                            Por que? O projeto tem uma duração de 2 dias.
                                                                            Seria obsoluto adicionar mês e ano e poderia causar confusão ao adicionar "YYYY MM".
                                                                            Por curiosidade o formato timestamp é:
                                                                                    YYYY-MM-DD HH-II-SS
                                                                                    Onde que II = Minutos
                                                                                    -->
            </p>
            <?php } ?>
    
        </div>
    </div>
</body>
</html>


<?php  
include '../includes/footer.php';

?>

<!-- Exibindo informações da tabela criada a partir do INNER JOIN -->