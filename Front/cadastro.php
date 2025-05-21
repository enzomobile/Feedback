<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faça sua conta</title>
</head>
<body>
    <center>
        <h1>Se cadastre!</h1>

        <form action="../Back/cadastrar.php" method="POST">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required><br><br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br><br>

            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required><br><br>

            <button type="submit">Cadastrar</button>
        </form>
        <p>Já tem uma conta? <a href="login.php">Entre</a></p>
    </center>
</body>
</html>