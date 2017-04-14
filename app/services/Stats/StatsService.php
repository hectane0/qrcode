<?php

namespace QrCode\Services\Stats;

use Phalcon\Di;

class StatsService
{
    public function getHourCodeStats($codeId)
    {
        $sql = "SELECT DATE_FORMAT(date, '%Y-%m-%d %H:00') as date, COUNT(*) as count FROM qrcode.redirect WHERE dynamic_code_id = $codeId GROUP BY DATE_FORMAT(date, '%Y-%m-%d %H:00')";
        $stats = Di::getDefault()->getShared('db')->fetchAll($sql);

        return $stats;
    }
}