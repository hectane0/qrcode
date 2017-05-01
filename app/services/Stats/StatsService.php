<?php

namespace QrCode\Services\Stats;

use Phalcon\Di;

class StatsService
{
    public function getHourCodeStats($codeId)
    {
        $sql = "SELECT DATE_FORMAT(date, '%Y-%m-%d %H:00:00') as date, COUNT(*) as count FROM redirect WHERE dynamic_code_id = $codeId GROUP BY DATE_FORMAT(date, '%Y-%m-%d %H:00:00')";
        $stats = Di::getDefault()->getShared('db')->fetchAll($sql);

        return $stats;
    }

    public function getMostPopularCodeForUser($userId)
    {
        $sql = "SELECT b.name, COUNT(*) as count FROM redirect AS a INNER JOIN dynamic_code AS b ON a.dynamic_code_id = b.id WHERE b.user_id = $userId GROUP BY a.dynamic_code_id ORDER BY count desc LIMIT 1;";
        $result = Di::getDefault()->getShared('db')->fetchOne($sql);

        return $result;
    }

    public function getPlatformStatsForCode($codeId)
    {
        $sql = "SELECT platform, COUNT(*) AS count FROM redirect WHERE dynamic_code_id = $codeId GROUP BY platform";
        $result = Di::getDefault()->getShared('db')->fetchAll($sql);

        return $result;
    }

    public function getBrowserStatsForCode($codeId)
    {
        $sql = "SELECT browser, COUNT(*) AS count FROM redirect WHERE dynamic_code_id = $codeId GROUP BY browser";
        $result = Di::getDefault()->getShared('db')->fetchAll($sql);

        return $result;
    }
}
