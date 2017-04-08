<?php

namespace QrCode\Forms\QR;

use QrCode\Forms\FormBase;
use Phalcon\Forms\Element as Element;
use Phalcon\Validation\Validator as Validator;

class StaticQRForm extends FormBase
{
    public function initialize() {

        $text = new Element\Text('text');

        $text->addValidator(new Validator\PresenceOf([
            'message' => 'Treść nie może być pusta'
        ]));

        $this->add($text);
    }

}