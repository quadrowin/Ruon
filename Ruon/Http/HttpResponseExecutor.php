<?php

namespace Ruon\Http;

/**
 * Исполнитель ответов прокси сервера
 *
 * @author Shvedov_U
 */
class HttpResponseExecutor
{

    /**
     *
     * @param HttpResponse $response
     */
    public function execute($response)
    {
        $response->getHeader()->send();
        echo $response->getBody();
    }

}
