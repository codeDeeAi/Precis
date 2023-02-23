<?php

declare(strict_types=1);

namespace App\Core;

/**
 * Class Request
 * 
 * @author Adeola Bada <dunsin.bada@gmail.com>
 * @package App\Core
 */
class Request
{
    /**
     * Get current request path
     * @return String
     */
    public function getPath(): string
    {
        return parse_url($_SERVER['REQUEST_URI'])['path'];
    }

    /**
     * Get current request full path
     * @return String
     */
    public function getFullPath(): string
    {
        return $_SERVER['REQUEST_URI'];
    }

    /**
     * Get current request query params
     * @return Array
     */
    public function getQuery(): array
    {
        $fullPathArray = explode('?', $this->getFullPath());

        return (isset($fullPathArray[1]))
            ? explode('&', $fullPathArray[1])
            : [];
    }

    /**
     * Get current request method
     * @param Boolean $toLowerCase
     * @return String
     */
    public function getMethod(bool $toLowerCase = false): string
    {
        $method = $_SERVER['REQUEST_METHOD'];

        return ($toLowerCase)
            ? strtolower($method)
            : $method;
    }
}
