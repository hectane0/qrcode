<?php

namespace QrCode\Forms\QR;

use Phalcon\Validation;
use Phalcon\Validation\Validator\File;
use QrCode\Forms\FormBase;
use Phalcon\Forms\Element as Element;
use Phalcon\Validation\Validator as Validator;
use QrCode\Validators\CodeNameOccupiedValidator;

class DynamicQRForm extends FormBase
{
    public function initialize()
    {
        $name = new Element\Text('text');
        $target = new Element\Text('target');
        $url = new Element\Text('url');
        $firstTry = new Element\Hidden('firstTry');
        $file = new Element\File('file');


        $name->addValidator(new Validator\PresenceOf([
            'message' => 'Treść nie może być pusta'
        ]));

        $target->addValidator(new Validator\PresenceOf([
            'message' => 'Treść nie może być pusta'
        ]));

        $url->addValidator(new Validator\PresenceOf([
            'message' => 'Treść nie może być pusta'
        ]));

        $url->addValidator(new CodeNameOccupiedValidator([
            'message' => 'Wybrana ścieżka jest już zajęta'
        ]));

        $target->addValidator(new Validator\Url([
            'message' => 'To nie jest poprawny url'
        ]));

        $this->add($name);
        $this->add($target);
        $this->add($url);
        $this->add($firstTry);
        $this->add($file);
    }


    public function validateFile()
    {
        $validation = new Validation();
        $file = new File(array(
            'maxSize' => '1MB',
            'messageSize' => 'Maksymalny rozmiar to 1MB',
            'allowedTypes' => ['image/jpeg', 'image/png'],
            'messageType' => 'Dozwolone typy to JPEG/PNG',
            'allowEmpty' => true
        ));
        $validation->add('file',$file);
        $messages = $validation->validate($_FILES);

        if (!$messages->count()) {
            return true;
        } else {
            $this->addMessageToField('file', $messages[0]);
            return false;
        }
    }
}