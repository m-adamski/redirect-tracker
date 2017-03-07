<?php

namespace App\Http\Controllers;

use Core\Http\Controllers\Controller;
use Core\Services\Redirect\RedirectFacade;
use Core\Services\Session\SessionFacade;
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

        // Define response data
        $responseData = [];

        // Check for Validation Errors
        if (SessionFacade::hasFlash('validationError')) {
            $responseData['validationError'] = SessionFacade::getFlash('validationError');
        }

        // Check for Redirect Result
        if (SessionFacade::hasFlash('redirectResult')) {
            $responseData['redirectResult'] = SessionFacade::getFlash('redirectResult');
        }

        return ViewFacade::make('index.html', $responseData);
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

            // Add result into Flash Session & Redirect to Home
            SessionFacade::addFlash('redirectResult', [$resultArray], false);
            RedirectFacade::redirect('/');

        } else {

            // Add Validation errors into Flash Session & Redirect to Home
            SessionFacade::addFlash('validationError', $validationResult->errors(), false);
            RedirectFacade::redirect('/');
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
