<?php

/**
 * Запускающий файл Web-приложения
 */

require __DIR__ . '/Core.php';
Ruon\Core::init(
    __DIR__ . '/Core/BootstrapAbstract.php',
    'Ruon\\Core\\BootstrapAbstract'
);

$bootstrap->getApplication()
    ->setFrontController('Ruon\\Core\\Controller\\Front\\ControllerFrontWeb')
    ->run();