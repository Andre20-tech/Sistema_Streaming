<?php
require 'db.php';

$stmt = $pdo->query("SELECT * FROM usuario");
$usuarios = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Usuários</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Lista de Usuários</h1>
    <a href="add_user.php">Adicionar Novo Usuário</a>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Sobrenome</th>
            <th>Email</th>
            <th>Data de Nascimento</th>
            <th>Ações</th>
        </tr>
        <?php foreach ($usuarios as $u): ?>
        <tr>
            <td><?= $u['id_usuario'] ?></td>
            <td><?= $u['nome'] ?></td>
            <td><?= $u['sobrenome'] ?></td>
            <td><?= $u['email'] ?></td>
            <td><?= $u['data_nascimento'] ?></td>
            <td>
                <a href="edit_user.php?id=<?= $u['id_usuario'] ?>">Editar</a> |
                <a href="delete_user.php?id=<?= $u['id_usuario'] ?>" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
