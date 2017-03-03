<?php

namespace Core\Services\View;

use Core\Services\Config\ConfigFacade;
use Core\Services\Provider\Provider;

class ViewProvider extends Provider {

    public function boot() {
        //
    }

    public function register() {
        $this->application->bind('view', function () {

            $templatesPath = $this->application->getPath('views');
            $templatesCachePath = $this->application->getPath('viewsCache');

            return new View($templatesPath, '.twig', [
                'cache' => $templatesCachePath,
                'debug' => ConfigFacade::get('appConfig', 'debug')
            ]);
        });
    }
}
