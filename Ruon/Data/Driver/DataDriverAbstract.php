<?php

namespace Ruon\Data\Driver;

/**
 *
 *
 * @author goorus, morph
 */
abstract class DataDriverAbstract
{

    /**
     * Переводчик запросов
     *
     * @service
     * @var QueryTranslatorAbstract
     */
    protected $translator;

    /**
     * Схема моделей
     *
     * @service
     * @var \Ruon\Entity\EntityScheme
     */
    protected $modelScheme;

    /**
     * Выполняет запрос
     *
     * @param \Ruon\Query\Query $query Запрос
     * @return \Ruon\Query\QueryResult Результат выполнения запроса
     */
    public function execute($query)
    {
        $translated = $this->getTranslator()->translate($query);
        return $this->executeTranslated($translated);
    }

    /**
     * Выполняет переведенный запрос
     *
     * @param mixed $query Переведенный запрос
     * @return \Ruon\Query\QueryResult Результат выполнения запроса
     */
    abstract public function executeTranslated($query);

    /**
     * Возвращает транслятор запросов
     *
     * @return QueryTranslatorAbstract
     */
    public function getTranslator()
    {
        return $this->translator;
    }

}
