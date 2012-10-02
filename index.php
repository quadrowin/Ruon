<?php

/**
 * Запускающий файл Web-приложения
 */

require __DIR__ . '/Ruon/Core.php';
$bootstrap = Ruon\Core::init(
    __DIR__ . '/Ruon/BootstrapAbstract.php',
    'Ruon\\BootstrapAbstract'
);

$bootstrap->getApplication()
    ->setFrontController('Ruon\\Controller\\Front\\ControllerFrontWeb')
    ->run();