<?php

namespace Ruon;

/**
 *
 * Класс подключения Ruon
 *
 */
class Core
{

    /**
     * Возвращает название класса начальной загрузки по имени файла
     *
     * @param string $bootfile Файл начальной загрузки
     * @return Класс начальной загрузки
     */
    protected static function extractBootstrapClass($bootfile)
    {
        preg_match('#^.*[\\/]([\\w\\d]+)[\\/]([\\w\\d]+)\\.php$#', $filename, $m);
        return $m[1] . '\\' . $m[2];
    }

    /**
     * Инициализация и запуск начальной загрузки
     *
     * @param string $bootfile Путь до файла начальной загрузки
     * @param string $bootclass [optional] Класс начальной загрузки
     * @param boolean $run [optional] Выполнить начальную загрузку
     * @return Ruon\Core\BootstrapAbstract
     */
    public static function init($bootfile, $bootclass = null, $run = true)
    {
        if (!class_exists('Ruon\Core\BootstrapAbstract')) {
            require __DIR__ . '/Core/BootstrapAbstract.php';
        }

        require $bootfile;

        $class = $bootclass ?: self::extractBootstrapClass($filename);

        $bootstrap = new $class;

        if ($run) {
            $bootstrap->run();
        }

        return $bootstrap;
    }

}