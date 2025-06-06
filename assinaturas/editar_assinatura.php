<?php
require '../db.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: assinaturas.php");
    exit;
}

// Buscar dados atuais da assinatura
$stmt = $pdo->prepare("SELECT * FROM assinatura WHERE id_assinatura = ?");
$stmt->execute([$id]);
$assinatura = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$assinatura) {
    echo "Assinatura não encontrada.";
    exit;
}

// Buscar usuários e planos para popular os selects
$usuarios = $pdo->query("SELECT id_usuario, nome FROM usuario")->fetchAll(PDO::FETCH_ASSOC);
$planos = $pdo->query("SELECT id_plano, nome_plano FROM plano")->fetchAll(PDO::FETCH_ASSOC);

// Atualizar se enviado por POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $usuario_id = $_POST['id_usuario'];
    $plano_id = $_POST['id_plano'];
    $data_inicio = $_POST['data_inicio'];
    $data_fim = $_POST['data_fim'];
    $status = $_POST['status'];

    $sql = "UPDATE assinatura SET id_usuario = ?, id_plano = ?, data_inicio = ?, data_fim = ?, status = ? WHERE id_assinatura = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$usuario_id, $plano_id, $data_inicio, $data_fim, $status, $id]);

    header("Location: assinaturas.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Assinatura</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
<div class="container mt-5">
    <h2>Editar Assinatura</h2>
    <form method="post">
        <div class="mb-3">
            <label>Usuário</label>
            <select name="id_usuario" class="form-select" required>
                <?php foreach ($usuarios as $usuario): ?>
                    <option value="<?= $usuario['id_usuario'] ?>" <?= $usuario['id_usuario'] == $assinatura['id_usuario'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($usuario['nome']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label>Plano</label>
            <select name="id_plano" class="form-select" required>
                <?php foreach ($planos as $plano): ?>
                    <option value="<?= $plano['id_plano'] ?>" <?= $plano['id_plano'] == $assinatura['id_plano'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($plano['nome_plano']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label>Data de Início</label>
            <input type="date" name="data_inicio" value="<?= $assinatura['data_inicio'] ?>" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Data de Fim</label>
            <input type="date" name="data_fim" value="<?= $assinatura['data_fim'] ?>" class="form-control">
        </div>

        <div class="mb-3">
            <label>Status</label>
            <input type="text" name="status" value="<?= htmlspecialchars($assinatura['status']) ?>" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
        <a href="assinaturas.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
</body>
</html>
