<?php

use QrCode\Models\DynamicCode\DynamicCode;
use QrCode\Models\Redirect\Redirect;

class RedirectController extends ControllerBase
{

    public function toAction()
    {
        $arg = $this->dispatcher->getParam('argument');

        $dynamicCode = DynamicCode::findFirst("argument = '$arg'");
        $redirect = new Redirect();
        $redirect->saveVisitData($dynamicCode);

        $this->response->redirect($dynamicCode->target, true);
    }
}
