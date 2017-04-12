<?php

use QrCode\Models\Ranking\Ranking;

class StatsController extends ControllerBase
{

    public function indexAction()
    {
        $ranking = new Ranking();
        $ranking->getArray();

        $this->view->setVar('ranking', $ranking->getArray());
    }

    public function detailsAction()
    {
    }
}
