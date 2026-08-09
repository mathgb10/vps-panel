<?php

require_once __DIR__ . "/app/controllers/AuthController.php";
require_once __DIR__ . "/app/controllers/HomeController.php";
require_once __DIR__ . "/app/services/sistemaService.php";

$authController = new AuthController();
$homeController = new HomeController();
$sistemaService = new SystemService();

switch ($rota) {

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

    case 'home':
        $homeController->index();
        break;

    case 'api/system/disk':
        $sistemaService->getDiskUsage();
        break;

    case 'logout':
        $authController->logout();
        break;

    default:
        http_response_code(404);
        echo "Página não encontrada.";
}