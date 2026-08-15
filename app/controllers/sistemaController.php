<?php 

require_once __DIR__ . "/../services/sistemaService.php";

class sistemaController {
    public function checkAuth(){
        if (!isset($_SESSION['usuario'])) {
            http_response_code(401);
            echo json_encode(['error' => 'Usuário não autenticado']);
            exit();
        }
    }
    public function disk(){
        $this->checkAuth();
        $sistemaService = new SystemService();
        $resposta = $sistemaService->getDiskUsage();
        header('Content-Type: application/json');
        echo json_encode($resposta);
    }

    public function ram(){
        $this->checkAuth();
        $sistemaService = new SystemService();
        $resposta = $sistemaService->getRamUsage();
        header('Content-Type: application/json');
        echo json_encode($resposta);
    }

    public function cpu(){
        $this->checkAuth();
        $sistemaService = new SystemService();
        $resposta = $sistemaService->getCpuUsage();
        header('Content-Type: application/json');
        echo json_encode($resposta);
    }

    public function docker(){
	    $this->checkAuth();
	    $sistemaService = new SystemService();
	    $resposta = $sistemaService->getDocker();
	    header('Content-Type: application/json');
	    echo json_encode($resposta);
   }
}
