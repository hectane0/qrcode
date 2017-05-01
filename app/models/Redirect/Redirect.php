<?php

namespace QrCode\Models\Redirect;

use Phalcon\Mvc\Model;
use QrCode\Models\DynamicCode\DynamicCode;
use QrCode\Models\User\User;
use Phalcon\Di;


class Redirect extends Model
{

    public $id;
    public $dynamic_code_id;
    public $date;
    public $useragent;


    public function getSource()
    {
        return 'redirect';
    }


    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }


    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

    public function saveVisitData(DynamicCode $dynamicCode)
    {
        $this->dynamic_code_id = $dynamicCode->id;
        $this->date = date('Y-m-d H:i:s');
        $this->useragent = $_SERVER['HTTP_USER_AGENT'];

        $this->save();
    }

    public static function getLastVisit()
    {
        $userId = User::getCurrentUseId();
        $sql = "SELECT a.id, a.date, b.name, b.user_id FROM qrcode.redirect AS a INNER JOIN dynamic_code AS b ON a.dynamic_code_id = b.id WHERE b.user_id = $userId ORDER BY a.date desc LIMIT 1";
        $result = $count = Di::getDefault()->getShared('db')->fetchOne($sql);

        return $result;
    }
}
