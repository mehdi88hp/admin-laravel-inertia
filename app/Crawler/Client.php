<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Crawler;

use Symfony\Component\BrowserKit\HttpBrowser;

/**
 * An implementation of a browser using the HttpClient component
 * to make real HTTP requests.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
class Client extends HttpBrowser
{

}
