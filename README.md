# Projeto para Etec de Portas Abertas (EPA) - 2025 - 2DS
## Projeto site

### Principal
Apenas exibirá o ranking, sobre o curso (E creditos), galeria e a página principal (Home).
Isso gerá uma melhor organização do layout e a simplificação do layout.
---

### Registro
Apenas os representantes do site podem realizar o registro.
As informações neccesarias são: NOME.
"Opicionals": CONTATO (Seria bom permancer o contato para realizar o contato com o usuario caso ganhe o premio final).
---

### Site para as outras barracas
O ID do usuario será exibido.
Esse usuario deve anotar esse ID no Ticket recebido na entrada.
Ao participar de um projeto o usuario entregará o Ticket para o representantes atuais da barraca.
Com isso os representantes realizaram a busca pelo ID que retornará o NOME do usuario, o ID do usuario e sua quantia de PONTOS atual.
Isso permite que os representantes atualizem a pontuação do usuario
No fim será exibido a pontuação total atualizadada do usario, junto a o tempo gastado.
---

### Sobre timestamp
O Timestamp possui a clausa "ON UPDATE Current_timestamp".
Isso atualizará o tempo final do usuário, Ou seja a quantia de tempo gastada (rTempoFinal - rTempoInicial).
Tambem se atualiza a partir de cada jogo participado pelo usuário.
Com base da pontuação total e do tempo gastado, poderá se realizar o ranking. (Pontos > Tempo).
---
