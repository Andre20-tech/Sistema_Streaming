<?php
require '../db.php';

$stmt = $pdo->query("SELECT a.*, u.nome, f.titulo FROM avaliacao a 
    JOIN usuario u ON a.id_usuario = u.id_usuario 
    JOIN filme f ON a.id_filme = f.id_filme 
    ORDER BY data_avaliacao DESC");
$avaliacoes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Avaliações</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
<div class="container mt-5">
    <h2>Avaliações</h2>
    <a href="cadastro_avaliacao.php" class="btn btn-success mb-3">Nova Avaliação</a>
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Usuário</th>
                <th>Filme</th>
                <th>Nota</th>
                <th>Comentário</th>
                <th>Data</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($avaliacoes as $av): ?>
            <tr>
                <td><?= htmlspecialchars($av['nome']) ?></td>
                <td><?= htmlspecialchars($av['titulo']) ?></td>
                <td><?= $av['nota'] ?></td>
                <td><?= htmlspecialchars($av['comentario']) ?></td>
                <td><?= $av['data_avaliacao'] ?></td>
                <td>
                    <a href="editar_avaliacao.php?id=<?= $av['id_avaliacao'] ?>" class="btn btn-warning btn-sm">Editar</a>
                    <a href="excluir_avaliacao.php?id=<?= $av['id_avaliacao'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza?')">Excluir</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="../painel.php" class="btn btn-secondary mt-3">Voltar</a>
</div>
</body>
</html>
