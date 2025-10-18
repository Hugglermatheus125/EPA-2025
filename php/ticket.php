<!--   
            Página do ticket digital.
        Exibir as informações do usuario.
-->

<?php 
include '../includes/header.php';
include '../includes/footer.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket Digital</title>
</head>
<body>
    <div class="mb-3">
        <div class="row roboto-regular">
            <span id="exibirId"></span>
        </div>
    </div>
    <script>
        // Explicação de "URLSearchParams(window.location.search).get("id").
        // Numa URL é comum ver o seguinte: "link?VARIAVEL=VALOR".
        // O "window.location.search" retorna QUALQUER valor após o "?".
        // O "new URLSearchParams" cria um mini-objeto contedo as informações após o "?".
        // O "get" selecione em especifico o valor a ser selecionado, nesse caso o ID.
        const id = new URLSearchParams(window.location.search).get("id");

        if (id) {
        localStorage.setItem("idUsuario", id);
        }

        let output = document.querySelector("#exibirId")
        output.innerHTML = `<p class="roboto-regular"> Seu ID é: ${id} </p>`
    </script>
</body>
</html>