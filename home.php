<?php 
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <!-- Link para o Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- Barra de navegação -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Projeto Web</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" href="home.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="listar_produtos.php">Produtos</a>
        </li>
        <!-- Link de Logout -->
        <li class="nav-item">
          <a class="nav-link" href="logout.php">Sair</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- Conteúdo principal -->
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <!-- Cartão de boas-vindas -->
            <div class="card">
                <div class="card-header">
                    <h2>Bem-vindo, <?php echo $_SESSION['usuario']; ?>!</h2>
                </div>
                <div class="card-body">
                    <p>Você está logado no sistema e pode começar a gerenciar os produtos cadastrados.</p>
                    <a href="listar_produtos.php" class="btn btn-primary">Ir para a lista de produtos</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Adicionando o script do Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
