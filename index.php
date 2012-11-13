<?php

/**
 * Запускающий файл Web-приложения
 */

require __DIR__ . '/Ruon/Core.php';
Ruon\Core::initApp(__DIR__, 'Ruon')->run();