<?php 
include '../includes/connection.php';
include '../includes/header.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/galeria.css">
    <title>Galeria</title>
</head>
<body>
    <div class="container-fluid flex-grow-1 py-5">
        <div class="row mb-3 justify-content-center">
            <div class="col-12">
                <h1 class="creepster-title text-center text-white">Galeria de fotos</h1>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8">
                <div class="galeriaFotos">

                    <!-- As fotos serão inseridas automaticamente via GitHub -->
                     
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<?php
include '../includes/footer.php';
// Crie um input para reaizar a busca.
if (isset($_POST['Id']) && !empty($_POST['Id'])){
    // Busca por ID.
    $stmtBusca = $pdo->prepare('SELECT gArquivo FROM infogaleria INNER JOIN infoparticipante ON infoparticipante.pId = infogaleria.pIdXgId WHERE pIdXgId = :buscarId');
    $stmtBusca->bindParam(":buscarId", $buscarId);
    $stmtBusca->fetchAll();
    $stmtBusca->execute();
    $galeriaBusca = $stmtBusca;
    echo $galeriaBusca;
}
else {
    // Busca completa.
    $stmtBuscaCompleta = $pdo->query('SELECT gArquivo FROM infogaleria INNER JOIN infoparticipante ON infoparticipante.pId = infogaleria.pIdXgId');
    $stmtBuscaCompleta->fetchAll();
    $stmtBuscaCompleta->execute();
    $galeriaCompleta = $stmtBuscaCompleta;
        echo $galeriaCompleta;
}

?>
