<?php

use Phalcon\Mvc\Controller;
use QrCode\Models\User\User;

class ControllerBase extends Controller
{
    public function initialize() {
        \Phalcon\Tag::setTitle('QR Code');
        $this->assets->addCss('css/main.css');
        $this->assets->addJs('js/main.js');

        $jsPath = 'js/' . $this->router->getControllerName() . '/' . $this->router->getActionName() . '.js';
        $cssPath = 'css/' . $this->router->getControllerName() . '/' . $this->router->getActionName() . '.css';
        if (file_exists($jsPath)) {
            $this->assets->addJs($jsPath);
        }
        if (file_exists($cssPath)) {
            $this->assets->addJs($cssPath);
        }
    }

    protected function show404If($condition = true)
    {
        if ($condition) {
            $this->dispatcher->forward([
                'controller' => 'error',
                'action' => 'show404'
            ]);
        }
        return false;
    }

    protected function redirectToRoute($name, $parameters = null)
    {
        $this->response->redirect(['for' => $name, $parameters]);
    }

    protected function redirectIfNotLoged()
    {
        if (!User::isLogged()) {
            $this->redirectToRoute('login');
        }
    }
}
