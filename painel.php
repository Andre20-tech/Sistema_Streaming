<?php
session_start();

// Redireciona para login se não estiver autenticado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../index.php"); 
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <title>Painel - Menu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">André</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu" aria-controls="navbarMenu" aria-expanded="false" aria-label="Alternar navegação">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarMenu">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <!-- Usuarios -->
                    <li class="nav-item">
                        <a class="nav-link" href="usuarios/usuarios.php">Usuários</a>
                    </li>
                     <!-- Planos -->
                    <li class="nav-item">
                        <a class="nav-link" href="planos/planos.php">Planos</a>
                    </li>
                     <!-- Filmes -->
                    <li class="nav-item">
                        <a class="nav-link" href="filmes/filmes.php">Filmes</a>
                    </li>
                     <!-- Gêneros -->
                    <li class="nav-item">
                        <a class="nav-link" href="generos/genero.php">Gêneros</a>
                    </li>
                       <!-- Assinaturas -->
                    <li class="nav-item">
                        <a class="nav-link" href="assinaturas/assinatura.php">Assinaturas</a>
                    </li>
                         <!-- Avaliações -->
                    <li class="nav-item">
                        <a class="nav-link" href="avaliacao/avaliacoes.php">Avaliações</a>
                    </li>
                          <!-- Assistidos -->
                    <li class="nav-item">
                        <a class="nav-link" href="assistidos/assistidos.php">Assistidos</a>
                    </li>
                    
                </ul>
                <span class="navbar-text text-light me-3">
                    Olá, <?= htmlspecialchars($_SESSION['nome']) ?>
                </span>
                <a href="logout.php" class="btn btn-outline-light">Sair</a>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h1>Bem-vindo ao Painel, <?= htmlspecialchars($_SESSION['nome']) ?>!</h1>
        <p>Escolha uma opção no menu acima.</p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
