<?php

namespace RingCentral\SDK\Http;

use Exception;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\StreamInterface;

class Client
{

    /** @var GuzzleClient */
    private $_guzzle;

    public function __construct($guzzle)
    {
        $this->_guzzle = $guzzle;
    }

    /**
     * @param RequestInterface $request
     * @return ApiResponse
     * @throws ApiException
     */
    public function send(RequestInterface $request)
    {

        /** @var ApiResponse $apiResponse */
        $apiResponse = null;

        try {

            $apiResponse = $this->loadResponse($request);

            if ($apiResponse->ok()) {

                return $apiResponse;

            } else {

                throw new Exception('Response has unsuccessful status');

            }

        } catch (Exception $e) {

            // The following means that request failed completely
            if (empty($apiResponse)) {
                $apiResponse = new ApiResponse($request);
            }

            throw new ApiException($apiResponse, $e);

        }

    }

    /**
     * @param RequestInterface $request
     * @return ApiResponse
     * @throws Exception
     */
    protected function loadResponse(RequestInterface $request)
    {

        //TODO Is it needed?
        if (stristr($request->getHeaderLine('Content-Type'), 'multipart/form-data')) {
            $request = $request->withHeader('Expect', '');
        }

        //TODO Is it needed?
        if ($request->getBody()->isSeekable()) {
            $request->getBody()->rewind();
        }

        $response = $this->_guzzle->send($request, array('exceptions' => false));

        return new ApiResponse($request, $response);

    }

    /**
     * @param null|string                                $method
     * @param null|string                                $url
     * @param null|string|array                          $queryParams
     * @param null|string|array|resource|StreamInterface $body Message body.
     * @param null|array                                 $headers
     * @throws Exception
     * @return RequestInterface
     */
    public function createRequest($method, $url, $queryParams = array(), $body = null, $headers = array())
    {

        $properties = $this->parseProperties($method, $url, $queryParams, $body, $headers);

        return new Request($properties['method'], $properties['url'], $properties['headers'], $properties['body']);

    }

    /**
     * @param RequestInterface $request
     * @return string[]
     */
    protected function getRequestHeaders(RequestInterface $request)
    {

        $headers = array();

        foreach (array_keys($request->getHeaders()) as $name) {
            $headers[] = $name . ': ' . $request->getHeaderLine($name);
        }

        return $headers;

    }

    /**
     * @param null|string                                $method
     * @param null|string                                $url
     * @param null|string|array                          $queryParams
     * @param null|string|array|resource|StreamInterface $body Message body.
     * @param null|array                                 $headers
     * @throws Exception
     * @return array
     */
    protected function parseProperties($method, $url, $queryParams = array(), $body = null, $headers = array())
    {

        // URL

        if (!empty($queryParams) && is_array($queryParams)) {
            $queryParams = http_build_query($queryParams);
        }

        if (!empty($queryParams)) {
            $url = $url . (stristr($url, '?') ? '&' : '?') . $queryParams;
        }

        // Headers

        $contentType = null;
        $accept = null;

        foreach ($headers as $k => $v) {

            if (strtolower($k) == 'content-type') {
                $contentType = $v;
            }

            if (strtolower($k) == 'accept') {
                $accept = $v;
            }

        }

        if (!$contentType) {
            $contentType = 'application/json';
            $headers['content-type'] = $contentType;
        }

        if (!$accept) {
            $accept = 'application/json';
            $headers['accept'] = $accept;
        }

        // Body

        if ($contentType && !empty($body)) {

            switch (strtolower($contentType)) {
                case 'application/json':
                    $body = json_encode($body);
                    break;

                case 'application/x-www-form-urlencoded';
                    $body = http_build_query($body);
                    break;

                default:
                    break;
            }

        }

        // Create request

        return array(
            'method'  => $method,
            'url'     => $url,
            'headers' => $headers,
            'body'    => $body,
        );

    }

}