<?php
require_once '../BackEnd/Classes/App.php';
function logued(?int $permission = null): bool {
    return App::$permissao::verificarPermissao($permission);
}


function redirectByPermission(int $permission) {
    Permissao::redirecionarPorPermissao($permission);
}

function getIdRa(): ?string {
    return $_SESSION[Permissao::SESSION_USER_RA_ID] ?? null;
}

function getNome(): ?string {
    return $_SESSION[Permissao::SESSION_USERNAME] ?? null;
}

function getPermission(): ?int {
    return $_SESSION[Permissao::SESSION_USER_IDPERMISSION] ?? null;
}

// Mensagem Pop-up com/sem background
const MSG_POSITIVE = 1;
const MSG_NEGATIVE = 2;
const MSG_POSITIVE_BG = 3;
const MSG_NEGATIVE_BG = 4;

function msg(int $type, string $message, ?string $class = "", ?string $style = "", ?string $id = "", ?int $hideTimer = 0, ?string $importJsUri = null)
{
    switch ($type) {
        case 1:
            // Mensagem positiva
            echo '<span id="' . $id . '" class="msgV ' . $class . '" style="' . $style . '">' . $message . '</span>';
            break;
        case 2:
            // Mensagem negativa
            echo '<span id="' . $id . '" class="msgN ' . $class . '" style="' . $style . '">' . $message . '</span>';
            break;
        case 3:
            // Mensagem positiva com background
            echo '<span id="' . $id . '" class="msgV-bg ' . $class . '" style="' . $style . '">' . $message . '</span>';
            break;
        case 4:
            // Mensagem negativa com background
            echo '<span id="' . $id . '" class="msgN-bg ' . $class . '" style="' . $style . '">' . $message . '</span>';
            break;
        default:
            throw new Exception('Entrada inválida na função msg().');
    }

    if ($hideTimer !== 0) {
        // Se a mensagem vai desaparecer
        // Tenta inserir o JavaScript caso não esteja na página (melhorar depois)
        if ($importJsUri === null) {
            // Tenta importar de um caminho padrão
            echo '<script src="../BackEnd/script.js"></script>';
        } else {
            // Importa de um caminho determinado
            echo '<script src="'.$importJsUri.'"></script>';
        }
        // Chamar o método JavaScript para interação no lado cliente
        echo "<script>deleteMsg($hideTimer,$id);</script>";
    }
}

function redirectPOST(string $url, string $values, ?string $importJsUri = "../BackEnd/script.js")
{
    echo "<script src='$importJsUri'></script>";
    // Chamar o método JavaScript para interação no lado cliente
    echo "<script>redirectPOSTAjax('$url', '$values');</script>";
}
