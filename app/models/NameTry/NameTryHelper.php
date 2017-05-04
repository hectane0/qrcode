<?php

namespace QrCode\Models\NameTry;

use Phalcon\Di;

class NameTryHelper
{
    public static function findSuggestions($url, $count = 3)
    {
        $suggestion = [];

        for ($i = 1; $i <=3; $i++) {
            $suggestion[] = $url . $i;
            $suggestion[] = $i . $url;
        }
        $suggestion[] = $url . "-qr";
        $suggestion[] = "qr-" . $url;

        $s = "'" . implode("', '", $suggestion) . "'";
        $sql = "SELECT argument FROM dynamic_code WHERE argument IN ($s)";
        $result = Di::getDefault()->getShared('db')->fetchAll($sql);
        $result = array_map('current', $result);

        $array = array_diff($suggestion, $result);

        $suggests = [];
        foreach( array_rand($array, $count) as $key ) {
            $suggests[] = $array[$key];
        }

        return $suggests;
    }

}