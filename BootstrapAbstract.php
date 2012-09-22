<?php

namespace Ruon;

use Ruon\DependencyInjection\Injector\InjectorStandart;

use Ruon\DependencyInjection\ServiceSource\ServiceSourceStandart;

use Ruon\DependencyInjection\ServiceLocator\ServiceLocatorStandart;

use Ruon\DependencyInjection\ServiceManager;

use Ruon\Loader\LoaderStandart;

use Ruon\Loader\LoaderAutoloadStandart;

/**
 *
 * Абстрактный класс начальной загрузки.
 * Класс начальной загрузки всегда должен находиться в корне проекта.
 *
 */
class BootstrapAbstract
{

    /**
     *
     * @var ServiceManager
     */
    protected $serviceManager;

    /**
     * @return Application
     */
    public function getApplication()
    {
        return $this->serviceManager->get('Ruon\\Application', $this);
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

        $autoloader = new LoaderAutoloadStandart;
        $autoloader
            ->setLoader($loader)
            ->register();

        // Менеджер сервисов
        $serviceLocator = new ServiceLocatorStandart;
        $serviceSource = new ServiceSourceStandart;
        $injector = new InjectorStandart;
        $this->serviceManager = new ServiceManager;

        $serviceLocator
            ->set(get_class($loader), null, $loader)
            ->set(get_class($autoloader), null, $autoloader)
            ->set(get_class($serviceLocator), null, $serviceLocator)
            ->set(get_class($serviceSource), null, $serviceSource)
            ->set(
                get_class($this->serviceManager),
                null,
                $this->serviceManager
            )
            ->set(get_class($injector), null, $injector);

        $serviceSource
            ->setInjector($injector)
            ->setServiceManager($this->serviceManager);

        $this->serviceManager
            ->setServiceLocator($serviceLocator)
            ->setServiceSource($serviceSource);

        $injector
            ->setInstanceSource($serviceSource)
            ->setServiceSource($this->serviceManager);
    }

}