<?php
        // Coleta os dados do formulário
        $nome = $_POST['nome'];
        $cpf = $_POST['cpf'];
        $genero = $_POST['genero'];
        $dataNasc = $_POST['dtNasc'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $tipo = $_POST['tipo'];

        //Se tipo for ""
        if($tipo == ""){
            header("Location: ../Gerente/CadProfessor.php?ERROR=7&nome=$nome&cpf=$cpf&genero=$genero&dtNasc=$dataNasc&email=$email");
        }

        // Inclua o arquivo de conexão com o banco de dados
        require_once('../BackEnd/conexao.php');
        $db = new Conexao();

        // Verificar se a conexão foi estabelecida com sucesso
        if ($db->errorCode === 0) {
            //Preparar Senha
            $senha = password_hash($senha,PASSWORD_DEFAULT);
            // Preparar a consulta SQL para inserção de dados na tabela de professores com espaços reservados
            $result = $db->executar("INSERT INTO usuarios(nome, cpf, genero, dt_NASC, email, senha, tipo) VALUES ('$nome', '$cpf', $genero, '$dataNasc', '$email', '$senha', $tipo)", true);

            if ($result) {
                echo "<script> alert('Usuário cadastrado com sucesso'); </script>";
                //header("Location: ../Gerente/inicioGerente.php");
            } else {
                
            }
            
        } else {
            // Lidar com erros de conexão, se houver
            header("Location: ../Gerente/CadProfessor.php?ERROR=1");
            exit();
        }
        
        ?>