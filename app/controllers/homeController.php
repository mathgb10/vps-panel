<?php 
class homeController {
    public function index() {
        if(!isset($_SESSION['usuario'])) {
            $_SESSION['erro'] = "Usuário não autenticado";
            header("Location: /login");
            exit();
        }
        require __DIR__ . "/../views/home.php";
    }
}
?>