<?php

namespace QrCode\Models\User;

use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Validator\Email as Email;
use Phalcon\Di;

class User extends Model
{

    public $id;
    public $email;
    public $password;

    public function validation()
    {
        $this->validate(
            new Email(
                array(
                    'field'    => 'email',
                    'required' => true,
                )
            )
        );

        if ($this->validationHasFailed() == true) {
            return false;
        }

        return true;
    }


    public function getSource()
    {
        return 'user';
    }

    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

    public static function getByEmail($email) {
        return self::findFirst(["email = '$email'"]);
    }

    public function isPasswordCorrect($password)
    {
        if (password_verify($password, $this->password)) {
            return true;
        }
        return false;
    }

    public function login()
    {
        $user = $this->toArray($this);
        $this->getDI()->getShared('session')->set('user', $user);
    }

    public static function isLogged()
    {
        $user = Di::getDefault()->getShared('session')->get('user');
        if ($user) {
            return true;
        }
        return false;
    }

    public static function getCurrentUseId()
    {
        if (self::isLogged()) {
            $user = Di::getDefault()->getShared('session')->get('user');
            return $user['id'];
        }

        return false;
    }

}
