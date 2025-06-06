<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../index.php");
    exit;
}

require '../db.php'; // Seu arquivo que cria $pdo (PDO)

try {
    $stmt = $pdo->prepare("SELECT id_usuario, nome, sobrenome, email, data_nascimento FROM usuario ORDER BY nome");
    $stmt->execute();
    $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erro ao consultar usuários: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <title>Usuários Cadastrados</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
<div class="container mt-5">
    <h2>Usuários Cadastrados</h2>
    <a href="cadastro.php" class="btn btn-success mb-3">Novo Usuário</a>

    <?php if (count($usuarios) > 0): ?>
        <table class="table table-striped table-bordered">
            <thead class="table-primary">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Sobrenome</th>
                    <th>Email</th>
                    <th>Data de Nascimento</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usuarios as $usuario): ?>
                    <tr>
                        <td><?= htmlspecialchars($usuario['id_usuario']) ?></td>
                        <td><?= htmlspecialchars($usuario['nome']) ?></td>
                        <td><?= htmlspecialchars($usuario['sobrenome']) ?></td>
                        <td><?= htmlspecialchars($usuario['email']) ?></td>
                        <td><?= htmlspecialchars($usuario['data_nascimento']) ?></td>
                        <td>
                            <a href="editar_usuario.php?id=<?= urlencode($usuario['id_usuario']) ?>" class="btn btn-warning btn-sm">Editar</a>
                            <a href="excluir_usuario.php?id=<?= urlencode($usuario['id_usuario']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir este usuário?');">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Nenhum usuário cadastrado.</p>
    <?php endif; ?>

    <a href="../painel.php" class="btn btn-secondary mt-3">Voltar ao Painel</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
