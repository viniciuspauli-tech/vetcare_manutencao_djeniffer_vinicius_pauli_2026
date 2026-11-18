
<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function exigirLogin()
{
    if (!isset($_SESSION['usuario_id'])) {

        $nomeProjeto = basename(dirname(__DIR__));

        header(
            'Location: /' . $nomeProjeto . '/login.php'
        );

        exit;
    }
}
