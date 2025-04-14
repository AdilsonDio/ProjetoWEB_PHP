<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario'])) {
    header('Location: valida_login.php'); // Redireciona para o login se não estiver logado
    exit();
}

echo "Bem-vindo, " . $_SESSION['usuario'] . "!";
?>
