<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel VPS - Login</title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="shortcut icon" href="favicon.png" type="image/x-icon">
</head>
<body>
    <main>
        <form action="/login" method="POST" class="login-container">
            <h1>Login</h1>
            <?php if(isset($_SESSION['error'])): ?>
                <p class="error-message">
                    <?php echo $_SESSION['error']; ?>
                    <?php unset($_SESSION['error']); ?>
                </p>
            <?php endif; ?>
            <div class="inputs-container">
                <div class="input-box">
                    <label for="usuario">Usuário:</label>
                    <input type="text" id="usuario" name="usuario" required>
                </div>
                <div class="input-box">
                    <label for="senha">Senha:</label>
                    <input type="password" id="senha" name="senha" required>
                </div>
            </div>
            <button type="submit" onclick="sendData()" class="btn-full primary-btn">Entrar</button>
        </div>
    </main>
    <script src="/js/script.js" defer></script>
</body>
</html>