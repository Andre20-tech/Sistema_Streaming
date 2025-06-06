<?php
require '../db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $titulo = $_POST['titulo'];
    $ano = $_POST['ano_lancamento'];
    $duracao = $_POST['duracao'];
    $classificacao = $_POST['classificacao_etaria'];
    $sinopse = $_POST['sinopse'];

    $stmt = $pdo->prepare("INSERT INTO filme (titulo, ano_lancamento, duracao, classificacao_etaria, sinopse) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$titulo, $ano, $duracao, $classificacao, $sinopse]);

    header("Location: filmes.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <title>Novo Filme</title>
</head>
<body>
    <h1>Cadastrar Novo Filme</h1>
    <form method="post">
        <label>Título:</label><br>
        <input type="text" name="titulo" required><br><br>

        <label>Ano de Lançamento:</label><br>
        <input type="number" name="ano_lancamento" required><br><br>

        <label>Duração (em minutos):</label><br>
        <input type="number" name="duracao" required><br><br>

        <label>Classificação Etária:</label><br>
        <input type="text" name="classificacao_etaria" required><br><br>

        <label>Sinopse:</label><br>
        <textarea name="sinopse" rows="4" cols="50" required></textarea><br><br>

        <button type="submit">Salvar</button>
    </form>
    <br>
    <a href="filmes.php">Voltar</a>
</body>
</html>
