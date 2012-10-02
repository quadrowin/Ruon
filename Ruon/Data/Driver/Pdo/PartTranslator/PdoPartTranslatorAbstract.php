<?php

namespace Ruon\Data\Driver\Pdo\PartTranslator;

/**
 *
 * Абстрактный транслятор части запроса
 *
 * @author goorus, morph
 *
 */
abstract class PdoPartTranslatorAbstract
{

    const SQL_COMMA = ',';

    const SQL_DOT = '.';

    const SQL_EQUAL = '=';

    const SQL_ESCAPE = '`';

    const SQL_QUOTE = '"';

    const SQL_WILDCARD = '*';

     /**
     * Обособляет название mysql терма, если в этом есть необходимость.
     * Функция вернет исходную строку, если в ней присутствуют спец. символы
     * (точки, скобки, кавычки, знаки мат. операций и т.п.)
     *
     * @param string $value Название терма.
     * @return string Резултат обособления.
      */
    protected function escape($value)
    {
        if (
            strpos($value, self::SQL_WILDCARD) === false &&
            strpos($value, '(') === false &&
            strpos($value, ' ') === false &&
            strpos($value, self::SQL_DOT) === false &&
            strpos($value, '<') === false &&
            strpos($value, '>') === false &&
            strpos($value, self::SQL_ESCAPE) === false
        )
        {
            return self::SQL_ESCAPE .
                addslashes(iconv('UTF-8', 'UTF-8//IGNORE', $value)) .
                self::SQL_ESCAPE;
        }
        return $value;
    }

    /**
     * Возвращает транслируемую часть запроса
     *
     * @param \Ruon\Query\Query $query
     * @return array
     */
    public function getMyPart($query)
    {
        return $query->getPart($this->getName());
    }

    /**
     * Возвращает название транслятора
     *
     * @return string
     */
    public function getName()
    {
        return substr(
            get_class($this),
            strlen(__CLASS__) - strlen('Abstract')
        );
    }

    /**
     * Заключает выражение в кавычки
     *
     * @param mixed $value
     * @return string
     */
    protected function quote($value)
    {
        return self::SQL_QUOTE .
            addslashes(iconv('UTF-8', 'UTF-8//IGNORE', $value)) .
            self::SQL_QUOTE;
    }

    /**
     * Рендеринг подзапроса
     *
     * @param \Ruon\Query\Query $query
     * @param \Ruon\Data\Driver\Pdo\PdoTranslatedQuery $translated
     * @return string
     */
    protected function renderSubquery($query, $translated)
    {
        $originalSql = $translated->getSql();
        $translated->setSql('');

        $translated->getTranslator()->translateTo($query, $translated);

        $subsql = $translated->getSql();

        $translated->setSql($originalSql);

        return $subsql;
    }

    /**
     * Переводит часть запроса
     *
     * @param \Ruon\Query\Query
     * @param \Ruon\Data\Driver\Pdo\PdoTranslatedQuery
     */
    abstract public function translate($query, $translated);

}
