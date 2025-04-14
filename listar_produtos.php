<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

include("conexao.php");

// Consulta os produtos no banco
$sql = "SELECT dados.*, usuarios.login AS usuario_nome FROM dados 
        JOIN usuarios ON dados.usuario_id = usuarios.id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagem de Produtos</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome para ícones -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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

    <div class="container mt-5">
        <h1 class="mb-4">Produtos Cadastrados</h1>
        
        <div class="d-flex justify-content-between mb-3">
            <a href="cadastrar_produto.php" class="btn btn-success"><i class="fas fa-plus-circle"></i> Cadastrar novo produto</a>
            <form class="d-flex" method="GET" action="listar_produtos.php">
                <input class="form-control me-2" type="search" placeholder="Buscar por nome" aria-label="Search" name="search">
                <button class="btn btn-outline-primary" type="submit"><i class="fas fa-search"></i> Buscar</button>
            </form>
        </div>

        <div class="row">
            <?php
            // Verifica se existem produtos cadastrados
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "
                        <div class='col-md-4 mb-3'>
                            <div class='card'>
                                <div class='card-body'>
                                    <h5 class='card-title'>{$row['nome']}</h5>
                                    <p class='card-text'>{$row['descricao']}</p>
                                    <ul class='list-unstyled'>
                                        <li><strong>Quantidade:</strong> {$row['quantidade']}</li>
                                        <li><strong>Preço:</strong> R$ {$row['preco']}</li>
                                        <li><strong>Usuário:</strong> {$row['usuario_nome']}</li>
                                    </ul>
                                    <div class='d-flex justify-content-between'>
                                        <a href='editar_produto.php?id={$row['id']}' class='btn btn-warning btn-sm'><i class='fas fa-edit'></i> Editar</a>
                                        <a href='excluir_produto.php?id={$row['id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Tem certeza que deseja excluir?\")'><i class='fas fa-trash-alt'></i> Excluir</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    ";
                }
            } else {
                echo "<p class='alert alert-warning'>Nenhum produto encontrado.</p>";
            }
            ?>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>
