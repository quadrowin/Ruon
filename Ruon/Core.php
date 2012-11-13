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
     * Алиасы фронтов
     *
     * @var array of string
     */
    protected static $fronts = array(
        'Cli' => 'Ruon\\Controller\\Front\\ControllerFrontCli',
        'Web' => 'Ruon\\Controller\\Front\\ControllerFrontWeb'
    );

    /**
     * Возвращает название класса начальной загрузки по имени файла
     *
     * @param string $bootfile Файл начальной загрузки
     * @return Класс начальной загрузки
     */
    protected static function extractBootstrapClass($bootfile)
    {
        $m = null;
        preg_match(
            '#^.*[\\/]([\\w\\d]+)[\\/]([\\w\\d]+)\\.php$#',
            $bootfile,
            $m
        );
        return $m[1] . '\\' . $m[2];
    }

    /**
     * Инициализация и запуск начальной загрузки
     *
     * @param string $bootfile Путь до файла начальной загрузки
     * @param string $bootclass [optional] Класс начальной загрузки
     * @param boolean $run [optional] Выполнить начальную загрузку
     * @return BootstrapAbstract
     */
    public static function initBoot($bootfile, $bootclass = null, $run = true)
    {
        $abstractFile = __DIR__ . '/BootstrapAbstract.php';
        if (!class_exists('Ruon\\BootstrapAbstract')) {
            require $abstractFile;
        }

        if (realpath($abstractFile) !== realpath($bootfile)) {
            require $bootfile;
        }

        $class = $bootclass ?: self::extractBootstrapClass($bootfile);

        $bootstrap = new $class;

        if ($run) {
            $bootstrap->run();
        }

        return $bootstrap;
    }

    /**
     *
     * @param string $dir Директория проекта
     * @param string $namespace Пространство имен проекта
     * @param string $front [optional] Фронт контроллер
     * @return Application
     */
    public static function initApp($dir, $namespace, $front = 'Web')
    {
        $bootstrap = self::initBoot(
            "$dir/$namespace/{$namespace}Bootstrap.php",
            "$namespace\\{$namespace}Bootstrap"
        );

        $bootstrap->getLoader()->setPath(
            $namespace,
            "$dir/$namespace/"
        );

        $application = $bootstrap->getApplication();

        if (isset(self::$fronts[$front])) {
            $front = self::$fronts[$front];
        }

        if ($front) {
            $application->setFrontController($front);
        }

        return $application;
    }

}