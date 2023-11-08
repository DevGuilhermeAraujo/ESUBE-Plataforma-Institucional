<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comunicações</title>
    <link rel="stylesheet" href="../index.css">
    <link rel="stylesheet" href="../Cadastrados/tabelas.css">
    <link rel="stylesheet" href="comunicações.css">
</head>
<body>
<div class="painelCom">
        <form class="enviar">
            <div style="width: 100%;display:flex;flex-flow:row nowrap">
                <input class="tit" type="text" placeholder="Titulo">
                <select name="" id="SelectTurma">
                    <option value="">Todas</option>
                    <option value="">Turma x</option>
                </select>
            </div>
            <input class="tex" type="text" placeholder="Mensagem">
            <input style="margin-left: 40%;" class="env" type="submit" value="Enviar">
        </form>
        <div class="enviadas">
            <h2>Titulo1</h2>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Reprehenderit sint dolore eaque quibusdam soluta incidunt minus, laudantium veniam similique ipsam ipsum laboriosam eligendi architecto atque impedit? Vero expedita optio sunt!</p>
            <h2>Titulo2</h2>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium possimus deleniti laborum! Tempora fugit odio odit accusamus? Aliquam explicabo alias officia at velit iste. Dolorum illum dolorem aspernatur nihil quibusdam.</p>
        </div>
        <div class="not">
            <div class="dados">
                <div class="titulos">
                    <p>
                        <span>Referência</span>
                        <span>Aluno</span>
                        <span>Mensagem</span>
                        <span>Excluir</span>
                    </p>
                </div>
                <p>
                        <span>Mensagem que foi respondida</span>
                        <span>Quem respondeu</span>
                        <span>Resposta</span>
                        <span><button><img class="ico" src="../Imgs/iconLixeira.png" alt=""></button></span>
                    </p>
                    <p>
                        <span>Eu envio</span>
                        <span>Eu respondo</span>
                        <span>Respondi aqui</span>
                        <span><button><img class="ico" src="../Imgs/iconLixeira.png" alt=""></button></span>
                    </p>
            </div>
        </div>
    </div>
</body>
</html>