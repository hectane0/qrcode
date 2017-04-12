<?php

namespace QrCode\Models\Ranking;

use QrCode\Models\User\User;
use Phalcon\Di;

class Ranking
{
    public function getArray($limit = 10)
    {
        $userId = User::getCurrentUseId();
        $sql = "SELECT a.id, a.name, b.total FROM qrcode.dynamic_code AS a INNER JOIN (SELECT dynamic_code_id, COUNT(*) as total FROM redirect GROUP BY dynamic_code_id) as b ON b.dynamic_code_id = a.id WHERE a.user_id = $userId LIMIT $limit";
        $ranking = Di::getDefault()->getShared('db')->fetchAll($sql);

        return $ranking;
    }
}