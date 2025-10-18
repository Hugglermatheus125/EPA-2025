function limparId() {
    // Limpar ID
    let limparId = document.querySelector("#aId").value

    limparId.value = ""

}

function verificarRecompensa() {
    // Verifica-se o usuario receberá uma recompensa
    b1PontosRequiridos = 10 // Número será decido - Barraca 1
    b2PontosRequiridos = 10 // Número será decido - Barraca 2
    b3PontosRequiridos = 10 // Número será decido - Barraca 3
    b4PontosRequiridos = 10 // Número será decido - Barraca 4

    let pontosObtidos = document.querySelector("#aPontos").value
    if (pontosObtidos >= b1PontosRequiridos || pontosObtidos >= b2PontosRequiridos || pontosObtidos >= b3PontosRequiridos || pontosObtidos >= b4PontosRequiridos) {
        alert("Usuário receberá a recompensa");
    }
    else {
        alert("Usuário NÃO receberá a recompensa")
    }

    // Limpar Pontos
    let limparPontos = document.querySelector("#aPontos").value

    limparPontos.values = ""
}

function limpar() {
    // Limpagem dos campos.
    let limparNome = document.querySelector("#pNome").value
    let limparContato = document.querySelector("#pContato").value

    limparNome.value = ""
    limparContato.value = ""
}