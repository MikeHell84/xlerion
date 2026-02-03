<?php

namespace App\Http\Middleware;

use Illuminate\Http\Middleware\TrustProxies as Middleware;
use Symfony\Component\HttpFoundation\Request;

class TrustProxies extends Middleware
{
    /**
     * The trusted proxies for this application.
     *
     * @var array|string|null
     */
    protected $proxies = '*';

    /**
     * The headers that should be used to detect proxies.
     *
     * @var int
     */
    // Fallback to 0 if the Request constants are not available in this environment.
    // In standard Laravel installs this is usually Request::HEADER_X_FORWARDED_ALL.
    protected $headers = 0;
}
