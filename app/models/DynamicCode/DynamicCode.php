<?php

namespace QrCode\Models\DynamicCode;

use Phalcon\Http\Request\FileInterface;
use Phalcon\Mvc\Model;
use QrCode\Models\NameTry\NameTry;
use QrCode\Models\QR\QR;
use QrCode\Models\User\User;

class DynamicCode extends Model
{
    public $id;
    public $name;
    public $target;
    public $argument;
    public $public_url;
    public $user_id;
    public $filename;
    public $created_at;


    public function getSource()
    {
        return 'dynamic_code';
    }


    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }


    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

    public function createFromData($post, FileInterface $file = null)
    {
        $this->name = $post['text'];
        $this->target = $post['target'];
        $this->argument = $post['url'];
        $this->public_url = 'http://' . $_SERVER['SERVER_NAME'] . (($_SERVER['SERVER_PORT'] == 80) ? "" : (":".$_SERVER['SERVER_PORT'])) . '/to/' . $post['url'];
        $this->user_id = User::getCurrentUseId();
        $this->created_at = date('Y-m-d H:i:s');

        $path = null;
        if (!empty($file->getName())) {
            $path = APP_PATH . '/images/' . $file->getName();
            $file->moveTo($path);
        }

        $qr = new QR($this->public_url, $post['fill'], $post['background'], $path);
        $this->filename = trim($qr->save());

        $try = new NameTry();
        $try->first = $post['firstTry'];
        $try->last = $post['url'];
        $try->save();

        $this->save();
        return $this->id;
    }
}
