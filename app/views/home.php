<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel VPS - Home</title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="shortcut icon" href="favicon.png" type="image/x-icon">
</head>

<body>
    <main>
        <aside class="sidebar">
            <div class="header-sidebar">
                <h3>VPS Panel</h3>
                <p>1.0</p>
            </div>
            <div class="links">
                <a href="/home">Home</a>
            </div>
            <div class="footer-sidebar">
                <a href="/logout">Sair<img src="/assets/icons/box-arrow-in-right.svg" alt="Sair"></a>
            </div>
        </aside>
        <section class="content">
            <header class="header">
                <h1>Bem-vindo ao Panel VPS Sr <?= $_SESSION['usuario']; ?></h1>
            </header>
            <div class="informacoes-container">
                <div class="informacoes-box">
                    <div class="card">
                        <div class="header-infos"><span>CPU:</span> <img src="/assets/icons/cpu.svg" alt="CPU"></div>
                        <span id="cpu-porcentagem">0%</span>
                        <meter id="cpu-meter" min="0" max="100" value="0"></meter>
                    </div>
                    <div class="card">
                        <div class="header-infos"><span>RAM:</span> <img src="/assets/icons/memory.svg" alt="RAM"></div>
                        <span id="ram-porcentagem">0%</span>
                        <meter id="ram-meter" min="0" max="100" value="0"></meter>
                        <div>
                            TOTAL:<span id="ram-total">0</span>
                            USADO:<span id="ram-usado">0</span>
                            DISPONÍVEL:<span id="ram-disponivel">0</span>
                        </div>
                    </div>
                    <div class="card">
                        <div class="header-infos"><span>Disco:</span> <img src="/assets/icons/device-hdd-fill.svg" alt="Disco"></div>
                        <span id="disk-porcentagem">0%</span>
                        <meter id="disk-meter" min="0" max="100" value="0"></meter>
                        <div>
                            TOTAL:<span id="disk-total">0</span>
                            USADO:<span id="disk-usado">0</span>
                            DISPONÍVEL:<span id="disk-disponivel">0</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <script src="/js/script.js" defer></script>
</body>

</html>