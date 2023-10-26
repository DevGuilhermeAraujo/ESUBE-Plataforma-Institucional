<?php
        // Coleta os dados do formulário
        $nome = $_POST['nome'];
        $cpf = $_POST['cpf'];
        $genero = $_POST['genero'];
        $dataNasc = $_POST['dtNasc'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $passwordError = "";  // Inicialize a mensagem de erro da senha como vazia

        // Inclua o arquivo de conexão com o banco de dados
        require_once('../BackEnd/conexao.php');
        $db = new Conexao();

        // Verificar se a conexão foi estabelecida com sucesso
        if ($db->errorCode === 0) {

            // Preparar a consulta SQL para inserção de dados na tabela de professores com espaços reservados
            $result = $db->executar("INSERT INTO usuarios(nome, cpf, sexo, dataNasc, email, senha) VALUES ('$nome', '$cpf', $genero, '$dataNasc', '$email', '$senha')", true);

            if ($result) {
                echo "<script> alert('Usuário cadastrado com sucesso'); </script>";
            } else {
                
            }
            
        } else {
            // Lidar com erros de conexão, se houver
            header("Location: ../Gerente/CadProfessor.php?ERROR=1");
            exit();
        }
        
        ?>