<?php
require '../db.php';

$id = $_GET['id'] ?? null;
if (!$id) { header("Location: avaliacoes.php"); exit; }

$avaliacao = $pdo->prepare("SELECT * FROM avaliacao WHERE id_avaliacao = ?");
$avaliacao->execute([$id]);
$av = $avaliacao->fetch();

if (!$av) { echo "Avaliação não encontrada."; exit; }

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nota = $_POST['nota'];
    $comentario = $_POST['comentario'];

    $stmt = $pdo->prepare("UPDATE avaliacao SET nota = ?, comentario = ? WHERE id_avaliacao = ?");
    $stmt->execute([$nota, $comentario, $id]);

    header("Location: avaliacoes.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Avaliação</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
<div class="container mt-5">
    <h2>Editar Avaliação</h2>
    <form method="post">
        <div class="mb-3">
            <label>Nota:</label>
            <input type="number" step="0.1" min="0" max="10" name="nota" value="<?= $av['nota'] ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Comentário:</label>
            <textarea name="comentario" class="form-control" rows="4"><?= htmlspecialchars($av['comentario']) ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Atualizar</button>
        <a href="avaliacoes.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
</body>
</html>
