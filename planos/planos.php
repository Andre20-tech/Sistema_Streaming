<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../index.php");
    exit;
}

require '../db.php';

$stmt = $pdo->query("SELECT * FROM plano");
$planos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Planos de Assinatura</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Planos de Assinatura</h2>

    <a href="cadastro_plano.php" class="btn btn-success mb-3">Novo Plano</a>

    <?php if (count($planos) > 0): ?>
        <table class="table table-bordered table-striped">
            <thead class="table-primary">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Preço</th>
                    <th>Resolução Máxima</th>
                    <th>Qtd. Telas</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($planos as $plano): ?>
                    <tr>
                        <td><?= htmlspecialchars($plano['id_plano']) ?></td>
                        <td><?= htmlspecialchars($plano['nome_plano']) ?></td>
                        <td>R$ <?= number_format($plano['preco_mensal'], 2, ',', '.') ?></td>
                        <td><?= htmlspecialchars($plano['resolucao_maxima']) ?></td>
                        <td><?= htmlspecialchars($plano['qtd_telas']) ?></td>
                        <td>
                            <a href="editar_plano.php?id=<?= $plano['id_plano'] ?>" class="btn btn-warning btn-sm">Editar</a>
                            <a href="excluir_plano.php?id=<?= $plano['id_plano'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir este plano?');">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="alert alert-info">Nenhum plano cadastrado.</p>
    <?php endif; ?>

    <a href="../painel.php" class="btn btn-secondary mt-3">Voltar ao Painel</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
