<?php

class SystemService
{

    public function getDiskUsage()
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