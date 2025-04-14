<?php
include("conexao.php");

$nome = $_POST['nome'] ?? '';
$descricao = $_POST['descricao'] ?? '';
$quantidade = $_POST['quantidade'] ?? 0;
$preco = $_POST['preco'] ?? 0.0;

// Por enquanto vamos usar um usuário fixo (id 1)
$usuario_id = 1;

// Prepara o comando SQL com segurança
$stmt = $conn->prepare("INSERT INTO dados (nome, descricao, quantidade, preco, usuario_id) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("ssidi", $nome, $descricao, $quantidade, $preco, $usuario_id);

if ($stmt->execute()) {
    echo "Produto cadastrado com sucesso!";
} else {
    echo "Erro: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
