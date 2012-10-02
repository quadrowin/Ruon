<?php

namespace Ruon\Data\Driver;

/**
 *
 * Подготовленный к исполнению запрос
 *
 * @author goorus, morph
 *
 */
class TranslatedQueryAbstract
{

    /**
     * Создавший этот запрос транслятор
     *
     * @var QueryTranslatorAbstract
     */
    protected $translator;

    /**
     * Возвращает транслятор запроса
     *
     * @return QueryTranslatorAbstract
     */
    public function getTranslator()
    {
        return $this->getTranslator();
    }

    /**
     *
     * @param QueryTranslatorAbstract $translator
     * @return $this
     */
    public function setTranslator($translator)
    {
        $this->translator = $translator;
        
        return $this;
    }

}
