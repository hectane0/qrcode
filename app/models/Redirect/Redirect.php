<?php

namespace QrCode\Models\Redirect;

use Phalcon\Mvc\Model;
use QrCode\Models\DynamicCode\DynamicCode;


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
}
