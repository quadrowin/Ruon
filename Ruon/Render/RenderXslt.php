<?php

namespace Ruon\Render;

/**
 *
 * Рендер XSLT
 *
 * @author Yury Shvedov
 *
 */
class RenderXslt extends RenderAbstract
{

    /**
     * Объект шаблонизатора
     *
     * @var \XSLTProcessor
     */
    protected $processor;

    /**
     * Сериализация данных в XML
     *
     * @TODO Вынести сериализацию в отдельный класс
     * @param DOMDocument $xml
     * @param DOMElement $parent
     * @param mixed $data
     */
    protected function dataToXml(
        \DOMDocument $xml,
        \DOMElement $parent,
        $data
    ) {
        foreach ($data as $key => $val) {
            if (is_numeric($key)) {
                $key = 'item';
            }

            if (is_object($val)) {
                if (method_exists($val, '__toArray')) {
                    $val = $val->__toArray();
                } elseif(method_exists($val, '__toString')) {
                    $val = $val->__toString();
                } else {
                    $val = null;
                }
            }

            if (is_array($val)) {
                $element = $xml->createElement($key);
                $parent->appendChild($element);
                $this->dataToXml($xml, $element, $val);
            } else {
                $element = $xml->createElement($key, $val);
                $parent->appendChild($element);
            }
        }
    }

    /**
     * Рендеринг шаблона
     */
    public function fetch($template)
    {
        $xsl = new \DOMDocument();
        $xsl->load($template);

        $this->processor = new \XSLTProcessor ();
        $this->processor->importStylesheet($xsl);
        $xml = $this->processor->transformToXml($this->xml());
        $this->processor = null;

        return $xml;
    }

    /**
     * Возвращает используемый экземпляр шаблонизатора.
     *
     * @return \XSLTProcessor
     */
    public function getProcessor()
    {
        return $this->processor;
    }

    /**
     * Формирует XML документ, содержащий данные для вывода
     *
     * @
     * @return \DOMDocument
     */
    public function xml()
    {
        $xml = new \DOMDocument('1.0', 'UTF-8');
        $root = $xml->createElement('input');
        $xml->appendChild($root);
        $this->dataToXml($xml, $root, $this->vars);
        return $xml;
    }

}