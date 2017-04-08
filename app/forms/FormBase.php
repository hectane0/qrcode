<?php

namespace QrCode\Forms;

use Phalcon\Forms\Form;
use Phalcon\Validation\Message;

abstract class FormBase extends Form
{
    /**
     * @param String $field
     * @param Message $message
     */
    public function addMessageToField($field, $message)
    {
        $messages = $this->getMessagesFor($field);
        $messages->appendMessage($message);
    }

    /**
     * @return bool
     */
    public function validateFile()
    {
        return true;
    }

    /**
     * @return bool
     */
    public function isSubmittedAndValid()
    {
        if ($this->request->isPost()) {
            $isPostValid = $this->isValid($this->request->getPost());
            $isFileValid = true;

            if($this->request->hasFiles(true)) {
                $isFileValid = $this->validateFile();
            }

            return $isPostValid && $isFileValid;
        }
        return false;
    }
}