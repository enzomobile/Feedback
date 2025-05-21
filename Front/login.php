<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entre com sua conta</title>
</head>
<body>
    <center>
        <h1>Faça Login!</h1>

        <form action="../Back/logar.php" method="POST">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br><br>

            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required><br><br>

            <button type="submit">Entrar</button>
        </form>
        <p>Não tem uma conta? <a href="cadastro.php">Cadastre-se</a></p>
    </center>
</body>
</html>