<?php

/**
 * Запускающий файл консоли
 */

require __DIR__ . '/Ruon/Core.php';
Ruon\Core::initApp(__DIR__, 'Ruon', 'Cli')->run();
