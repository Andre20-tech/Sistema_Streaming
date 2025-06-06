<?php
require '../db.php';

$id = $_GET['id'] ?? null;

if ($id) {
    $stmt = $pdo->prepare("DELETE FROM assinatura WHERE id_assinatura = ?");
    $stmt->execute([$id]);
}

header("Location: assinaturas.php");
exit;
