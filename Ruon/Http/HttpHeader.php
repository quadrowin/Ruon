<?php

namespace Ruon\Http;

/**
 *
 * HTTP заголовок запроса или ответа
 *
 * @author Shvedov_U
 *
 */
class HttpHeader
{

    /**
     * Заголовки
     *
     * @var array string
     */
    protected $headers = array();

    /**
     *
     * @param string $header
     * @return $this|HttpHeader
     */
    public function add($header)
    {
        $this->headers[] = $header;
        return $this;
    }

    /**
     * Установка заголовков
     *
     * @param array $headers
     */
    public function setHeaders(array $headers)
    {
        $this->headers = $headers;
    }

    /**
     * Отправка заголовков
     */
    public function send()
    {
        foreach ($this->headers as $header) {
            header($header);
        }
    }

    /**
     * Возвращает все заголовки
     *
     * @return array|string
     */
    public function getHeaders($separator = null)
    {
        return $separator === null
            ? $this->headers
            : implode($separator, $this->headers);
    }

    /**
     * Поиск заголовка по названию
     *
     * @param string $key
     * @return string|null
     */
    public function getValue($key)
    {
        $search = $key . ':';
        $l = strlen($search);
        foreach ($this->headers as $header) {
            if (strncmp($header, $search, $l) == 0) {
                return ltrim(substr($header, $l));
            }
        }

        return null;
    }

}

