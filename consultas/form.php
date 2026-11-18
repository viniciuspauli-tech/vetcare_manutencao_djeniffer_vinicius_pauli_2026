
<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $animalId = (int) ($_POST['animal_id'] ?? 0);
    $data = $_POST['data_consulta'] ?? '';
    $veterinario = trim($_POST['veterinario'] ?? '');
    $motivo = trim($_POST['motivo'] ?? '');
    $status = $_POST['status'] ?? 'Agendada';
    $observacoes = trim($_POST['observacoes'] ?? '');

    $statusPermitidos = [
        'Agendada',
        'Realizada',
        'Cancelada'
    ];

    if ($animalId <= 0) {
        $erro = 'Selecione um animal válido.';

    } elseif ($veterinario === '') {
        $erro = 'Informe o veterinário.';

    } elseif (!in_array($status, $statusPermitidos, true)) {
        $erro = 'Status inválido.';

    } elseif ($data === '') {
        $erro = 'Informe a data da consulta.';

    } else {

        $verificar = $pdo->prepare(
            "SELECT id FROM animais WHERE id = ?"
        );

        $verificar->execute([$animalId]);

        if (!$verificar->fetch()) {
            $erro = 'O animal selecionado não existe.';

        } else {

            $dt = str_replace('T', ' ', $data);

            if (strlen($dt) === 16) {
                $dt .= ':00';
            }

            $dados = [
                $animalId,
                $dt,
                $veterinario,
                $motivo,
                $status,
                $observacoes
            ];

            if ($id) {
                $stmt = $pdo->prepare("
                    UPDATE consultas
                    SET animal_id = ?,
                        data_consulta = ?,
                        veterinario = ?,
                        motivo = ?,
                        status = ?,
                        observacoes = ?
                    WHERE id = ?
                ");

                $stmt->execute([...$dados, $id]);

            } else {

                $stmt = $pdo->prepare("
                    INSERT INTO consultas
                    (animal_id, data_consulta, veterinario,
                     motivo, status, observacoes)
                    VALUES (?, ?, ?, ?, ?, ?)
                ");

                $stmt->execute($dados);
            }

            header('Location: index.php');
            exit;
        }
    }
}
?>
