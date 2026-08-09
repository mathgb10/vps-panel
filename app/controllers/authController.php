<?php 

class authController {
    public function login($usuario,$senha){
        $usuarios = json_decode(file_get_contents(__DIR__ . "/../config/usuarios.json"), true);

        if($usuario == $usuarios['usuarios'][0]['nome']){
            if(password_verify($senha, $usuarios['usuarios'][0]['senha'])){
                $_SESSION['usuario'] = $usuario;
                return true;
                exit();
            } else {
                $_SESSION['error'] = "Senha incorreta.";
                return false;
                exit();
                }
        } else {
            $_SESSION['error'] = "Usuário não encontrado.";
            return false;
            exit();
        }
    }

    public function logout(){
        session_destroy();
        header("Location: /");
        exit();
    }
}