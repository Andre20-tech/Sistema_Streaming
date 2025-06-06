<?php
require '../db.php';

$usuarios = $pdo->query("SELECT id_usuario, nome FROM usuario")->fetchAll();
$filmes = $pdo->query("SELECT id_filme, titulo FROM filme")->fetchAll();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id_usuario = $_POST['id_usuario'];
    $id_filme = $_POST['id_filme'];
    $nota = $_POST['nota'];
    $comentario = $_POST['comentario'];
    $data = date('Y-m-d');

    $stmt = $pdo->prepare("INSERT INTO avaliacao (id_usuario, id_filme, nota, comentario, data_avaliacao) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$id_usuario, $id_filme, $nota, $comentario, $data]);

    header("Location: avaliacoes.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Nova Avaliação</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
<div class="container mt-5">
    <h2>Nova Avaliação</h2>
    <form method="post">
        <div class="mb-3">
            <label>Usuário:</label>
            <select name="id_usuario" class="form-select" required>
                <?php foreach ($usuarios as $u): ?>
                    <option value="<?= $u['id_usuario'] ?>"><?= htmlspecialchars($u['nome']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label>Filme:</label>
            <select name="id_filme" class="form-select" required>
                <?php foreach ($filmes as $f): ?>
                    <option value="<?= $f['id_filme'] ?>"><?= htmlspecialchars($f['titulo']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label>Nota:</label>
            <input type="number" step="0.1" min="0" max="10" name="nota" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Comentário:</label>
            <textarea name="comentario" class="form-control" rows="4"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Salvar</button>
        <a href="avaliacoes.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
</body>
</html>
