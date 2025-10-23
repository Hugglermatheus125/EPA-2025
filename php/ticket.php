<?php 
include '../includes/header.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket Digital</title>
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="stylesheet" href="../styles/ticket.css">
</head>
<body>

<div class="father">
     <div class="ticket-container">
        <img class="img-fluid ticket-bg" src="../assets/ticket.png" alt="Ticket">
        <div class="id-area" id="exibirId"></div>
    </div>
</div>

<script>
    const idWindowSearch = new URLSearchParams(window.location.search).get("id");
    let output = document.querySelector("#exibirId");

    if (idWindowSearch !== null) {
        localStorage.setItem("idUsuario", idWindowSearch);
    }

    const idSalvo = localStorage.getItem("idUsuario");

    if (idSalvo) {
        output.textContent = `ID: ${idSalvo}`;
    } else {
        output.innerHTML = `<p class="roboto-regular">Você não possui um Ticket. <a href="registro.php">Cadastre-se</a></p>`;
        output.style.position = "static";
        output.style.textAlign = "center";
        output.style.color = "#fff";
        output.style.paddingTop = "20px";
    }
</script>

<?php 
// Footer agora está no lugar certo
include '../includes/footer.php';
?>

</body>
</html>
