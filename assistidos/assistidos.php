<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../index.php");
    exit;
}

require '../db.php';

try {
    $stmt = $pdo->query("
        SELECT a.id_usuario, u.nome, u.sobrenome, a.id_filme, f.titulo, a.data_assistido
        FROM assistido a
        JOIN usuario u ON a.id_usuario = u.id_usuario
        JOIN filme f ON a.id_filme = f.id_filme
        ORDER BY a.data_assistido DESC
    ");
    $assistidos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erro ao consultar assistidos: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <title>Histórico de Filmes Assistidos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
<div class="container mt-5">
    <h2>Histórico de Filmes Assistidos</h2>
    <a href="cadastro_assistido.php" class="btn btn-success mb-3">Registrar Filme Assistido</a>

    <?php if (count($assistidos) > 0): ?>
        <table class="table table-striped table-bordered">
            <thead class="table-primary">
                <tr>
                    <th>Usuário</th>
                    <th>Filme</th>
                    <th>Data e Hora Assistido</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($assistidos as $a): ?>
                    <tr>
                        <td><?= htmlspecialchars($a['nome'] . ' ' . $a['sobrenome']) ?></td>
                        <td><?= htmlspecialchars($a['titulo']) ?></td>
                        <td><?= htmlspecialchars($a['data_assistido']) ?></td>
                        <td>
                            <a href="excluir_assistido.php?id_usuario=<?= urlencode($a['id_usuario']) ?>&id_filme=<?= urlencode($a['id_filme']) ?>&data_assistido=<?= urlencode($a['data_assistido']) ?>" 
                               class="btn btn-danger btn-sm"
                               onclick="return confirm('Tem certeza que deseja excluir este registro?');">
                               Excluir
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Nenhum registro de filme assistido encontrado.</p>
    <?php endif; ?>

    <a href="../painel.php" class="btn btn-secondary mt-3">Voltar ao Painel</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
