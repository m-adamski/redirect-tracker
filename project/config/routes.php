<?php

\Router::get('/', [\App\Http\Controllers\DashboardController::class, 'indexAction']);
\Router::post('/', [\App\Http\Controllers\DashboardController::class, 'checkAction']);
