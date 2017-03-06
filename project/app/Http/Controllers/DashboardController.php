<?php

namespace App\Http\Controllers;

use Core\Http\Controllers\Controller;
use Core\Services\Validator\ValidatorFacade;
use Core\Services\View\ViewFacade;
use Symfony\Component\HttpFoundation\Request;
use GuzzleHttp\Client;

class DashboardController extends Controller {

    /**
     * GET / - Index.
     *
     * @param Request $request
     * @return mixed
     */
    public function indexAction(Request $request) {
        return ViewFacade::make('index.html', []);
    }

    public function testAction() {

    }

    /**
     * POST / - Process set Url.
     *
     * @param Request $request
     */
    public function checkAction(Request $request) {

        // Define Validator
        $validationResult = ValidatorFacade::validate($request, [
            'inputUrl' => 'required|url'
        ]);

        // Check if validation pass
        if ($validationResult->pass()) {

            // Check request Url
            $resultArray = $this->checkUrl($request->get('inputUrl'));

            sd($resultArray);

        } else {

            // TODO: Redirect to index with data

            sd($validationResult->errors());
        }
    }

    /**
     * Follow Request Url.
     *
     * @param string $requestUrl
     * @return array
     */
    private function checkUrl(string $requestUrl) {

        // Create new Guzzle Client
        $httpClient = new Client([
            'allow_redirects' => false
        ]);

        // Define Result Array
        $resultArray = [];

        // Send Request
        $requestResponse = $httpClient->request('GET', $requestUrl);

        while (in_array($requestResponse->getStatusCode(), [301, 302])) {

            $resultArray[] = [
                'code'     => $requestResponse->getStatusCode(),
                'redirect' => $requestResponse->getHeaderLine('Location')
            ];

            $requestResponse = $httpClient->request('GET', $requestResponse->getHeaderLine('Location'));
        }

        return $resultArray;
    }
}
