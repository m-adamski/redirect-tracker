<?php

namespace Core\Services\Request;

class Request {

    protected $requestScheme;
    protected $requestHost;
    protected $requestMethod;
    protected $requestUri;
    protected $requestRemote;

    /**
     * Request constructor.
     *
     * @param $requestScheme
     * @param $requestHost
     * @param $requestMethod
     * @param $requestUri
     * @param $requestRemote
     */
    public function __construct($requestScheme, $requestHost, $requestMethod, $requestUri, $requestRemote) {
        $this->requestScheme = $requestScheme;
        $this->requestHost = $requestHost;
        $this->requestMethod = $requestMethod;
        $this->requestUri = $requestUri;
        $this->requestRemote = $requestRemote;
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

        // Return new Request
        return new Request($requestScheme, $requestHost, $requestMethod, $requestUri, $requestRemote);
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
