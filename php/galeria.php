<?php
include '../includes/connection.php';
include '../includes/header.php';

$pagina = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($pagina < 1) $pagina = 1;

$limite = 15; // 3 fotos x 5 fileiras
$inicio = ($pagina - 1) * $limite;

$buscaNome = isset($_GET['nome']) ? trim($_GET['nome']) : '';

try {
    $sqlTotal = "SELECT COUNT(*) FROM infogaleria i INNER JOIN infoparticipante p ON i.pIdXgId = p.pId";
    if ($buscaNome !== '') $sqlTotal .= " WHERE p.pNome LIKE :nome";

    $stmtTotal = $pdo->prepare($sqlTotal);
    if ($buscaNome !== '') $stmtTotal->bindValue(':nome', "%$buscaNome%");
    $stmtTotal->execute();
    $total_registros = $stmtTotal->fetchColumn();
    $total_paginas = ceil($total_registros / $limite);

    $sql = "SELECT i.gArquivo, p.pNome
            FROM infogaleria i
            INNER JOIN infoparticipante p ON i.pIdXgId = p.pId";
    if ($buscaNome !== '') $sql .= " WHERE p.pNome LIKE :nome";
    $sql .= " ORDER BY i.gId DESC LIMIT :limite OFFSET :inicio";

    $stmt = $pdo->prepare($sql);
    if ($buscaNome !== '') $stmt->bindValue(':nome', "%$buscaNome%");
    $stmt->bindValue(':limite', $limite, PDO::PARAM_INT);
    $stmt->bindValue(':inicio', $inicio, PDO::PARAM_INT);
    $stmt->execute();
    $fotos = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "<p style='color: #f88;'>Erro ao carregar a galeria: " . htmlspecialchars($e->getMessage()) . "</p>";
    $fotos = [];
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Galeria</title>
<link rel="stylesheet" href="../styles/galeria.css">
</head>
<body>
<div class="container-fluid flex-grow-1">
    <div class="mb-3">
        <h1 class="text-center creepster-title">Galeria de fotos</h1>

        <form method="get" class="text-center mb-4">
            <input type="text" name="nome" placeholder="Buscar por nome" value="<?php echo htmlspecialchars($buscaNome); ?>">
            <button type="submit">Buscar</button>
        </form>

        <div class="mcontainer">
            <div class="galeriaFotos">
                <?php if (!empty($fotos)): ?>
                    <?php
                        $contador = 0;
                        foreach ($fotos as $foto):
                            $caminho = "../fotos/" . htmlspecialchars($foto['gArquivo']);
                            $nomeParticipante = htmlspecialchars($foto['pNome']);
                            $contador++;
                    ?>
                    <div class="polaroid">
                        <div class="foto-container">
                            <img src="<?php echo $caminho; ?>" alt="Foto participante" class="foto">
                            <div class="polaroid-frame"></div>
                        </div>
                        <div class="participant-name"><?php echo $nomeParticipante; ?></div>
                    </div>
                    <?php
                        if ($contador >= 15) break; // Limite de 5 fileiras
                    endforeach;
                    ?>
                <?php else: ?>
                    <p style="color: white; text-align:center;">Nenhuma imagem encontrada.</p>
                <?php endif; ?>
            </div>
        </div>

        <div class="pagination">
            <?php for ($i = 1; $i <= $total_paginas; $i++): ?>
                <a href="?page=<?php echo $i; ?><?php echo $buscaNome ? '&nome=' . urlencode($buscaNome) : ''; ?>" class="<?php echo ($i == $pagina) ? 'active' : ''; ?>">
                    <?php echo $i; ?>
                </a>
            <?php endfor; ?>
        </div>

    </div>
</div>
<?php include '../includes/footer.php'; ?>
</body>
</html>
