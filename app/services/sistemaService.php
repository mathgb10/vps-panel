<?php

class SystemService
{
    public function checkAuth()
    {
        if (!isset($_SESSION['usuario'])) {
            http_response_code(401);
            echo json_encode(['error' => 'Usuário não autenticado']);
            exit();
        }
    }

    public function getDiskUsage()
    {
        checkAuth();
        $total = disk_total_space("/");
        $free = disk_free_space("/");
        $used = $total - $free;

        return [
            'total' => $total,
            'used' => $used,
            'free' => $free,
            'percentage' => ($used / $total) * 100
        ];
    }

}