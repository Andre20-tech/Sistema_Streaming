<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../index.php");
    exit;
}

require '../db.php';

// Buscar usuários para select
$usuarios = $pdo->query("SELECT id_usuario, nome, sobrenome FROM usuario ORDER BY nome")->fetchAll(PDO::FETCH_ASSOC);

// Buscar filmes para select
$filmes = $pdo->query("SELECT id_filme, titulo FROM filme ORDER BY titulo")->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_usuario = $_POST['id_usuario'];
    $id_filme = $_POST['id_filme'];
    $data_assistido = $_POST['data_assistido'];

    // Inserir no banco
    $stmt = $pdo->prepare("INSERT INTO assistido (id_usuario, id_filme, data_assistido) VALUES (?, ?, ?)");
    $stmt->execute([$id_usuario, $id_filme, $data_assistido]);

    header("Location: assistidos.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <title>Registrar Filme Assistido</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
<div class="container mt-5">
    <h2>Registrar Filme Assistido</h2>
    <form method="post">
        <div class="mb-3">
            <label for="id_usuario" class="form-label">Usuário</label>
            <select id="id_usuario" name="id_usuario" class="form-select" required>
                <option value="" disabled selected>Selecione um usuário</option>
                <?php foreach ($usuarios as $usuario): ?>
                    <option value="<?= $usuario['id_usuario'] ?>">
                        <?= htmlspecialchars($usuario['nome'] . ' ' . $usuario['sobrenome']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="id_filme" class="form-label">Filme</label>
            <select id="id_filme" name="id_filme" class="form-select" required>
                <option value="" disabled selected>Selecione um filme</option>
                <?php foreach ($filmes as $filme): ?>
                    <option value="<?= $filme['id_filme'] ?>">
                        <?= htmlspecialchars($filme['titulo']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="data_assistido" class="form-label">Data e Hora Assistido</label>
            <input type="datetime-local" id="data_assistido" name="data_assistido" class="form-control" required value="<?= date('Y-m-d\TH:i') ?>">
        </div>

        <button type="submit" class="btn btn-primary">Registrar</button>
        <a href="assistidos.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
