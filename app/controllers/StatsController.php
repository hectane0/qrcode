<?php

use QrCode\Models\DynamicCode\DynamicCode;
use QrCode\Models\Ranking\Ranking;
use QrCode\Models\Redirect\Redirect;

class StatsController extends ControllerBase
{
    public function initialize()
    {
        parent::initialize();
        $this->assets->addJs('https://www.gstatic.com/charts/loader.js', false);
    }

    public function indexAction()
    {
        $ranking = new Ranking();

        $this->view->setVar('ranking', $ranking->getArray());
    }

    public function detailsAction()
    {
        $codeId = $this->dispatcher->getParam('id');
        $code = DynamicCode::findFirst($codeId);
        $stats = $this->getDI()->get('statsService')->getHourCodeStats($codeId);
        $lasts = Redirect::find([
            "dynamic_code_id = $codeId",
            'order' => 'date DESC',
            'limit' => 5,
        ]);

        $this->view->setVar('lasts', $lasts);
        $this->view->setVar('code', $code);
        $this->view->setVar('stats', $stats);
    }
}
