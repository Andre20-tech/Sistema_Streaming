<?php
require 'db.php';
session_start();

$erro = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $stmt = $pdo->prepare("SELECT * FROM usuario WHERE email = ?");
    $stmt->execute([$email]);
    $usuario = $stmt->fetch();

    if ($usuario && password_verify($senha, $usuario['senha'])) {
        $_SESSION['usuario_id'] = $usuario['id_usuario'];
        $_SESSION['nome'] = $usuario['nome'];
        header("Location: painel.php");
        exit();
    } else {
        $erro = "Email ou senha inválidos.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Login</h1>
    <?php if ($erro): ?>
        <p style="color: red;"><?= $erro ?></p>
    <?php endif; ?>
    <form method="post">
        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>

        <label>Senha:</label><br>
        <input type="password" name="senha" required><br><br>

        <button type="submit">Entrar</button>
    </form>
</body>
</html>
