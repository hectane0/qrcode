<?php

$router = new \Phalcon\Mvc\Router(false);
$router->removeExtraSlashes(true);


$router->add("/", [
    'controller' => 'index',
    'action' => 'index',
])->setName("homepage");

$router->add("/pomoc", [
    'controller' => 'index',
    'action' => 'index',
])->setName("help");

$router->add("/kontakt", [
    'controller' => 'index',
    'action' => 'index',
])->setName("contact");

$router->add("/login", [
    'controller' => 'security',
    'action' => 'login',
])->setName("login");

$router->add("/logout", [
    'controller' => 'security',
    'action' => 'logout',
])->setName("logout");

$router->add("/panel", [
    'controller' => 'panel',
    'action' => 'index',
])->setName("panel");

$router->add("/panel/add", [
    'controller' => 'panel',
    'action' => 'add',
])->setName("add");

$router->add("/panel/add/static", [
    'controller' => 'panel',
    'action' => 'addStatic',
])->setName("add-static");

$router->add("/panel/add/dynamic", [
    'controller' => 'panel',
    'action' => 'addDynamic',
])->setName("add-dynamic");

$router->add("/panel/download", [
    'controller' => 'panel',
    'action' => 'download',
])->setName("download");

$router->add("/panel/code", [
    'controller' => 'panel',
    'action' => 'code',
])->setName("code");

$router->add("/panel/my-qrs", [
    'controller' => 'panel',
    'action' => 'myCodes',
])->setName("my-codes");

$router->add("/panel/my-qrs/details/([0-9]+)", [
    'controller' => 'panel',
    'action' => 'codeDetails',
    'id' => 1,
])->setName("code-details");

$router->add("/panel/show/([0-9]+)", [
    'controller' => 'panel',
    'action' => 'show',
    'id' => 1,
])->setName("panel-show");

$router->add("/panel/stats", [
    'controller' => 'stats',
    'action' => 'index',
])->setName("stats");

$router->add("/panel/stats/([0-9]+)", [
    'controller' => 'stats',
    'action' => 'details',
    'id' => 1,
])->setName("stats-details");

$router->add("/to/([^/;]+)", [
    'controller' => 'redirect',
    'action' => 'to',
    'argument' => 1,
])->setName("redirect");

$router->add("/ajax/qr-generate/preview", [
    'controller' => 'ajax',
    'action' => 'generateQRPreview',
])->setName("ajax-preview");

$router->add("/ajax/check-occupied", [
    'controller' => 'ajax',
    'action' => 'checkCodeNameOccupied',
])->setName("ajax-codeOccupied");


$router->notFound([
    'controller' => 'error',
    'action' => 'show404'
]);
