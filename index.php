<?php

/**
 * Запускающий файл Web-приложения
 */

require __DIR__ . '/Core.php';
$bootstrap = Ruon\Core::init(
    __DIR__ . '/BootstrapAbstract.php',
    'Ruon\\BootstrapAbstract'
);

$bootstrap->getApplication()
    ->setFrontController('Ruon\\Controller\\Front\\ControllerFrontWeb')
    ->run();