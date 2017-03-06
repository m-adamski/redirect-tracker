<?php

namespace Core\Services\Request;

use Core\Exceptions\RuntimeException;
use DusanKasan\Knapsack\Collection;

class Request {

    protected $requestScheme;
    protected $requestHost;
    protected $requestMethod;
    protected $requestUri;
    protected $requestRemote;
    protected $requestData;

    /**
     * Request constructor.
     *
     * @param string $requestScheme
     * @param string $requestHost
     * @param string $requestMethod
     * @param string $requestUri
     * @param string $requestRemote
     * @param Collection $requestData
     */
    public function __construct(string $requestScheme, string $requestHost, string $requestMethod, string $requestUri, string $requestRemote, Collection $requestData) {
        $this->requestScheme = $requestScheme;
        $this->requestHost = $requestHost;
        $this->requestMethod = $requestMethod;
        $this->requestUri = $requestUri;
        $this->requestRemote = $requestRemote;
        $this->requestData = $requestData;
    }

    /**
     * Capture Request details from headers.
     *
     * @return Request
     */
    public static function capture() {

        // Parse Global Server variable
        $requestScheme = (isset($_SERVER['REQUEST_SCHEME'])) ? $_SERVER['REQUEST_SCHEME'] : null;
        $requestHost = (isset($_SERVER['HTTP_HOST'])) ? $_SERVER['HTTP_HOST'] : null;
        $requestMethod = (isset($_SERVER['REQUEST_METHOD'])) ? $_SERVER['REQUEST_METHOD'] : null;
        $requestUri = (isset($_SERVER['REQUEST_URI'])) ? $_SERVER['REQUEST_URI'] : null;
        $requestRemote = (isset($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : null;
        $requestData = (isset($_POST)) ? new Collection($_POST) : (isset($_GET) ? new Collection($_GET) : new Collection([]));

        // Return new Request
        return new Request($requestScheme, $requestHost, $requestMethod, $requestUri, $requestRemote, $requestData);
    }

    /**
     * Return Request data by key.
     *
     * @param string $key
     * @return mixed
     * @throws RuntimeException
     */
    public function get(string $key) {
        if ($this->requestData->has($key)) {
            return $this->requestData->get($key);
        }

        throw new RuntimeException('Request item data does not found.');
    }

    /**
     * Return array with Request data.
     *
     * @return array
     */
    public function all() {
        return $this->requestData->toArray();
    }

    /**
     * @return string
     */
    public function getRequestScheme() {
        return $this->requestScheme;
    }

    /**
     * @return string
     */
    public function getRequestHost() {
        return $this->requestHost;
    }

    /**
     * @return string
     */
    public function getRequestMethod() {
        return $this->requestMethod;
    }

    /**
     * @return string
     */
    public function getRequestUri() {
        return $this->requestUri;
    }

    /**
     * @return string
     */
    public function getRequestRemote() {
        return $this->requestRemote;
    }
}
