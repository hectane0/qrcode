<?php

use QrCode\Models\DynamicCode\DynamicCode;
use QrCode\Models\QR\QR;

class AjaxController extends ControllerBase
{

    public function beforeExecuteRoute()
    {
        if (!$this->request->isAjax()) {
            return $this->response->redirect('error/show404');
        }
        return true;
    }

    public function generateQRPreviewAction()
    {

        $data = $this->request->getPost('data');

        $text = $data[0];
        $fill = $data[1];
        $background = $data[2];

        $qr = new QR($text, $fill, $background);
        $b64 = $qr->getQRInBase64();

        echo $b64;
    }

    public function checkCodeNameOccupiedAction()
    {
        $url = $this->request->getPost('url');
        $dynamicCode = DynamicCode::findFirst("argument = '$url'");


        if (!$dynamicCode) {
            $data[0] = true;
            $data[1] = "Ścieżka jest wolna!";
            $data[2] = null;

            echo json_encode($data);die;
        }

        $data[0] = false;
        $data[1] = "Ścieżka jest zajęta!";
        $data[2] = ['path1', 'path2', 'path3'];

        echo json_encode($data);
    }
}