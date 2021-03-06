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
    public $platform;
    public $browser;
    public $ip;


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

        $ua = parse_user_agent();
        $this->platform = $ua['platform'];
        $this->browser = $ua['browser'];

        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        $this->ip = $ip;

        $this->save();
    }

    public static function getLastVisit()
    {
        $userId = User::getCurrentUseId();
        $sql = "SELECT a.id, a.date, b.name, b.user_id FROM redirect AS a INNER JOIN dynamic_code AS b ON a.dynamic_code_id = b.id WHERE b.user_id = $userId ORDER BY a.date desc LIMIT 1";
        $result = $count = Di::getDefault()->getShared('db')->fetchOne($sql);

        return $result;
    }
}
