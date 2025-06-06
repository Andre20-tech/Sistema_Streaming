<?php
require '../db.php';

$stmt = $pdo->query("
    SELECT a.id_assinatura, u.nome, p.nome_plano, a.data_inicio, a.data_fim, a.status
    FROM assinatura a
    JOIN usuario u ON a.id_usuario = u.id_usuario
    JOIN plano p ON a.id_plano = p.id_plano
");
$assinaturas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Assinaturas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1>Lista de Assinaturas</h1>
        <a href="cadastro_assinatura.php" class="btn btn-primary mb-3">Nova Assinatura</a>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Usuário</th>
                    <th>Plano</th>
                    <th>Data Início</th>
                    <th>Data Fim</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($assinaturas as $assinatura): ?>
                    <tr>
                        <td><?= htmlspecialchars($assinatura['id_assinatura']) ?></td>
                        <td><?= htmlspecialchars($assinatura['nome']) ?></td>
                        <td><?= htmlspecialchars($assinatura['nome_plano']) ?></td>
                        <td><?= htmlspecialchars($assinatura['data_inicio']) ?></td>
                        <td><?= htmlspecialchars($assinatura['data_fim']) ?></td>
                        <td><?= htmlspecialchars($assinatura['status']) ?></td>
                        <td>
                            <a href="editar_assinatura.php?id=<?= $assinatura['id_assinatura'] ?>" class="btn btn-warning btn-sm">Editar</a>
                            <a href="excluir_assinatura.php?id=<?= $assinatura['id_assinatura'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir esta assinatura?');">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
