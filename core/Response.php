<?php

declare(strict_types=1);

namespace App\Core;

use App\Core\Traits\Utils\Routes;

/**
 * Class Response
 * 
 * @author Adeola Bada <dunsin.bada@gmail.com>
 * @package App\Core
 */
class Response
{
    use Routes;

    public function __construct()
    {
    }

    /**
     * Set Status Code 
     * @param Int $code
     */
    public static function setStatusCode(int $code)
    {
        http_response_code($code);
    }
}
