<?php

namespace Core\Services\Session;

use Core\Exceptions\RuntimeException;
use Symfony\Component\HttpFoundation\Session\Session as SymfonySession;
use Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage;

class Session {

    protected $sessionContainer;

    /**
     * Session constructor.
     */
    public function __construct() {
        $this->sessionContainer = new SymfonySession(new NativeSessionStorage());
    }

    /**
     * Add new Variable into Session.
     *
     * @param string $key
     * @param $value
     * @throws RuntimeException
     */
    public function add(string $key, $value) {
        if (!$this->sessionContainer->has($key)) {
            $this->sessionContainer->set($key, $value);
        } else {
            sd($this->sessionContainer->all());
            throw new RuntimeException('Item already exist in Session.');
        }
    }

    /**
     * Get Variable from Session.
     *
     * @param string $key
     * @return mixed
     * @throws RuntimeException
     */
    public function get(string $key) {
        if ($this->sessionContainer->has($key)) {
            return $this->sessionContainer->get($key);
        }

        throw new RuntimeException('Item does not found in Session.');
    }

    /**
     * Check if Variable exist in Session.
     *
     * @param string $key
     * @return bool
     */
    public function has(string $key) {
        return $this->sessionContainer->has($key);
    }

    /**
     * Remove Variable from Session.
     *
     * @param $key
     * @return mixed
     * @throws RuntimeException
     */
    public function remove($key) {
        if ($this->sessionContainer->has($key)) {
            return $this->sessionContainer->remove($key);
        }

        throw new RuntimeException('Item does not found in Session.');
    }

    /**
     * Replace Variable in Session.
     *
     * @param string $key
     * @param $value
     * @throws RuntimeException
     */
    public function replace(string $key, $value) {
        if ($this->sessionContainer->has($key)) {
            return $this->sessionContainer->replace([$key => $value]);
        }

        throw new RuntimeException('Item does not found in Session.');
    }

    /**
     * Clear Session.
     */
    public function clear() {
        return $this->sessionContainer->clear();
    }

    /**
     * Add new variable into Session FlashBag.
     *
     * @param string $key
     * @param $value
     */
    public function addFlash(string $key, $value) {
        $this->sessionContainer->getFlashBag()->set($key, $value);
    }

    /**
     * Return variable with specified name from Session FlashBag.
     *
     * @param string $key
     * @param bool $flatten
     * @return array|mixed
     * @throws RuntimeException
     */
    public function getFlash(string $key, bool $flatten = true) {
        if ($this->sessionContainer->getFlashBag()->has($key)) {

            $flashVariable = $this->sessionContainer->getFlashBag()->get($key);

            return (is_array($flashVariable) && count($flashVariable) === 1 && isset($flashVariable[0]) && $flatten) ? $flashVariable[0] : $flashVariable;
        }

        throw new RuntimeException('Item does not found in Session FlashBag.');
    }

    /**
     * Check if Variable exist in Session FlashBag.
     *
     * @param string $key
     * @return bool
     */
    public function hasFlash(string $key) {
        return $this->sessionContainer->getFlashBag()->has($key);
    }

    /**
     * Get Session Container.
     *
     * @return SymfonySession
     */
    public function getSession() {
        return $this->sessionContainer;
    }
}
