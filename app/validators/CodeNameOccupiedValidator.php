<?php

namespace QrCode\Validators;

use Phalcon\Validation;
use Phalcon\Validation\Validator;
use Phalcon\Validation\ValidatorInterface;
use Phalcon\Validation\Message;
use QrCode\Models\DynamicCode\DynamicCode;

class CodeNameOccupiedValidator extends Validator implements ValidatorInterface
{
    public function validate(Validation $validation, $attribute)
    {
        $date = $validation->getValue($attribute);

        $dynamicCode = DynamicCode::findFirst("argument = '$date'");

        if (!$dynamicCode) {
            return true;
        }

        $message = $this->getOption('message');
        if (!$message) {
            $message = "This path is occupied!";
        }

        $validation->appendMessage(new Message($message, $attribute));
        return false;
    }
}