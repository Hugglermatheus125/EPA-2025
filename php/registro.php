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
    <!-- Bootstrap integrado -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark">
    <div class="container flex-grow-1">
        <div class="mcontainer">
            <div class="form-registro col-12 col-sm-10 col-md-8 col-lg-6">
                <h1 class="creepster-title">Cadastro de Usuário</h1>

                <form action="registro.php" class="afacad-regular w-100" method="post">
                    <div class="inpu w-100 d-flex flex-column align-items-center">
                        <label for="pNome" class="label-control mb-2">Nome:</label>
                        <input type="text" name="pNome" id="pNome" class="form-control" maxlength="50" required autocomplete="off">
                    </div>

                    <!-- Botão centralizado -->
                    <div class="d-flex justify-content-center mt-3 w-100">
                        <button type="submit" class="btn afacad-regular">
                            <p>Cadastrar</p>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

<?php
include '../includes/footer.php';

/* Processamento do formulário */
$pNome = isset($_POST['pNome']) ? $_POST['pNome'] : exit();

$stmt = $pdo->prepare('INSERT INTO infoParticipante (pNome) VALUES (:pNome)');
$stmt->bindParam(':pNome', $pNome);
$stmt->execute();

$ultimopId = $pdo->lastInsertId();

$stmtRanking = $pdo->prepare('INSERT INTO inforanking (rIdParticipante, rPontuacaoFinal) VALUES (:rIdParticipante, 0)');
$stmtRanking->execute([':rIdParticipante' => $ultimopId]);

header('Location: ticket.php?id=' . $ultimopId);
exit();
?>
