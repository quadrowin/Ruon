<?php

namespace Ruon\Data\Driver\Pdo;

/**
 *
 * Драйвер PDO
 *
 * @author goorus, morph
 *
 */
class PdoQueryTranslator extends \Ruon\Data\Driver\QueryTranslatorAbstract
{

    /**
     * @inject
     * @var \Ruon\DependencyInjection\ServiceManager
     */
    protected $serviceManager;

    /**
     * Возвращает рендер
     *
     * @param string $name
     * @return \Ruon\Data\Driver\Pdo\PartTranslator\PdoPartTranslatorAbstract
     */
    public function getRender($name)
    {
        $class = __NAMESPACE__ . '\\PartTranslator\\PdoPartTranslator' . $name;

        return $this->serviceManager->get($class, $this);
    }

    /**
     * Преобразует запрос к необходимому для выполнения драйвером формату.
     *
     * @param \Ruon\Query\Query
     */
    public function translate($query)
    {
        $translated = new \Ruon\Data\Driver\Pdo\PdoTranslatedQuery;
        $this->translateTo($query, $translated);
        return $translated;
    }

    /**
     * Перевод запроса
     *
     * @param \Ruon\Query\Query $query
     * @param \Ruon\Data\Driver\Pdo\PdoTranslatedQuery $translated
     */
    public function translateTo(
        \Ruon\Query\Query $query,
        \Ruon\Data\Driver\Pdo\PdoTranslatedQuery $translated
    ) {
        $renders = array(
            'Explain',
            'Term',
            'CalcFoundRows',
            'Distinct',
            $query->getMainType(),
            'Set',
            'Values',
            'From',
            'ForceIndex',
            'Where',
            'Group',
            'Having',
            'Order',
            'Limit'
        );
        foreach ($renders as $render) {
            $this->getRender($render)->translate($query, $translated);
        }
    }

}
