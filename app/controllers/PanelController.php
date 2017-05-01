<?php

use QrCode\Forms\QR\DynamicQRForm;
use QrCode\Forms\QR\StaticQRForm;
use QrCode\Models\DynamicCode\DynamicCode;
use QrCode\Models\Redirect\Redirect;
use QrCode\Models\User\User;

class PanelController extends ControllerBase
{
    public function beforeExecuteRoute()
    {
        if (!$this->redirectIfNotLoged()) return false;
        return true;
    }

    public function indexAction()
    {
        $last = Redirect::getLastVisit();
        $mostPopular = $this->getDI()->get('statsService')->getMostPopularCodeForUser(User::getCurrentUseId());

        $this->view->setVar('last', $last);
        $this->view->setVar('popular', $mostPopular);
    }

    public function addAction()
    {
    }

    public function addStaticAction()
    {
        $qrForm = new StaticQRForm();
        $this->view->setVar('qr', $qrForm);
    }

    public function addDynamicAction()
    {
        $qrForm = new DynamicQRForm();

        if ($qrForm->isSubmittedAndValid()) {
            $dynamicCode = new DynamicCode();
            if ($id = $dynamicCode->createFromData($this->request->getPost(), $this->request->getUploadedFiles()[0])) {
                $this->response->redirect("/panel/my-qrs/details/$id");
            } else {
                $qrForm->addMessageToField('text', new \Phalcon\Validation\Message('Nieoczekiwany błąd :('));
            }
        }

        $this->view->setVar('qr', $qrForm);

    }

    public function downloadAction()
    {
        if (!$this->request->isPost() && !$this->request->isGet()) {
            die("Nie kombinuj");
        }

        $filename = date('Ymdhms') . "QR.png";
        header("Content-Disposition: attachment;filename=$filename");
        header('Content-Type: application/force-download');

        if ($this->request->isPost()) {
            $b64 = $this->request->getPost('b64');
            echo base64_decode($b64);die;
        }

        $id = $this->request->get('id');
        $code = DynamicCode::findFirst($id);
        if ($code->user_id == User::getCurrentUseId()) {
            readfile(APP_PATH . "/qrs/" . trim($code->filename)); die;
        }
    }

    public function codeAction()
    {
        $this->assets->addCss('http://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.10.0/styles/default.min.css');
        $this->assets->addJs('http://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.10.0/highlight.min.js');

        $code = file_get_contents(APP_PATH . "/scripts/qr-generate.py");

        $this->view->setVar('code', $code);
    }

    public function myCodesAction()
    {
        $id = User::getCurrentUseId();
        $codes = DynamicCode::find("user_id = $id");

        $this->view->setVar('codes', $codes);
    }

    public function codeDetailsAction()
    {
        $id = $this->dispatcher->getParam('id');
        $code = DynamicCode::findFirst($id);

        $this->view->setVar('code', $code);
    }

    public function showAction()
    {
        $code = DynamicCode::findFirst($this->dispatcher->getParam('id'));

        header('Content-type: image/png');
        readfile(APP_PATH . "/qrs/" . trim($code->filename)); die;
    }


}
