<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

include("conexao.php");

// Verifica se o ID do produto foi passado
if (isset($_GET['id'])) {
    $produto_id = $_GET['id'];

    // Consulta para pegar as informações do produto antes de excluir
    $sql = "SELECT * FROM dados WHERE id = $produto_id";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $produto = $result->fetch_assoc();
    } else {
        echo "Produto não encontrado.";
        exit();
    }

    // Se a confirmação for feita (via POST)
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Exclui o produto
        $sql_delete = "DELETE FROM dados WHERE id = $produto_id";
        if ($conn->query($sql_delete) === TRUE) {
            echo "Produto excluído com sucesso!";
            header("Location: listar_produtos.php");
            exit();
        } else {
            echo "Erro ao excluir produto: " . $conn->error;
        }
    }
} else {
    echo "ID do produto não informado.";
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excluir Produto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h1>Excluir Produto</h1>
    <div class="alert alert-warning">
        Tem certeza que deseja excluir o produto: <strong><?php echo $produto['nome']; ?></strong>?
    </div>
    
    <form action="excluir_produto.php?id=<?php echo $produto_id; ?>" method="POST">
        <button type="submit" class="btn btn-danger">Confirmar Exclusão</button>
        <a href="listar_produtos.php" class="btn btn-secondary">Cancelar</a>
    </form>
</body>
</html>
