<?php

// --------------------------------------------------------------------------
// Create Application Core
// --------------------------------------------------------------------------
$application = new \Core\Application();

$application->setPath('appConfig', __DIR__ . '/../config/app.php');
$application->setPath('routesConfig', __DIR__ . '/../config/routes.php');
$application->setPath('views', __DIR__ . '/../resources/views');
$application->setPath('viewsCache', __DIR__ . '/../storage/cache');

$application->init();

return $application;

