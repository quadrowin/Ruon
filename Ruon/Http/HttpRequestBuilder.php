<?php

namespace Ruon\Http;

/**
 * Билдер Http запроса
 *
 * @author Shvedov_U
 */
class HttpRequestBuilder
{

    /**
     * Создает запрос из глобальных параметров
     *
     * @return HttpRequest
     */
    public function fromGlobals()
    {
        $request = new HttpRequest;
        $request->getHeader()->setHeaders($this->utils()->getallheaders());
        return $request
            ->setRequestUri($_SERVER['REQUEST_URI'])
            ->setServerIp($_SERVER['SERVER_ADDR'])
            ->setServerHost($_SERVER['HTTP_HOST'])
            ->setPost(file_get_contents('php://input'));
    }

    /**
     * Возвращает утилиты
     *
     * @return \SybaseUtils
     */
    protected function utils()
    {
        return \Sybase\Multiton::get('Sybase\\Utils');
    }

}
