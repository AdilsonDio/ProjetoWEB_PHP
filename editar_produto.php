<?php
// Iniciar a sessão
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

include("conexao.php");

// Verifica se o ID do produto foi passado na URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Consulta o produto a ser editado
    $sql = "SELECT * FROM dados WHERE id = $id";
    $result = $conn->query($sql);

    // Verifica se o produto existe
    if ($result->num_rows > 0) {
        $produto = $result->fetch_assoc();
    } else {
        echo "Produto não encontrado.";
        exit();
    }
} else {
    echo "ID do produto não fornecido.";
    exit();
}

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recebe os dados do formulário
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $quantidade = $_POST['quantidade'];
    $preco = $_POST['preco'];

    // Atualiza os dados no banco
    $sql = "UPDATE dados SET nome = '$nome', descricao = '$descricao', quantidade = '$quantidade', preco = '$preco' WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Produto atualizado com sucesso!";
        header("Location: listar_produtos.php"); // Redireciona para a lista de produtos após atualização
        exit();
    } else {
        echo "Erro: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Produto</title>
    <!-- Link do Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container">
    <h1 class="mt-5">Editar Produto</h1>
    <form action="editar_produto.php?id=<?php echo $id; ?>" method="POST">
        <div class="mb-3">
            <label for="nome" class="form-label">Nome:</label>
            <input type="text" id="nome" name="nome" class="form-control" value="<?php echo $produto['nome']; ?>" required>
        </div>

        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição:</label>
            <textarea id="descricao" name="descricao" class="form-control" required><?php echo $produto['descricao']; ?></textarea>
        </div>

        <div class="mb-3">
            <label for="quantidade" class="form-label">Quantidade:</label>
            <input type="number" id="quantidade" name="quantidade" class="form-control" value="<?php echo $produto['quantidade']; ?>" required>
        </div>

        <div class="mb-3">
            <label for="preco" class="form-label">Preço:</label>
            <input type="number" step="0.01" id="preco" name="preco" class="form-control" value="<?php echo $produto['preco']; ?>" required>
        </div>

        <button type="submit" class="btn btn-primary">Atualizar Produto</button>
    </form>

    <br>
    <a href="listar_produtos.php" class="btn btn-secondary">Voltar para a lista de produtos</a>
</body>
</html>
