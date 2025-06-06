<?php
require '../db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
    $data_nascimento = $_POST['data_nascimento'];

    $sql = "INSERT INTO usuario (nome, sobrenome, email, senha, data_nascimento)
            VALUES (?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nome, $sobrenome, $email, $senha, $data_nascimento]);

    header("Location: ../login.php"); // ou ../dashboard.php se quiser logar automático
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Usuário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex justify-content-center align-items-center vh-100 bg-light">
    <div class="card p-4 shadow-lg" style="width: 350px;">
        <h2 class="text-center mb-4">Cadastro</h2>
        <form method="post">
            <div class="mb-3">
                <label class="form-label">Nome</label>
                <input type="text" class="form-control" name="nome" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Sobrenome</label>
                <input type="text" class="form-control" name="sobrenome" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" name="email" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Senha</label>
                <input type="password" class="form-control" name="senha" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Data de Nascimento</label>
                <input type="date" class="form-control" name="data_nascimento" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Cadastrar</button>
            <a href="../index.php" class="btn btn-secondary w-100 mt-2">Voltar</a>
        </form>
    </div>
</body>
</html>
