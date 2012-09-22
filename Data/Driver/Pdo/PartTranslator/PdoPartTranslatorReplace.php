<?php

namespace Ruon\Data\Driver\Pdo\PartTranslator;

/**
 *
 * Рендеринг REPLACE части запроса.
 *
 * @author goorus, morph
 *
 */
class PdoPartTranslatorReplace extends PdoPartTranslatorAbstract
{

    const SQL_REPLACE = 'REPLACE';

    /**
     * @inject
     * @var Mogod\Core\Model\Scheme\ModelScheme
     */
    protected $modelScheme;

    /**
     * Переводит часть запроса
     *
     * @param \Ruon\Query\Query
     * @param \Ruon\Data\Driver\Pdo\PdoTranslatedQuery
     */
    public function translate($query, $translated)
    {
        $parts = $this->getMyPart($query);

        if (!$parts) {
            return ;
        }

        $table = reset($parts[0]->getData());

        $translated->appendSql(
            self::SQL_REPLACE, ' ',
            $this->modelScheme->getModelProperty($table, 'Table')
        );
    }

}
