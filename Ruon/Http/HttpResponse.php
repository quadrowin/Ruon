<?php

namespace Ruon\Http;

/**
 * Ответ прокси сервера клиенту
 *
 * @author Shvedov_U
 */
class HttpResponse
{

    /**
     * Заголовки
     *
     * @var HttpHeader
     */
    protected $header;

    /**
     * Тело ответа
     *
     * @var string
     */
    protected $body;

    public function __construct()
    {
        $this->header = new HttpHeader;
    }

    /**
     * Тело ответа
     *
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @return HttpHeader
     */
    public function getHeader()
    {
        return $this->header;
    }

    /**
     * Установка тела ответа
     *
     * @param string $body
     * @return $this|HttpResponse
     */
    public function setBody($body)
    {
        $this->body = $body;
        return $this;
    }

}
