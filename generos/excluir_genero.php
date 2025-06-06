<?php
require '../db.php';
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../index.php");
    exit;
}

$id = $_GET['id'] ?? null;

if ($id) {
    $stmt = $pdo->prepare("DELETE FROM genero WHERE id_genero = ?");
    $stmt->execute([$id]);
}

header("Location: genero.php");
exit;
