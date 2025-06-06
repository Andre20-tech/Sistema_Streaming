<?php
require 'db.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    header("Location: index.php");
    exit();
}

// Buscar dados do usuário atual
$stmt = $pdo->prepare("SELECT * FROM usuario WHERE id_usuario = ?");
$stmt->execute([$id]);
$usuario = $stmt->fetch();

if (!$usuario) {
    echo "Usuário não encontrado.";
    exit();
}

// Atualizar se o formulário for enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    $email = $_POST['email'];
    $data_nascimento = $_POST['data_nascimento'];

    $sql = "UPDATE usuario SET nome = ?, sobrenome = ?, email = ?, data_nascimento = ? WHERE id_usuario = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nome, $sobrenome, $email, $data_nascimento, $id]);

    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuário</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Editar Usuário</h1>
    <form method="post">
        <label>Nome:</label><br>
        <input type="text" name="nome" value="<?= htmlspecialchars($usuario['nome']) ?>" required><br><br>

        <label>Sobrenome:</label><br>
        <input type="text" name="sobrenome" value="<?= htmlspecialchars($usuario['sobrenome']) ?>" required><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" value="<?= htmlspecialchars($usuario['email']) ?>" required><br><br>

        <label>Data de Nascimento:</label><br>
        <input type="date" name="data_nascimento" value="<?= $usuario['data_nascimento'] ?>" required><br><br>

        <button type="submit">Salvar Alterações</button>
    </form>
    <br>
    <a href="index.php">Voltar</a>
</body>
</html>
