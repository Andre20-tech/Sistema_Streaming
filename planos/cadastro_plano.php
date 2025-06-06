<?php
require '../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome_plano = $_POST['nome_plano'];
    $preco_mensal = $_POST['preco_mensal'];
    $resolucao_maxima = $_POST['resolucao_maxima'];
    $qtd_telas = $_POST['qtd_telas'];

    $stmt = $pdo->prepare("INSERT INTO plano (nome_plano, preco_mensal, resolucao_maxima, qtd_telas) VALUES (?, ?, ?, ?)");
    $stmt->execute([$nome_plano, $preco_mensal, $resolucao_maxima, $qtd_telas]);

    header("Location: planos.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Plano</title>
</head>
<body>
    <h1>Cadastrar Novo Plano</h1>
    <form method="post">
        <label>Nome do Plano:</label>
        <input type="text" name="nome_plano" required><br><br>

        <label>Preço Mensal:</label>
        <input type="number" step="0.01" name="preco_mensal" required><br><br>

        <label>Resolução Máxima:</label>
        <input type="text" name="resolucao_maxima" required><br><br>

        <label>Quantidade de Telas:</label>
        <input type="number" name="qtd_telas" required><br><br>

        <button type="submit">Cadastrar</button>
    </form>
    <br>
    <a href="planos.php">Voltar</a>
</body>
</html>
