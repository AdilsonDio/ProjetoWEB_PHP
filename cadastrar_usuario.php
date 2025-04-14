<?php
session_start();

// Conexão com o banco de dados
include("conexao.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recebe os dados do formulário
    $login = $_POST['login'];
    $senha = $_POST['senha'];

    // Verifica se o login já existe no banco
    $sql = "SELECT * FROM usuarios WHERE login = '$login'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $erro = "O login já está em uso.";
    } else {
        // Criptografa a senha antes de salvar
        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

        // Insere o novo usuário no banco
        $sql = "INSERT INTO usuarios (login, senha) VALUES ('$login', '$senha_hash')";

        if ($conn->query($sql) === TRUE) {
            header("Location: login.php");
            exit();
        } else {
            $erro = "Erro ao cadastrar usuário: " . $conn->error;
        }
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Usuário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container">
    <h1 class="mt-5">Cadastrar Novo Usuário</h1>

    <?php if (isset($erro)) echo "<p style='color:red;'>$erro</p>"; ?>

    <form action="cadastrar_usuario.php" method="POST" class="mt-4">
        <div class="mb-3">
            <label for="login" class="form-label">Login</label>
            <input type="text" class="form-control" id="login" name="login" required>
        </div>
        <div class="mb-3">
            <label for="senha" class="form-label">Senha</label>
            <input type="password" class="form-control" id="senha" name="senha" required>
        </div>
        <button type="submit" class="btn btn-primary">Cadastrar</button>
    </form>

    <br>
    <a href="login.php">Já tem uma conta? Faça login</a>
</body>
</html>
