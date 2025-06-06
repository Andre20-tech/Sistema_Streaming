<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../index.php");
    exit;
}

require '../db.php';

try {
    $stmt = $pdo->query("SELECT * FROM filme ORDER BY titulo");
    $filmes = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erro ao buscar filmes: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <title>Filmes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
<div class="container mt-5">
    <h2>Filmes</h2>
    <a href="cadastro_filme.php" class="btn btn-success mb-3">Novo Filme</a>

    <?php if (count($filmes) > 0): ?>
        <table class="table table-bordered">
            <thead class="table-primary">
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Ano</th>
                    <th>Duração (min)</th>
                    <th>Classificação</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($filmes as $filme): ?>
                    <tr>
                        <td><?= $filme['id_filme'] ?></td>
                        <td><?= htmlspecialchars($filme['titulo']) ?></td>
                        <td><?= $filme['ano_lancamento'] ?></td>
                        <td><?= $filme['duracao'] ?></td>
                        <td><?= $filme['classificacao_etaria'] ?></td>
                        <td>
                            <a href="editar_filme.php?id=<?= $filme['id_filme'] ?>" class="btn btn-warning btn-sm">Editar</a>
                            <a href="excluir_filme.php?id=<?= $filme['id_filme'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Deseja excluir este filme?')">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="alert alert-info">Nenhum filme cadastrado.</p>
    <?php endif; ?>

    <a href="../painel.php" class="btn btn-secondary mt-3">Voltar ao Painel</a>
</div>
</body>
</html>
