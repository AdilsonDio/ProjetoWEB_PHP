<?php
session_start();
include("conexao.php");

if (isset($_POST['login']) && isset($_POST['senha'])) {
    $login = $_POST['login'];
    $senha = $_POST['senha'];

    // Consultar banco de dados para verificar as credenciais
    $sql = "SELECT * FROM usuarios WHERE login = ? AND senha = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $login, $senha);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Login bem-sucedido
        $usuario = $result->fetch_assoc();
        $_SESSION['usuario_id'] = $usuario['id']; // Guarda o id do usuário na sessão
        header("Location: listar_produtos.php"); // Redireciona para outra página
        exit();
    } else {
        echo "Login ou senha inválidos.";
    }
} else {
    echo "Por favor, preencha todos os campos.";
}
?>
