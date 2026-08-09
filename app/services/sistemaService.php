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
        $disponivel = $memory['MemAvailable'];
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