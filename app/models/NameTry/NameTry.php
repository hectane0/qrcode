<?php

namespace QrCode\Models\NameTry;

use Phalcon\Mvc\Model;

class NameTry extends Model
{

    public $id;
    public $first;
    public $last;


    public function getSource()
    {
        return 'name_try';
    }


    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }


    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
