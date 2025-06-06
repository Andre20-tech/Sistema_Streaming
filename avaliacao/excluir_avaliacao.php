<?php
require '../db.php';

$id = $_GET['id'] ?? null;

if ($id) {
    $stmt = $pdo->prepare("DELETE FROM avaliacao WHERE id_avaliacao = ?");
    $stmt->execute([$id]);
}

header("Location: avaliacoes.php");
exit;
