
<?php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/auth.php';

exigirLogin();

$id = (int) ($_GET['id'] ?? 0);

if ($id > 0) {
    try {
        $stmt = $pdo->prepare("DELETE FROM tutores WHERE id = ?");
        $stmt->execute([$id]);

        header('Location: index.php?excluido=1');
        exit;

    } catch (PDOException $e) {
        header('Location: index.php?erro=1');
        exit;
    }
}

header('Location: index.php');
exit;
