<?php
require '../db.php';
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../index.php");
    exit;
}

$stmt = $pdo->query("SELECT * FROM genero");
$generos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Gêneros</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Gêneros</h2>
    <a href="cadastro_genero.php" class="btn btn-success mb-3">Novo Gênero</a>

    <?php if (count($generos) > 0): ?>
        <table class="table table-bordered">
            <thead class="table-primary">
                <tr>
                    <th>ID</th>
                    <th>Nome do Gênero</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($generos as $genero): ?>
                    <tr>
                        <td><?= $genero['id_genero'] ?></td>
                        <td><?= htmlspecialchars($genero['nome_genero']) ?></td>
                        <td>
                            <a href="editar_genero.php?id=<?= $genero['id_genero'] ?>" class="btn btn-warning btn-sm">Editar</a>
                            <a href="excluir_genero.php?id=<?= $genero['id_genero'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Deseja excluir este gênero?')">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="alert alert-info">Nenhum gênero cadastrado.</p>
    <?php endif; ?>

    <a href="../painel.php" class="btn btn-secondary mt-3">Voltar ao Painel</a>
</div>
</body>
</html>
