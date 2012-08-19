<?php

namespace Ruon\Core;

use Ruon\Core\DependencyInjection\ServiceSource\ServiceSourceStandart;

use Ruon\Core\DependencyInjection\ServiceLocator\ServiceLocatorStandart;

use Ruon\Core\Loader\LoaderAutoloadAbstract;

use Ruon\Core\DependencyInjection\ServiceManager;

use Ruon\Core\Loader\LoaderStandart;

use Ruon\Core\Loader\LoaderAutoloadStandart;

/**
 *
 * Абстрактный класс начальной загрузки.
 * Класс начальной загрузки всегда должен находиться в корне проекта.
 *
 */
class BootstrapAbstract
{

    /**
     * @return
     */
    public function getConfigProvider()
    {

    }

    /**
     * Запуск загрузки
     */
    public function run()
    {
        // Загрузчик
        require __DIR__ . '/Loader/LoaderAbstract.php';
        require __DIR__ . '/Loader/LoaderStandart.php';

        $loader = new LoaderStandart();
        $loader->setPath(__NAMESPACE__, __DIR__);

        // Автозагрузка классов
        require __DIR__ . '/Loader/LoaderAutoloadAbstract.php';
        require __DIR__ . '/Loader/LoaderAutoloadStandart.php';

        $autoloader = new LoaderAutoloadStandart();
        $autoloader
            ->setLoader($loader)
            ->register();

        // Менеджер сервисов
        $serviceLocator = new ServiceLocatorStandart();
        $serviceSource = new ServiceSourceStandart();
        $serviceManager = new ServiceManager();

        $serviceLocator
            ->set(get_class($loader), null, $loader)
            ->set(get_class($autoloader), null, $autoloader)
            ->set(get_class($serviceLocator), null, $serviceLocator)
            ->set(get_class($serviceSource), null, $serviceSource)
            ->set(get_class($serviceManager), null, $serviceManager);

        $serviceSource
            ->setServiceManager($serviceManager)
            ->setConfigProvider($this->getConfigProvider());

        $serviceManager
            ->setServiceLocator($serviceLocator)
            ->setServiceSource($serviceSource);
    }

}