<?php
require '../db.php';

$id_usuario = $_GET['id_usuario'] ?? null;
$id_filme = $_GET['id_filme'] ?? null;
$data_assistido = $_GET['data_assistido'] ?? null;

if ($id_usuario && $id_filme && $data_assistido) {
    $stmt = $pdo->prepare("DELETE FROM assistido WHERE id_usuario = ? AND id_filme = ? AND data_assistido = ?");
    $stmt->execute([$id_usuario, $id_filme, $data_assistido]);
}

header("Location: assistidos.php");
exit();
?>
