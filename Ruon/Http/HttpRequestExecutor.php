<?php

namespace Ruon\Http;

/**
 * Исполнитель HTTP запросов, по сути - прокси сервер
 *
 * @author Shvedov_U
 */
class HttpRequestExecutor
{

    /**
     *
     * @var integer
     */
    protected $timeout = 20;

    /**
     *
     * @param HttpRequest $request
     * @param HttpResponse $response
     * @return HttpCurl
     */
    public function execute(HttpRequest $request, HttpResponse $response)
    {
        //put the HEADER data in the header
        $this_header = $request->getHeader()->getHeaders();
        $host_included = false;
        if ($this_header) {
            $header = array();
            foreach ($this_header as $key => $value) {
                if ($key == 'Host') {
                    $value = $request->getServerHost();
                    $host_included = true;
                } elseif ($key == 'Accept-Encoding') {
                    continue;
                }
                $header[] = $key . ':' . $value;
            }
        }
        if (!$host_included) {
            $header[] = 'Host:' . $request->getServerHost();
        }
//      var_dump($header);

        $addr = $request->getServerIp() ?: $request->getServerHost();
        $url = 'http://' . $addr . $request->getRequestUri();
//        var_dump($url);

        // Start the Curl session
        $curl = new \Sybase\CurlClient();
        $curl->init($url);

//        $curl->setopt(CURLOPT_CUSTOMREQUEST, 'GET ' . $page);

        if ($request->getServerPort()) {
            $curl->setOpt(CURLOPT_PORT, $request->getServerPort());
        }

        if ($header) {
            $curl->setOpt(CURLOPT_HTTPHEADER, $header);
        }

        // Don't return HTTP headers. Do return the contents of the call
        $curl->setOptArray(array(
            CURLOPT_HEADER => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => $this->timeout,
            CURLINFO_HEADER_OUT => true
        ));

        // If it's a POST, put the POST data in the body
        $post = $request->getPost();
        if ($post) {
            $curl->setOpt(CURLOPT_POSTFIELDS, $post);
        }

        // Make the call
        $result = $curl->exec()->getResult();

        if ($result === false) {
            $response->log(var_dump(
                $curl->error(),
                $curl->getinfo(CURLINFO_HEADER_OUT)
            ));
        }

        $info = $curl->getinfo();
//         $code = $inf['http_code'];

        $curl->close();

        $header = '';
        $body = $result;

        if ($info['download_content_length'] < 0) {
            $delim = "\r\n\r\n";
            $header_length = strpos($body, $delim);
            if ($header_length !== false) {
                $header = substr($body, 0, $header_length);
                $body = substr($body, $header_length + strlen($delim));
            }
        } else {
            $header = substr($body, 0, $info['header_size']);
            $body = substr($body, -$info['download_content_length']);
        }

        $content_type_sended = false;

        if ($header) {
            // only header

            $headers = explode("\n", $header);

            $search = 'content-type:';
            foreach ($headers as $line) {
                $line = trim($line);

                if (strncasecmp($search, $line, strlen($search)) == 0) {
                    $content_type_sended = true;
                    $response->getHeader()->add($line);
                    break;
                }
            }
        }

        if (!$content_type_sended) {
            // The web service returns XML. Set the Content-Type appropriately
            $response->getHeader()->add('Content-Type:text/xml');
//             $response->getHeader()->add('Content-Type:text/plain');
        }

        $response->setBody($body);

        return $curl;
    }

    /**
     *
     * @param integer $timeout
     * @return $this|HttpRequestExecutor
     */
    public function setTimeout($timeout)
    {
        $this->timeout = $timeout;
        return $this;
    }

}
