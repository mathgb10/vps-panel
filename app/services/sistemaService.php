<?php

class SystemService
{

    public function getDiskUsage()
    {
        $total = disk_total_space("/");
        $disponivel = disk_free_space("/");
        $usado = $total - $disponivel;

        return [
            'total' => $total,
            'usado' => $usado,
            'disponivel' => $disponivel,
            'porcentagem' => ($usado / $total) * 100
        ];
    }

    public function getRamUsage()
    {
        $meminfo = file('/proc/meminfo');
        $memory = [];

        foreach ($meminfo as $line) {
            [$key, $value] = explode(':', $line);
            $value = trim($value);
            $value = str_replace(' kB', '', $value);
            $memory[$key] = (int) $value;
        }

        $total = $memory['MemTotal'];
        $disponivel = $memory['MemFree'];
        $usado = $total - $disponivel;

        return [
            'total' => $total,
            'usado' => $usado,
            'disponivel' => $disponivel,
            'porcentagem' => round(($usado / $total) * 100, 2)
        ];
    }

    public function getCpuUsage()
    {
        $cpu1 = file('/proc/stat')[0];
    
        usleep(100000);
    
        $cpu2 = file('/proc/stat')[0];
    
        $cpu1 = preg_split('/\s+/', trim($cpu1));
        $cpu2 = preg_split('/\s+/', trim($cpu2));
    
        $idle1 = $cpu1[4];
        $idle2 = $cpu2[4];
    
        $total1 = array_sum(array_slice($cpu1, 1));
        $total2 = array_sum(array_slice($cpu2, 1));
    
        $total = $total2 - $total1;
        $idle = $idle2 - $idle1;
    
        $porcentagem = (($total - $idle) / $total) * 100;
    
        return [
            'porcentagem' => round($porcentagem, 2)
        ];
    }

    public function getDocker()
    {
        $resposta = [];
        $return_code = 0;

        exec(
            'docker ps --format ' . escapeshellarg('{{json .}}') . ' 2>&1',
            $resposta,
            $return_code
        );

        if ($return_code !== 0) {
            return [
                'running' => false,
                'apps' => []
            ];
        }

        $apps = [];

        foreach ($resposta as $linha) {
            $container = json_decode($linha, true);

            if (!$container) {
                continue;
            }

            $apps[] = [
                'id' => $container['ID'],
                'nome' => $container['Names'],
                'status' => $container['Status'],
                'criado_em' => $container['CreatedAt'],
            ];
        }

        return [
            'running' => true,
            'apps' => $apps
        ];
    }
}