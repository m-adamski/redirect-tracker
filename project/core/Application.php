<?php

namespace Core;

use Core\Exceptions\RuntimeException;
use Core\Services\Alias\AliasTraits;
use Core\Services\Facade\FacadeTraits;
use Core\Services\Provider\ProviderTraits;
use Core\Services\Routing\RouterFacade;
use Core\Services\Routing\RouterTraits;
use Core\Services\Session\SessionFacade;
use Symfony\Component\HttpFoundation\Request;
use DusanKasan\Knapsack\Collection;

class Application {

    use ProviderTraits, FacadeTraits, AliasTraits, RouterTraits;

    protected $pathsCollection;
    protected $servicesCollection;

    public function __construct() {

        // Init Paths Collection
        $this->pathsCollection = new Collection([]);

        // Init Services Collection
        $this->servicesCollection = new Collection([]);
    }

    /**
     * Init.
     */
    public function init() {

        // Init Providers, Facades & Aliases
        $this->initFacades($this->getPath('appConfig'));
        $this->initProviders($this, $this->getPath('appConfig'));
        $this->registerAliases($this->getPath('appConfig'));

        // Read Routes
        $this->readRoutes($this->getPath('routesConfig'));
    }

    /**
     * Set Path.
     *
     * @param string $pathName
     * @param string $path
     * @throws RuntimeException
     */
    public function setPath(string $pathName, string $path) {
        if (!$this->pathsCollection->has($pathName)) {
            $this->pathsCollection = $this->pathsCollection->append($path, $pathName);
        } else {
            throw new RuntimeException('Path already exist.');
        }
    }

    /**
     * Get Path.
     *
     * @param string $pathName
     * @return Collection|mixed
     * @throws RuntimeException
     */
    public function getPath(string $pathName) {
        if ($this->pathsCollection->has($pathName)) {
            return $this->pathsCollection->get($pathName);
        }

        throw new RuntimeException('Path does not found.');
    }

    /**
     * Bind module.
     *
     * @param string $name
     * @param $value
     */
    public function bind(string $name, callable $value) {
        $this->servicesCollection = $this->servicesCollection->append(call_user_func($value), $name);
    }

    /**
     * Return module with specified name.
     *
     * @param string $name
     * @return Collection|mixed
     * @throws RuntimeException
     */
    public function get(string $name) {
        if ($this->servicesCollection->has($name)) {
            return $this->servicesCollection->get($name);
        }

        throw new RuntimeException('Module does not found.');
    }

    /**
     * Handle Request.
     *
     * @param Request $request
     */
    public function handle(Request $request) {

        // Assign Session into Request
        $request->setSession(SessionFacade::getSession());

        // Display Response
        echo RouterFacade::dispatch($request);
    }
}
