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
     * Set Response Headers 
     * @param Array $headers
     * @return Self
     */
    public function setHeaders(array $headers): Self
    {
        foreach ($headers as $header) {
            header("$header");
        }

        return $this;
    }

    /**
     * Set Status Code 
     * @param Int $code
     * @return self
     */
    public function setStatusCode(int $code): self
    {
        http_response_code($code);

        return $this;
    }
    /**
     * Return array to json 
     * @param array $data
     * @return 
     */
    public function toJson(array $data = [])
    {
        return json_encode($data);
    }

    /**
     * List Headers 
     * @return Array headers
     */
    public static function listHeaders(): array
    {
        return headers_list();
    }

    /**
     * Return new view instance
     * @return View 
     */
    public static function view(): \App\Core\View
    {
        return new View();
    }
}
