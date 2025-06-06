<?php
require '../db.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    header("Location: filmes.php");
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM filme WHERE id_filme = ?");
$stmt->execute([$id]);
$filme = $stmt->fetch();

if (!$filme) {
    echo "Filme não encontrado.";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $titulo = $_POST['titulo'];
    $ano = $_POST['ano_lancamento'];
    $duracao = $_POST['duracao'];
    $classificacao = $_POST['classificacao_etaria'];
    $sinopse = $_POST['sinopse'];

    $stmt = $pdo->prepare("UPDATE filme SET titulo = ?, ano_lancamento = ?, duracao = ?, classificacao_etaria = ?, sinopse = ? WHERE id_filme = ?");
    $stmt->execute([$titulo, $ano, $duracao, $classificacao, $sinopse, $id]);

    header("Location: filmes.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Filme</title>
</head>
<body>
    <h1>Editar Filme</h1>
    <form method="post">
        <label>Título:</label><br>
        <input type="text" name="titulo" value="<?= htmlspecialchars($filme['titulo']) ?>" required><br><br>

        <label>Ano de Lançamento:</label><br>
        <input type="number" name="ano_lancamento" value="<?= $filme['ano_lancamento'] ?>" required><br><br>

        <label>Duração:</label><br>
        <input type="number" name="duracao" value="<?= $filme['duracao'] ?>" required><br><br>

        <label>Classificação Etária:</label><br>
        <input type="text" name="classificacao_etaria" value="<?= htmlspecialchars($filme['classificacao_etaria']) ?>" required><br><br>

        <label>Sinopse:</label><br>
        <textarea name="sinopse" rows="4" cols="50" required><?= htmlspecialchars($filme['sinopse']) ?></textarea><br><br>

        <button type="submit">Salvar Alterações</button>
    </form>
    <br>
    <a href="filmes.php">Voltar</a>
</body>
</html>
