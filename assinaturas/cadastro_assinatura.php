<?php
require '../db.php';

$usuarios = $pdo->query("SELECT id_usuario, nome FROM usuario")->fetchAll(PDO::FETCH_ASSOC);
$planos = $pdo->query("SELECT id_plano, nome_plano FROM plano")->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id_usuario = $_POST['id_usuario'];
    $id_plano = $_POST['id_plano'];
    $data_inicio = $_POST['data_inicio'];
    $data_fim = $_POST['data_fim'] ?? null;
    $status = $_POST['status'];

    $stmt = $pdo->prepare("INSERT INTO assinatura (id_usuario, id_plano, data_inicio, data_fim, status) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$id_usuario, $id_plano, $data_inicio, $data_fim, $status]);

    header("Location: assinaturas.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Nova Assinatura</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
<div class="container mt-5">
    <h2>Cadastrar Nova Assinatura</h2>
    <form method="post">
        <div class="mb-3">
            <label>Usuário</label>
            <select name="id_usuario" class="form-select" required>
                <option value="">Selecione um usuário</option>
                <?php foreach ($usuarios as $usuario): ?>
                    <option value="<?= $usuario['id_usuario'] ?>"><?= htmlspecialchars($usuario['nome']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label>Plano</label>
            <select name="id_plano" class="form-select" required>
                <option value="">Selecione um plano</option>
                <?php foreach ($planos as $plano): ?>
                    <option value="<?= $plano['id_plano'] ?>"><?= htmlspecialchars($plano['nome_plano']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label>Data de Início</label>
            <input type="date" name="data_inicio" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Data de Fim (opcional)</label>
            <input type="date" name="data_fim" class="form-control">
        </div>

        <div class="mb-3">
            <label>Status</label>
            <input type="text" name="status" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Cadastrar Assinatura</button>
        <a href="assinaturas.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
</body>
</html>
