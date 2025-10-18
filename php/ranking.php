<?php 
include '../includes/connection.php';
include '../includes/header.php';
include '../includes/footer.php';

    /*
    Buscagem de informações da tabela "infoParticipante" e de "infoRanking".
    Depois da buscagem eles se "Juntam" para formar uma unica "Tabela".
    Com isso realiza-se uma "ordem" para determinar os lideres.
    Essa ordem é baseado em Pontos e Tempo gastado.
    Cujo pontos levam a maior prioridade e tempo vem em segundo.
    */

    $stmt = $pdo->query('SELECT * FROM infoparticipante INNER JOIN inforanking ON infoparticipante.pId = inforanking.rIdParticipante ORDER BY rPontuacaoFinal DESC, TIMESTAMPDIFF(SECOND, rTempoInicial, rTempoFinal) ASC');
$rankingParticipantes = $stmt->fetchAll();


?>

    <!-- Exibindo informações da tabela criada a partir do INNER JOIN -->

<?php foreach ($rankingParticipantes as $index => $participante) { 

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
    <p class="roboto-regular">
        Nome: <strong><?php echo $participante['pNome']; ?></strong>
        Pontuação: <strong><?php echo $participante['rPontuacaoFinal']; ?></strong>
        Tempo: <strong><?php echo $diferencaformatada; ?></strong> <!--
                                                                    Formatação: Dia Hora-Minutos-Segunods
                                                                    Por que? O projeto tem uma duração de 2 dias.
                                                                    Seria obsoluto adicionar mês e ano e poderia causar confusão ao adicionar "YYYY MM".
                                                                    Por curiosidade o formato timestamp é:
                                                                            YYYY-MM-DD HH-II-SS
                                                                            Onde que II = Minutos
                                                                    -->
    </p>
    <br>
    <?php } ?>