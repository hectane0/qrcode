<?php

class ErrorController extends ControllerBase
{

    public function show404Action()
    {
        $this->response->setStatusCode(404, 'Not Found');
        var_dump("404");die;
    }
}
