<?php

namespace App;

use App\Exceptions\RuntimeException;
use App\Services\Facade\FacadeTraits;
use App\Services\Provider\ProviderTraits;
use App\Services\Request\Request;
use DusanKasan\Knapsack\Collection;
use Symfony\Component\Debug\Debug;

class Application {

    use ProviderTraits, FacadeTraits;

    protected $appConfigPath;
    protected $servicesCollection;

    public function __construct() {
        Debug::enable();

        // Define Config paths
        $this->appConfigPath = __DIR__ . '/../config/app.php';

        // Init Services Collection
        $this->servicesCollection = new Collection([]);

        // Init Providers & Facades
        $this->initProviders($this, $this->appConfigPath);
        $this->initFacades($this->appConfigPath);
    }

    /**
     * Bind module.
     *
     * @param string $name
     * @param $value
     */
    public function bind(string $name, callable $value) {
        $this->servicesCollection->append(call_user_func($value), $name);
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
        sd($request);
    }
}
