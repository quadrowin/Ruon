<?php

namespace Ruon;

use Ruon\Di\Injector\InjectorStandart;

use Ruon\Di\ServiceSource\ServiceSourceStandart;

use Ruon\Di\ServiceLocator\ServiceLocatorStandart;

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
     * @var Loader\LoaderAbstract
     */
    protected $loader;

    /**
     *
     * @var DependencyInjection\ServiceLocator\ServiceLocatorStandart
     */
    protected $serviceLocator;

    /**
     * @return Application
     */
    public function getApplication()
    {
        return $this->serviceLocator->get('Ruon\\Application', $this);
    }

    /**
     * @return Loader\LoaderAbstract
     */
    public function getLoader()
    {
        if (!$this->loader) {
            $this->loader = $this->createLoader();
        }

        return $this->loader;
    }

    /**
     * Создание загрузчика
     *
     * @return Loader\LoaderStandart
     */
    public function createLoader()
    {
        require __DIR__ . '/Loader/LoaderAbstract.php';
        require __DIR__ . '/Loader/LoaderStandart.php';

        $loader = new LoaderStandart();
        $loader->setPath(__NAMESPACE__, __DIR__);
        return $loader;
    }

    /**
     * Запуск загрузки
     */
    public function run()
    {
        $loader = $this->getLoader();

        // Автозагрузка классов
        require __DIR__ . '/Loader/LoaderAutoloadAbstract.php';
        require __DIR__ . '/Loader/LoaderAutoloadStandart.php';

        $autoloader = new LoaderAutoloadStandart;
        $autoloader
            ->setLoader($loader)
            ->register();

        $serviceLocator = new ServiceLocatorStandart;
        $serviceSource = new ServiceSourceStandart;
        $injector = new InjectorStandart;
        $this->serviceLocator = $serviceLocator;

        $serviceLocator
            ->setServiceSource($serviceSource)
            ->set(get_class($loader), null, $loader)
            ->set(get_class($autoloader), null, $autoloader)
            ->set(get_class($serviceLocator), null, $serviceLocator)
            ->set(get_class($serviceSource), null, $serviceSource)
            ->set(get_class($injector), null, $injector);

        $serviceSource
            ->setInjector($injector)
            ->setServiceLocator($serviceLocator);

        $injector->setSources(array(
            'inject' => $this->serviceLocator,
            'service' => $this->serviceLocator
        ));
    }

}