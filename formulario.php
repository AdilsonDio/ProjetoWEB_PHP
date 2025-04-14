<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Produto</title>
</head>
<body>
    <h2>Cadastrar Produto</h2>
    <form action="processa_cadastro.php" method="POST">
        Nome: <input type="text" name="nome" required><br><br>
        Descrição: <textarea name="descricao"></textarea><br><br>
        Quantidade: <input type="number" name="quantidade" required><br><br>
        Preço: <input type="text" name="preco" required><br><br>
        <input type="submit" value="Cadastrar Produto">
    </form>
</body>
</html>
