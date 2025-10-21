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
            <div class="roboto-regular display-ranking d-flex row align-items-center justify-content-between">
                
                
    
                    
                    <p class="col-6 p1">
                        <?php
                        $posicao_atual++;
                        if($posicao_atual == 1){
                            echo '<img src="../assets/primeiro-lugar.png" class=" img-fluid">';
                            
                        }
                        
                        if($posicao_atual == 2){
                            echo '<img src="../assets/segundo-lugar.png" class=" img-fluid ">';
                        }
                        
                        if($posicao_atual == 3){
                            echo '<img src="../assets/terceiro-lugar.png" class=" img-fluid">';
                        }
                        if ($posicao_atual >= 4) {
                            echo $posicao_atual;
                            
                            
                        }
                        ?>
                        <img src="../assets/Ellipse-1.png" class="img-fluid img-boll"> <?php echo  $participante['pNome']; ?>
                    </p>
                    <p class="col-5 p2">
                         <?php echo $participante['rPontuacaoFinal']; ?>
                    </p>
                
                
                <!--
                                                                            Formatação: Dia Hora-Minutos-Segunods
                                                                            Por que? O projeto tem uma duração de 2 dias.
                                                                            Seria obsoluto adicionar mês e ano e poderia causar confusão ao adicionar "YYYY MM".
                                                                            Por curiosidade o formato timestamp é:
                                                                                    YYYY-MM-DD HH-II-SS
                                                                                    Onde que II = Minutos
                                                                                    -->
                                                                            </div>
            <?php } ?>
    
        </div>
    </div>
</body>
</html>


<?php  
include '../includes/footer.php';

?>

<!-- Exibindo informações da tabela criada a partir do INNER JOIN -->