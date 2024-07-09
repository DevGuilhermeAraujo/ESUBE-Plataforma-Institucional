<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../Login/pagLogin.css">
</head>

<body>
    <div class="background-image">
        <div class="container">
            <div class="row justify-content-center align-items-center vh-100">
                <div class="col-md-6">
                    <div class="card mt-5">
                        <div class="card-body">
                            <!-- Logo da Instituição -->
                            <div class="text-center mb-3">
                                <img src="../Imgs/eva.jpg" alt="Logo da Instituição" class="img-fluid logo">
                            </div>
                            <form action="../BackEnd/processLogin.php" method="POST">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="usuario" id="ra" placeholder="RA" required>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" name="password" id="password" placeholder="Senha" required>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block">Login</button>
                                <a href="#" class="d-block text-center mt-3 text-secondary">Esqueceu sua senha?</a>
                            </form>
                            <!--Mensagens de erro aqui (preferência: 1 por vez)-->
                            <?php
                            // if (isset($_GET["sucess"])) {
                            //     //Menssagem de senha recuperada
                            //     msg(MSG_POSITIVE_BG, "Usa senha foi recuperada com sucesso!", null, "width: 40%; margin-top: 2%; margin-left: 0;", "msg1", 10000);
                            // }

                            // if (isset($_GET["invalidLogin"])) {
                            //     //Menssagem de login inválido
                            //     msg(MSG_NEGATIVE_BG, "Usuário e/ou senha incorretos.<br>Certifique-se de que a função Caps Lock está desligada e tente novamente.", null, "width: 40%; margin-top: 2%; margin-left: 0;", "msg1", 10000);
                            // }

                            // if (isset($_GET["ERROR"])) {
                            //     switch ($_GET["ERROR"]) {
                            //         case 1:
                            //             //Menssagem de falha no Banco
                            //             msg(MSG_NEGATIVE_BG, "Falha ao conectar com a base de dados, Tente novamente mais tarde.<br>Se o problema persistir, por favor entre em contato com o adminstrador do sistema.", null, "width: 40%; margin-top: 2%; margin-left: 0;", "msg2", 7000);
                            //             break;
                            //         default:
                            //             //Menssagem de erro geral
                            //             msg(MSG_NEGATIVE_BG, "Erro desconhecido, por favor entre em contato com o adminstrador do sistema.", null, "width: 40%; margin-top: 2%; margin-left: 0;", "msg2", 5000);
                            //     }
                            // }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>