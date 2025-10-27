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
        // Explicação de "URLSearchParams(window.location.search).get("id").
        // Numa URL é comum ver o seguinte: "link?VARIAVEL=VALOR".
        // O "window.location.search" retorna QUALQUER valor após o "?".
        // O "new URLSearchParams" cria um mini-objeto contedo as informações após o "?".
        // O "get" selecione em especifico o valor a ser selecionado, nesse caso o ID.
        const idWindowSearch = new URLSearchParams(window.location.search).get("id");
        let output = document.querySelector("#exibirId")
        if (idWindowSearch !== null) {
            localStorage.setItem("idUsuario", idWindowSearch);
        }
        idSalvo = localStorage.getItem("idUsuario");
            if (idSalvo) {
                output.innerHTML = `<p class="afacad-regular-ticket" style="color: wheat;"> ID: ${idSalvo} </p>`;
            }
            else {
                output.innerHTML = `<p> Você não possui um Ticket. <a href="registro.php">Cadastre-se</a> </p>`;
            }

    </script>

<?php 
// Footer agora está no lugar certo
include '../includes/footer.php';
?>

</body>
</html>
