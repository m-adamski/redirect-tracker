<?php

// --------------------------------------------------------------------------
// Register The Auto Loader
// --------------------------------------------------------------------------
require __DIR__ . '/../bootstrap/autoload.php';


// --------------------------------------------------------------------------
// Create Application Core
// --------------------------------------------------------------------------
/* @var $application \Core\Application */
$application = require_once __DIR__ . '/../bootstrap/app.php';

$application->handle(
    $request = \Core\Services\Request\Request::capture()
);
