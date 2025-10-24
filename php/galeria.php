<!--
                    Galeria de fotos
    Se refere as fotos dos participantes geradas por AI
    Será inserido aqui automaticamente a partir do GITHUB
-->
<?php 
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
    <div class="container-fluid flex-grow-1">
        <div class="mb-3">
            <div class="row"><h1 class="text-center creepster-title" style="color: var(--white);">Galeria de fotos</h1></div>
            <div class="mcontainer">
                
         <div class="galeriaFotos"></div>
           
        </div>
         
        </div>
    </div>
    
</body>
</html>

<?php
include '../includes/footer.php';
?>