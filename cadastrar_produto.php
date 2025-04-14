<?php
// Conexão com o banco de dados
include("conexao.php");

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recebe os dados do formulário
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $quantidade = $_POST['quantidade'];
    $preco = $_POST['preco'];
    $usuario_id = 1; // Assume o usuário com id 1 (você pode ajustar isso com a sessão do login)

    // Insere o novo produto no banco
    $sql = "INSERT INTO dados (nome, descricao, quantidade, preco, usuario_id)
            VALUES ('$nome', '$descricao', '$quantidade', '$preco', '$usuario_id')";
    
    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>Produto cadastrado com sucesso!</div>";
    } else {
        echo "<div class='alert alert-danger'>Erro: " . $conn->error . "</div>";
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Produto</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container">
    <h1 class="mt-5">Cadastrar Novo Produto</h1>
    
    <form action="cadastrar_produto.php" method="POST" class="mt-4">
        <div class="mb-3">
            <label for="nome" class="form-label">Nome do Produto:</label>
            <input type="text" class="form-control" id="nome" name="nome" required>
        </div>

        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição:</label>
            <textarea class="form-control" id="descricao" name="descricao" rows="4" required></textarea>
        </div>

        <div class="mb-3">
            <label for="quantidade" class="form-label">Quantidade:</label>
            <input type="number" class="form-control" id="quantidade" name="quantidade" required>
        </div>

        <div class="mb-3">
            <label for="preco" class="form-label">Preço (R$):</label>
            <input type="number" step="0.01" class="form-control" id="preco" name="preco" required>
        </div>

        <button type="submit" class="btn btn-success">Cadastrar Produto</button>
    </form>

    <br>
    <a href="listar_produtos.php" class="btn btn-primary mt-3">Voltar para a lista de produtos</a>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
