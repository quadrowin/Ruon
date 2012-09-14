<?php

/**
 * Запускающий файл консоли
 */

require __DIR__ . '/Core.php';
$bootstrap = Ruon\Core::init(
    __DIR__ . '/Core/BootstrapAbstract.php',
    'Ruon\\Core\\BootstrapAbstract'
);

$bootstrap->getApplication()->run();