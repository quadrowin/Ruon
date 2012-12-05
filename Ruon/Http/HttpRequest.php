<?php

namespace Ruon\Http;

/**
 * Запрос, пришедший на прокси
 *
 * @author Shvedov_U
 */
class HttpRequest
{

    /**
     * Входящие заголовки
     *
     * @var HttpHeader
     */
    protected $header;

    /**
     * Запрошенный адрес
     *
     * @var string
     */
    protected $request_uri;

    /**
     * Пришедшие POST данные
     *
     * @var string
     */
    protected $post;

    /**
     * Хост
     *
     * @var string
     */
    protected $server_host;

    /**
     * Целевой IP
     *
     * @var string
     */
    protected $server_ip;

    /**
     * Порт
     *
     * @var integer
     */
    protected $server_port = 80;

    public function __construct()
    {
        $this->header = new HttpHeader;
    }

    /**
     * Возвращает HTTP заголовки запроса
     *
     * @return HttpHeader
     */
    public function getHeader()
    {
        return $this->header;
    }

    /**
     * Возвращает значение параметра запроса
     *
     * @param string $key
     * @return string|null
     */
    public function getGetParam($key)
    {
        $get = parse_url($this->request_uri, PHP_URL_QUERY);
        $gets = null;
        parse_str($get, $gets);

        if (isset($gets[$key])) {
            return $gets[$key];
        }

        // Есть проблемы, когда в запросе передается еще один знак вопроса,
        // он становится частью ключа
        foreach ($gets as $k => $v) {
            $p = strpos($k, '?');
            if ($p && substr($k, $p + 1) === $key) {
                return $v;
            }
        }

        return null;
    }

    /**
     * Возвращает URI запрос
     *
     * @return string
     */
    public function getRequestUri()
    {
        return $this->request_uri;
    }

    /**
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * Пришедшие POST данные
     *
     * @return string
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * Возвращает адрес сервера
     *
     * @return string
     */
    public function getServerHost()
    {
        return $this->server_host;
    }

    /**
     * Возвращает IP адрес сервера
     *
     * @return string
     */
    public function getServerIp()
    {
        return $this->server_ip;
    }

    /**
     * @return integer
     */
    public function getServerPort()
    {
        return $this->server_port;
    }

    /**
     *
     * @param string $post
     * @return $this|HttpRequest
     */
    public function setPost($post)
    {
        $this->post = $post;
        return $this;
    }

    /**
     *
     * @param string $request_uri
     * @return $this|HttpRequest
     */
    public function setRequestUri($request_uri)
    {
        $this->request_uri = $request_uri;
        return $this;
    }

    /**
     *
     * @param string $host
     * @return $this|HttpRequest
     */
    public function setServerHost($host)
    {
        $this->server_host = $host;
        return $this;
    }

    /**
     *
     * @param string $ip
     * @return $this|HttpRequest
     */
    public function setServerIp($ip)
    {
        $this->server_ip = $ip;
        return $this;
    }

    /**
     *
     * @param integer $port
     * @return $this|HttpRequest
     */
    public function setServerPort($port)
    {
        $this->server_port = $port;
        return $this;
    }

}
