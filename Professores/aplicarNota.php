<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AplicarNota</title>
    <link rel="stylesheet" href="../index.css">
    <link rel="stylesheet" href="professores.css">
</head>
<body>
    <form class="formulario">
        <input type="text" placeholder="Digite o id do aluno">
        <input class="sub" type="submit" value="Procurar">

        <!--Display = none, deverá aparecer quando for confirmado o id do aluno-->
        <div id="formulario2">

        <!--Aqui deverá aparecer o nome do aluno ao qual pertence o id-->
            <h3>Aluno x</h3>

        <!--Nota a ser aplicada para o aluno-->
            <input type="number" placeholder="Digite a nota a aplicar">
            <input class="sub" type="submit" value="Aplicar">
        </div>
    </form>
</body>
</html>