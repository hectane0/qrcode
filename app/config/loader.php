<?php


$loader = new \Phalcon\Loader();

$loader->registerNamespaces(
    [
        'QrCode\Models' => APP_PATH . "/app/models",
        'QrCode\Forms' => APP_PATH . "/app/forms",
        'QrCode\Validators' => APP_PATH . "/app/validators",
        'QrCode\Services' => APP_PATH . "/app/services",
    ]
);

$loader->registerDirs(
    [
        $config->application->controllersDir,
        $config->application->modelsDir
    ]
);

$loader->register();

require_once APP_PATH . "/vendor/autoload.php";
