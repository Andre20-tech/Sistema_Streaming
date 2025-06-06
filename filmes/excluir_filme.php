<?php
require '../db.php';

$id = $_GET['id'] ?? null;

if ($id) {
    $stmt = $pdo->prepare("DELETE FROM filme WHERE id_filme = ?");
    $stmt->execute([$id]);
}

header("Location: filmes.php");
exit;
?>
