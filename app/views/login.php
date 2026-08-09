<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel VPS - Login</title>
</head>
<body>
    <main>
        <section>
            <div class="login-container">
                <h1>Login</h1>
                <?php if(isset($_SESSION['error'])): ?>
                    <p class="error-message">
                        <?php echo $_SESSION['error']; ?>
                        <?php unset($_SESSION['error']); ?>
                    </p>
                <?php endif; ?>
                <form action="/login" method="POST">
                    <label for="usuario">Usuário:</label>
                    <input type="text" id="usuario" name="usuario" required>
                    <label for="senha">Senha:</label>
                    <input type="password" id="senha" name="senha" required>
                    <button type="submit">Entrar</button>
                </form>
        </section>
    </main>
</body>
</html>