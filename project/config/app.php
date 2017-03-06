<?php

return [
    // --------------------------------------------------------------------------
    // Application Name
    // --------------------------------------------------------------------------
    'name'      => 'Redirect Tracker',


    // --------------------------------------------------------------------------
    // Application Debug Mode
    // --------------------------------------------------------------------------
    'debug'     => true,


    // --------------------------------------------------------------------------
    // Application URL
    // --------------------------------------------------------------------------
    'url'       => 'http://redirect-tracker.local',


    // --------------------------------------------------------------------------
    // Application Providers
    // --------------------------------------------------------------------------
    'providers' => [
        \Core\Services\Config\ConfigProvider::class,
        \Core\Services\Debugger\DebuggerProvider::class,
        \Core\Services\Routing\RouterProvider::class,
        \Core\Services\View\ViewProvider::class,
        \Core\Services\Validator\ValidatorProvider::class,
        \Core\Services\Redirect\RedirectProvider::class,
    ],


    // --------------------------------------------------------------------------
    // Application Facades
    // --------------------------------------------------------------------------
    'facades'   => [
        \Core\Services\Config\ConfigFacade::class,
        \Core\Services\Debugger\DebuggerFacade::class,
        \Core\Services\Routing\RouterFacade::class,
        \Core\Services\View\ViewFacade::class,
        \Core\Services\Validator\ValidatorFacade::class,
        \Core\Services\Redirect\RedirectFacade::class,
    ],


    // --------------------------------------------------------------------------
    // Application Aliases
    // --------------------------------------------------------------------------
    'aliases'   => [
        'Config'    => \Core\Services\Config\ConfigFacade::class,
        'Debugger'  => \Core\Services\Debugger\DebuggerFacade::class,
        'Router'    => \Core\Services\Routing\RouterFacade::class,
        'View'      => \Core\Services\View\ViewFacade::class,
        'Validator' => \Core\Services\Validator\ValidatorFacade::class,
        'Redirect'  => \Core\Services\Redirect\RedirectFacade::class,
    ]
];
