<?php
require '../db.php';

$id_plano = $_GET['id'] ?? null;
if (!$id_plano) {
    header("Location: planos.php");
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM plano WHERE id_plano = ?");
$stmt->execute([$id_plano]);
$plano = $stmt->fetch();

if (!$plano) {
    echo "Plano não encontrado.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome_plano = $_POST['nome_plano'];
    $preco_mensal = $_POST['preco_mensal'];
    $resolucao_maxima = $_POST['resolucao_maxima'];
    $qtd_telas = $_POST['qtd_telas'];

    $stmt = $pdo->prepare("UPDATE plano SET nome_plano = ?, preco_mensal = ?, resolucao_maxima = ?, qtd_telas = ? WHERE id_plano = ?");
    $stmt->execute([$nome_plano, $preco_mensal, $resolucao_maxima, $qtd_telas, $id_plano]);

    header("Location: planos.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Plano</title>
</head>
<body>
    <h1>Editar Plano</h1>
    <form method="post">
        <label>Nome do Plano:</label>
        <input type="text" name="nome_plano" value="<?= htmlspecialchars($plano['nome_plano']) ?>" required><br><br>

        <label>Preço Mensal:</label>
        <input type="number" step="0.01" name="preco_mensal" value="<?= htmlspecialchars($plano['preco_mensal']) ?>" required><br><br>

        <label>Resolução Máxima:</label>
        <input type="text" name="resolucao_maxima" value="<?= htmlspecialchars($plano['resolucao_maxima']) ?>" required><br><br>

        <label>Quantidade de Telas:</label>
        <input type="number" name="qtd_telas" value="<?= htmlspecialchars($plano['qtd_telas']) ?>" required
::contentReference[oaicite:0]{index=0}
 
