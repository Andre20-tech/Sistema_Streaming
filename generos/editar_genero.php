<?php
require '../db.php';
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../index.php");
    exit;
}

$id = $_GET['id'] ?? null;

if (!$id) {
    header("Location: genero.php");
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM genero WHERE id_genero = ?");
$stmt->execute([$id]);
$genero = $stmt->fetch();

if (!$genero) {
    echo "Gênero não encontrado.";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = $_POST['nome_genero'] ?? '';
    if ($nome) {
        $stmt = $pdo->prepare("UPDATE genero SET nome_genero = ? WHERE id_genero = ?");
        $stmt->execute([$nome, $id]);
        header("Location: genero.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Gênero</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Editar Gênero</h2>
    <form method="post">
        <div class="mb-3">
            <label for="nome_genero" class="form-label">Nome do Gênero</label>
            <input type="text" name="nome_genero" id="nome_genero" class="form-control" value="<?= htmlspecialchars($genero['nome_genero']) ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Atualizar</button>
        <a href="genero.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
</body>
</html>
