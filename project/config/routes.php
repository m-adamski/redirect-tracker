<?php

\Router::get('/', [\App\Http\Controllers\DashboardController::class, 'indexAction']);
\Router::get('/test', [\App\Http\Controllers\DashboardController::class, 'testAction']);
\Router::post('/', [\App\Http\Controllers\DashboardController::class, 'checkAction']);
