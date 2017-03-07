<?php

namespace Core\Services\Redirect;

use Symfony\Component\HttpFoundation\RedirectResponse;

class Redirect {

    /**
     * Redirect to specified Uri.
     *
     * @param string $redirectUri
     */
    public function redirect(string $redirectUri) {
        RedirectResponse::create($redirectUri)->send();
    }
}
