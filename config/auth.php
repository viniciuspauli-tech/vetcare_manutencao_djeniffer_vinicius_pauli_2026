
<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function exigirLogin()
{
    if (!isset($_SESSION['usuario_id'])) {

        $pastaProjeto = dirname(
            dirname($_SERVER['SCRIPT_NAME'])
        );

        header(
            'Location: ' . $pastaProjeto . '/login.php'
        );

        exit;
    }
}
