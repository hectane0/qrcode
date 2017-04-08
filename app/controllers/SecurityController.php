<?php

use Phalcon\Validation\Message;
use QrCode\Forms\LoginForm;
use QrCode\Models\User\User;


class SecurityController extends ControllerBase
{

    public function loginAction()
    {
        \Phalcon\Tag::appendTitle(" - Logowanie");
        $loginForm = new LoginForm();
        if ($loginForm->isSubmittedAndValid()) {
            $user = User::getByEmail($this->request->getPost('email'));
            if ($user) {
                if ($user->isPasswordCorrect($this->request->getPost('password'))) {
                    $user->login();
                    $this->redirectToRoute('panel');
                }
            }
            $loginForm->addMessageToField('password', new Message("Błędny login lub hasło"));
        }

        $this->view->setVar('loginForm', $loginForm);
    }

    public function logoutAction()
    {
        if (User::isLogged()) {
            $this->session->remove('user');
        }
        $this->redirectToRoute('homepage');
    }
}
