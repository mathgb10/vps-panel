<?php

require_once __DIR__ . "/app/controllers/authController.php";
require_once __DIR__ . "/app/controllers/homeController.php";
require_once __DIR__ . "/app/controllers/sistemaController.php";

$authController = new AuthController();
$homeController = new HomeController();
$sistemaController = new sistemaController();

switch ($rota) {

    // Rotas de autenticação
    case "/":
        require __DIR__ . "/app/views/login.php";
        break;

    case 'login':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = $_POST['usuario'] ?? '';
            $senha = $_POST['senha'] ?? '';
            if ($authController->login($usuario, $senha)) {
                header("Location: /home");
                exit;
            }
            header("Location: /login");
            exit;
        }
        require __DIR__ . "/app/views/login.php";
        break;

    case 'logout':
        $authController->logout();
        break;
    
    // Rotas da página inical
    case 'home':
        $homeController->index();
        break;

    // API com informações do sistema
    case 'api/system/disk':
        $sistemaController->disk();
        break;

    case 'api/system/ram':
        $sistemaController->ram();
        break;

    case 'api/system/cpu':
        $sistemaController->cpu();
        break;

    case 'api/system/docker':
        $sistemaController->docker();
        break;

    default:
        http_response_code(404);
        echo "Página não encontrada.";
}