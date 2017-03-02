<?php

return [
    'providers' => [
        \App\Services\Routing\RouterProvider::class
    ],
    'facades'   => [
        \App\Services\Routing\RouterFacade::class
    ],
    'aliases'   => [
        'Router' => \App\Services\Routing\RouterFacade::class
    ]
];
