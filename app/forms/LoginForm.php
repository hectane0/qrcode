<?php

namespace QrCode\Forms;

use Phalcon\Forms\Element as Element;
use Phalcon\Validation\Validator as Validator;

class LoginForm extends FormBase
{
    public function initialize() {

        $email = new Element\Email('email');
        $password = new Element\Password('password');

        $email->addValidator(new Validator\PresenceOf([
            'message' => 'Email jest wymagany'
        ]));

        $password->addValidator(new Validator\PresenceOf([
            'message' => 'Hasło jest wymagane'
        ]));

        $this->add($email);
        $this->add($password);
    }
}
