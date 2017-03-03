<?php

namespace App\Http\Controllers;

use Core\Http\Controllers\Controller;
use Core\Services\View\ViewFacade;

class DashboardController extends Controller {

    public function indexAction() {
        return ViewFacade::make('index.html', []);
    }
}
